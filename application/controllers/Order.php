<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->load->library("pagination");
        $this->auth->check_session();
        $this->load->model('Order_model');
        $this->load->model('Project_model');
        $this->load->model('Produk_model');
        $this->load->model('Customer_model');
        $this->load->model('Warna_model');
        $this->load->model('Ukuran_model');
        $this->load->model('Request_model');
        $this->load->model('Hpp_model');
        $this->load->model('Admin_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris', 'order', 'produksi', 'finance', 'cs')) === false) {
            show_error('Kamu tidak memiliki akses', 403, 'Akses ditolak');
            // redirect('logout', 'location');
        }
    }

    public function index($offset = null)
    {
        $filter_product_id        = ($this->input->get('filter_product_id')) ?? null;
        $filter_customer_id       = ($this->input->get('filter_customer_id')) ?? null;
        $filter_order_via         = ($this->input->get('filter_order_via')) ?? null;
        $filter_status_order      = ($this->input->get('filter_status_order')) ?? null;
        $filter_status_pembayaran = ($this->input->get('filter_status_pembayaran')) ?? null;
        $filter_sales_invoice     = ($this->input->get('filter_sales_invoice')) ?? null;

        $products        = $this->Produk_model->get_all_data();
        $customers       = $this->Customer_model->get_all_data();
        $admin_orders    = $this->Admin_model->get_admin('order');
        $admin_produksis = $this->Admin_model->get_admin('produksi');
        $admin_css       = $this->Admin_model->get_admin('cs');
        $admin_finances  = $this->Admin_model->get_admin('finance');

        $limit = 10;

        $config["base_url"]           = base_url() . "order/index";
        $config["total_rows"]         = $this->Order_model->get_all_data($filter_product_id, $filter_customer_id, $filter_order_via, $filter_status_order, $filter_status_pembayaran, $filter_sales_invoice)->num_rows();
        $config["per_page"]           = $limit;
        $config["uri_segment"]        = 3;
        $config["reuse_query_string"] = true;

        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['attributes']      = ['class' => 'page-link'];
        $config['first_link']      = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '&laquo';
        $config['prev_tag_open']   = '<li class="page-item">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&raquo';
        $config['next_tag_open']   = '<li class="page-item">';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li class="page-item">';
        $config['last_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close']   = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open']    = '<li class="page-item">';
        $config['num_tag_close']   = '</li>';

        $this->pagination->initialize($config);

        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $list = $this->Order_model->get_all_data($filter_product_id, $filter_customer_id, $filter_order_via, $filter_status_order, $filter_status_pembayaran, $filter_sales_invoice, $limit, $offset);

        $data = array(
            'title'                    => 'Order',
            'page'                     => 'order/main',
            'vitamin'                  => 'order/main_vitamin',
            'total_data'               => $config["total_rows"],
            'list'                     => $list,
            'products'                 => $products,
            'customers'                => $customers,
            'admin_orders'             => $admin_orders,
            'admin_produksis'          => $admin_produksis,
            'admin_css'                => $admin_css,
            'admin_finances'           => $admin_finances,
            'filter_product_id'        => $filter_product_id,
            'filter_customer_id'       => $filter_customer_id,
            'filter_status_order'      => $filter_status_order,
            'filter_status_pembayaran' => $filter_status_pembayaran,
            'filter_order_via'         => $filter_order_via,
            'error'                    => null,
        );
        $this->theme->render($data);
    }

    public function add()
    {
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris', 'order')) === false) {
            show_error('Kamu tidak memiliki akses', 403, 'Akses ditolak');
            // redirect('logout', 'location');
        }
        $this->form_validation->set_rules('admin_order', 'ADMIN ORDER', 'required');
        $this->form_validation->set_rules('project_id', 'PROJECT', 'required');
        $this->form_validation->set_rules('order_via', 'ORDER VIA', 'required');
        $this->form_validation->set_rules('whatsapp', 'NO WHATSAPP', 'required');
        $this->form_validation->set_rules('sales_invoice', 'SALES INVOICE', 'required');
        $this->form_validation->set_rules('created_at', 'TANGGAL & JAM ORDER', 'required');
        $this->form_validation->set_rules('durasi_batas_transfer', 'DURASI BATAS TRANSFER', 'required');
        $this->form_validation->set_rules('batas_waktu_transfer', 'BATAS WAKTU TRANSFER', 'required');
        $this->form_validation->set_rules('customer_id', 'CUSTOMER', 'required');
        $this->form_validation->set_rules('product_id', 'PRODUK', 'required');
        $this->form_validation->set_rules('color_id', 'WARNA', 'required');
        $this->form_validation->set_rules('size_id', 'UKURAN', 'required');
        $this->form_validation->set_rules('pilih_jahitan', 'JAHITAN', 'required');
        $this->form_validation->set_rules('estimasi_selesai', 'ESTIMASI SELESAI', 'required');
        $this->form_validation->set_rules('jenis_dp', 'JENIS DP', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );

            $this->Order_model->clear_temp();
            $this->Order_model->clear_request();

            $exec_code            = $this->Order_model->generate_sales_invoice();
            $id_order             = $exec_code['id_order'];
            $sales_invoice        = $exec_code['sales_invoice'];
            $kode_unik            = $exec_code['kode_unik'];
            $created_at           = $exec_code['created_at'];
            $batas_waktu_transfer = $exec_code['batas_waktu_transfer'];
            $estimasi_selesai     = $exec_code['estimasi_selesai'];
            $projects             = $this->Project_model->get_all_data();
            $customers            = $this->Customer_model->get_all_data();
            $products             = $this->Produk_model->get_all_data();
            $colors               = $this->Warna_model->get_all_data();
            $sizes                = $this->Ukuran_model->get_all_data();

            $data = array(
                'title'                => 'Order',
                'page'                 => 'order/form',
                'vitamin'              => 'order/form_vitamin',
                'id_order'             => $id_order,
                'sales_invoice'        => $sales_invoice,
                'kode_unik'            => $kode_unik,
                'created_at'           => $created_at,
                'batas_waktu_transfer' => $batas_waktu_transfer,
                'estimasi_selesai'     => $estimasi_selesai,
                'projects'             => $projects,
                'customers'            => $customers,
                'products'             => $products,
                'colors'               => $colors,
                'sizes'                => $sizes,
                'csrf'                 => $csrf,
                'error'                => null,
            );
            $this->theme->render($data);
        } else {
            $this->store();
        }
    }

    protected function store()
    {
        $id_order              = $this->input->post('id_order');
        $project_id            = $this->input->post('project_id');
        $durasi_batas_transfer = $this->input->post('durasi_batas_transfer');
        $batas_waktu_transfer  = $this->input->post('batas_waktu_transfer');
        $estimasi_selesai      = $this->input->post('estimasi_selesai');
        $order_via             = $this->input->post('order_via');
        $product_id            = $this->input->post('product_id');
        $color_id              = $this->input->post('color_id');
        $size_id               = $this->input->post('size_id');
        $pilih_jahitan         = $this->input->post('pilih_jahitan');
        $catatan               = $this->input->post('catatan');
        $customer_id           = $this->input->post('customer_id');
        $whatsapp              = $this->input->post('whatsapp');
        $id_tokped             = $this->input->post('id_tokped');
        $id_shopee             = $this->input->post('id_shopee');
        $id_instagram          = $this->input->post('id_instagram');
        $jenis_dp              = $this->input->post('jenis_dp');
        $sub_total             = $this->input->post('sub_total_order');
        $grand_total           = $this->input->post('grand_total_order');
        $grand_total           = $this->input->post('grand_total_order');
        $dp_value              = $this->input->post('dp_order');
        $dp_value              = $this->input->post('dp_order');
        $pelunasan_value       = $this->input->post('lunas_order');

        $products      = $this->Produk_model->get_single_data('id', $product_id);
        $product_price = $products->row()->price;

        $sizes      = $this->Ukuran_model->get_single_data('id', $size_id);
        $size_price = $sizes->row()->cost;

        if ($pilih_jahitan == "standard") {
            $pilih_jahitan_price = 0;
        } elseif ($pilih_jahitan == "express") {
            $pilih_jahitan_price = 50000;
        } elseif ($pilih_jahitan == "urgent") {
            $pilih_jahitan_price = 100000;
        } elseif ($pilih_jahitan == "super urgent") {
            $pilih_jahitan_price = 150000;
        }

        $data = array(
            'project_id'            => $project_id,
            'durasi_batas_transfer' => $durasi_batas_transfer,
            'batas_waktu_transfer'  => $batas_waktu_transfer,
            'estimasi_selesai'      => $estimasi_selesai,
            'order_via'             => $order_via,
            'product_id'            => $product_id,
            'product_price'         => $product_price,
            'color_id'              => $color_id,
            'size_id'               => $size_id,
            'size_price'            => $size_price,
            'pilih_jahitan'         => $pilih_jahitan,
            'pilih_jahitan_price'   => $pilih_jahitan_price,
            'catatan'               => $catatan,
            'customer_id'           => $customer_id,
            'whatsapp'              => $whatsapp,
            'id_tokped'             => $id_tokped,
            'id_shopee'             => $id_shopee,
            'id_instagram'          => $id_instagram,
            'status_order'          => 'order dibuat',
            'status_pembayaran'     => 'menunggu pembayaran',
            'sub_total'             => $sub_total,
            'grand_total'           => $grand_total,
            'jenis_dp'              => $jenis_dp,
            'dp_value'              => $dp_value,
            'pelunasan_value'       => $pelunasan_value,
            'admin_order'           => $this->session->userdata(SESS_ADM . 'id'),
            'status'                => 'active',
        );
        $where = array('id' => $id_order);
        $exec  = $this->Order_model->update('orders', $data, $where);

        if (!$exec) {
            echo "Tambah Order gagal, silahkan coba kembali!";
        }

        $data = array(
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata(SESS_ADM . 'id'),
        );
        $where = array('order_id' => $id_order);
        $exec  = $this->Order_model->update('order_requests', $data, $where);

        if (!$exec) {
            echo "Tambah request gagal, silahkan coba kembali!";
        }

        $exec = $this->Order_model->update_customer($customer_id, $grand_total);

        $this->session->set_flashdata('success', 'Tambah Order Berhasil');
        redirect(base_url('order/add'));
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('whatsapp', 'WHATSAPP', 'required');
        $this->form_validation->set_rules('name', 'NAMA', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $list = $this->Order_model->get_single_data('id', $id);
            $data = array(
                'title' => 'Order Edit',
                'page'  => 'order/form_edit',
                'csrf'  => $csrf,
                'list'  => $list,
                'error' => null,
            );
            $this->theme->render($data);
        } else {
            $this->update($id);
        }
    }

    protected function update($id)
    {
        $data  = array(
            'name'         => $this->input->post('name'),
            'id_tokped'    => $this->input->post('id_tokped'),
            'id_shopee'    => $this->input->post('id_shopee'),
            'id_instagram' => $this->input->post('id_instagram'),
            'updated_at'   => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'   => $this->session->userdata(SESS_ADM . 'id'),
        );
        $where = array('id' => $id);
        $exec  = $this->Order_model->update($data, $where);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Edit Order Gagal');
            redirect(base_url() . 'order/index', 'location');
        }

        $this->session->set_flashdata('success', 'Edit Order Berhasil');
        redirect(base_url() . 'order/index', 'location');
    }

    public function destroy($id)
    {
        $data  = array(
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata(SESS_ADM . 'id'),
        );
        $where = array('id' => $id);
        $exec  = $this->Order_model->destroy($data, $where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function render_hpp()
    {
        $product_id = $this->input->get('product_id');
        $exec       = $this->Order_model->get_temp_hpp($product_id);

        echo json_encode([
            'code'  => 200,
            'count' => $exec->num_rows(),
            'data'  => $exec->result(),
        ]);
    }

    public function store_hpp()
    {
        $product_id = $this->input->post('product_id');
        $hpp_id     = $this->input->post('hpp_id');
        $qty        = $this->input->post('qty_hpp');

        $basic_price = $this->Hpp_model->get_single_data('hpps.id', $hpp_id)->row()->cost;
        $total_price = $basic_price * $qty;

        $data  = array(
            'product_id'  => $product_id,
            'hpp_id'      => $hpp_id,
            'qty'         => $qty,
            'basic_price' => $basic_price,
            'total_price' => $total_price,
            'created_at'  => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by'  => $this->session->userdata(SESS_ADM . 'id'),
        );
        $exec  = $this->Order_model->store_hpp($data);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function destroy_hpp($id)
    {
        $where = array('id' => $id);
        $exec  = $this->Order_model->destroy_hpp($where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function blokir()
    {
        $id              = $this->input->post('id');
        $reason_inactive = trim($this->input->post('reason_inactive'));

        $data = array(
            'status'          => 'tidak aktif',
            'reason_inactive' => $reason_inactive,
            'updated_at'      => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'      => $this->session->userdata(SESS_ADM . 'id'),
        );

        $where = array('id' => $id);
        $exec  = $this->Order_model->update($data, $where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function store_request()
    {
        $order_id   = $this->input->post('order_id');
        $request_id = $this->input->post('request_id');
        $exec       = $this->Produk_model->get_product_request('requests.id', $request_id);
        $cost       = $exec->row()->cost;

        $data = array(
            'order_id'   => $order_id,
            'request_id' => $request_id,
            'cost'       => $cost,
            'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata(SESS_ADM . 'id'),
        );

        $exec = $this->Order_model->store('order_requests', $data);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = [
            'code' => 200,
            'cost' => $cost,
        ];

        echo json_encode($return);
    }

    public function render_detail()
    {
        $order_id      = $this->input->get('order_id');
        $product_id    = $this->input->get('product_id');
        $color_id      = $this->input->get('color_id');
        $size_id       = $this->input->get('size_id');
        $kode_unik     = $this->input->get('kode_unik');
        $pilih_jahitan = $this->input->get('pilih_jahitan');

        $exec  = $this->Order_model->render_detail($order_id, $product_id, $color_id, $size_id, $kode_unik, $pilih_jahitan);

        echo json_encode([
            'code' => 200,
            'data' => $exec
        ]);
    }

    public function remove_request()
    {
        $id = $this->input->post('id');
        $exec = $this->Order_model->remove_request($id);
        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function copy_order()
    {
        $order_id      = $this->input->get('order_id');
        $product_id    = $this->input->get('product_id');
        $color_id      = $this->input->get('color_id');
        $size_id       = $this->input->get('size_id');
        $kode_unik     = $this->input->get('kode_unik');
        $jenis_dp      = $this->input->get('jenis_dp');
        $pilih_jahitan = $this->input->get('pilih_jahitan');

        $exec  = $this->Order_model->copy_order($order_id, $product_id, $color_id, $size_id, $kode_unik, $jenis_dp, $pilih_jahitan);

        echo json_encode([
            'code' => 200,
            'data' => $exec
        ]);
    }

    public function show_request()
    {
        $id = $this->input->get('id');

        $exec = $this->Order_model->show_request($id);

        echo json_encode([
            'code' => 200,
            'data' => $exec->result(),
        ]);
    }

    public function invoice($id)
    {
        if (in_array($this->session->userdata(SESS_ADM . 'role'), ['owner', 'developer', 'komisaris', 'finance'])) {
            $exec = $this->Order_model->generate_invoice($id);
            $this->load->view('invoice', $exec, FALSE);
        } else {
            show_error('Kamu tidak memiliki akses', 403, 'Akses ditolak');
        }
    }

    public function show_detail()
    {
        $id = $this->input->get('id');
        $orders = $this->Order_model->get_order_detail($id);
        echo json_encode([$orders]);
    }
}
        
    /* End of file  Order.php */
