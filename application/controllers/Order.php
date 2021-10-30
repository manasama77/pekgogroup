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
        if (in_array($this->session->userdata('role'), array('owner', 'developer', 'komisaris', 'order')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $list            = $this->Order_model->get_all_data();
        $products        = $this->Produk_model->get_all_data();
        $customers       = $this->Customer_model->get_all_data();
        $admin_orders    = $this->Admin_model->get_admin('order');
        $admin_produksis = $this->Admin_model->get_admin('produksi');
        $admin_css       = $this->Admin_model->get_admin('cs');
        $admin_finances  = $this->Admin_model->get_admin('finance');

        $data = array(
            'title'           => 'Order',
            'page'            => 'order/main',
            'vitamin'         => 'order/main_vitamin',
            'list'            => $list,
            'products'        => $products,
            'customers'       => $customers,
            'admin_orders'    => $admin_orders,
            'admin_produksis' => $admin_produksis,
            'admin_css'       => $admin_css,
            'admin_finances'  => $admin_finances,
            'error'           => null,
        );
        $this->theme->render($data);
    }

    public function add()
    {
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
        $this->form_validation->set_rules('catatan', 'CATATAN TAMBAHAN', 'required');

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


        $data = array(
            'project_id'            => $project_id,
            'durasi_batas_transfer' => $durasi_batas_transfer,
            'batas_waktu_transfer'  => $batas_waktu_transfer,
            'estimasi_selesai'      => $estimasi_selesai,
            'order_via'             => $order_via,
            'product_id'            => $product_id,
            'color_id'              => $color_id,
            'size_id'               => $size_id,
            'pilih_jahitan'         => $pilih_jahitan,
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
            'admin_order'           => $this->session->userdata('id'),
            'status'                => 'active',
        );
        $where = array('id' => $id_order);
        $exec  = $this->Order_model->update('orders', $data, $where);

        if (!$exec) {
            echo "Tambah Order gagal, silahkan coba kembali!";
        }

        $data = array(
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id'),
        );
        $where = array('order_id' => $id_order);
        $exec  = $this->Order_model->update('order_requests', $data, $where);

        if (!$exec) {
            echo "Tambah request gagal, silahkan coba kembali!";
        }

        $this->session->set_flashdata('success', 'Tambah Order Berhasil');
        session_write_close();
        redirect(base_url() . 'order/add', 'location');
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
            'updated_by'   => $this->session->userdata('id'),
        );
        $where = array('id' => $id);
        $exec  = $this->Order_model->update($data, $where);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Edit Order Gagal');
            session_write_close();
            redirect(base_url() . 'order/index', 'location');
        }

        $this->session->set_flashdata('success', 'Edit Order Berhasil');
        session_write_close();
        redirect(base_url() . 'order/index', 'location');
    }

    public function destroy($id)
    {
        $data  = array(
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata('id'),
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
            'created_by'  => $this->session->userdata('id'),
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
            'updated_by'      => $this->session->userdata('id'),
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
        $exec       = $this->Produk_model->get_product_request('product_request_params.id', $request_id);
        $cost       = $exec->row()->cost;

        $data = array(
            'order_id'   => $order_id,
            'request_id' => $request_id,
            'cost'       => $cost,
            'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id'),
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
        $order_id   = $this->input->get('order_id');
        $product_id = $this->input->get('product_id');
        $color_id   = $this->input->get('color_id');
        $size_id    = $this->input->get('size_id');
        $kode_unik  = $this->input->get('kode_unik');
        $jenis_dp   = $this->input->get('jenis_dp');

        $exec  = $this->Order_model->render_detail($order_id, $product_id, $color_id, $size_id, $kode_unik, $jenis_dp);

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
        $order_id   = $this->input->get('order_id');
        $product_id = $this->input->get('product_id');
        $color_id   = $this->input->get('color_id');
        $size_id    = $this->input->get('size_id');
        $kode_unik  = $this->input->get('kode_unik');
        $jenis_dp   = $this->input->get('jenis_dp');
        $catatan    = $this->input->get('catatan');

        $exec  = $this->Order_model->copy_order($order_id, $product_id, $color_id, $size_id, $kode_unik, $jenis_dp, $catatan);

        echo json_encode([
            'code' => 200,
            'data' => $exec
        ]);
    }
}
        
    /* End of file  Order.php */
