<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cshop extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model', 'project_model');
        $this->load->model('Produk_model', 'produk_model');
        $this->load->model('Ukuran_model', 'ukuran_model');
        $this->load->model('Warna_model', 'warna_model');
        $this->load->model('Customer_model', 'customer_model');
        $this->load->model('Order_model', 'order_model');
        $this->load->model('Request_model', 'request_model');
        $this->load->model('Shop_model', 'shop_model');
        $this->load->model('Pembayaran_model', 'pembayaran_model');
        $this->load->library('pagination');
    }

    public function index()
    {
        $f_size = ($this->input->get('size')) ?? null;

        $config['base_url']           = base_url('shop/index');
        $config['total_rows']         = $this->produk_model->count_all($f_size)->num_rows();
        $config['per_page']           = 1;
        $config['reuse_query_string'] = TRUE;
        $config['uri_segment']        = 3;
        $config["num_links"]          = floor($config["total_rows"] / $config["per_page"]);

        $config['full_tag_open']   = '<ul>';
        $config['full_tag_close']  = '</ul>';
        $config['first_link']      = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '<i class="fas fa-chevron-left fa-fw"></i>';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '<i class="fas fa-chevron-right fa-fw"></i>';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="active"><span>';
        $config['cur_tag_close']   = '</span></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $this->pagination->initialize($config);

        $segment = ($this->uri->segment(3)) ?? null;

        $projects = $this->project_model->get_single_data('PKG');
        $products = $this->produk_model->get_paging_data($config['per_page'], $segment, $f_size);
        $sizes    = $this->ukuran_model->get_all_data();
        $colors   = $this->warna_model->get_all_data();

        $data = [
            'page_title' => 'Shop',
            'page'       => 'shop/index',
            'vitamin'    => 'shop/index_vitamin',
            'projects'   => $projects,
            'products'   => $products,
            'sizes'      => $sizes,
            'colors'     => $colors,
            'f_size'     => $f_size,
        ];
        $this->load->view('template/customer/master', $data);
    }

    public function show($id)
    {
        $projects     = $this->project_model->get_single_data('PKG');
        $products     = $this->produk_model->show_single_data($id);
        $top_products = $this->produk_model->get_top_product($id);

        $data = [
            'page_title'   => 'Shop',
            'page'         => 'shop/show',
            'vitamin'      => 'shop/show_vitamin',
            'projects'     => $projects,
            'products'     => $products,
            'top_products' => $top_products,
        ];
        $this->load->view('template/customer/master', $data);
    }

    public function checkout($product_id)
    {
        $check = $this->order_model->check_customer_order($this->session->userdata('id'));

        if ($check == 404) {
            $this->session->set_flashdata('warning', 'Terdapat order yang belum terselesaikan. 1 Customer hanya dapat membuat 1 order');
            redirect(base_url('products/' . $product_id), 'location');
            exit;
        }

        $this->db->trans_begin();

        $project_id = $this->project_model->get_single_data('PKG')['id'];

        $batas_waktu_transfer_obj = new DateTime('now');
        $batas_waktu_transfer_obj->modify('+3 hour');

        $estimasi_selesai_obj = new DateTime('now');
        $estimasi_selesai_obj->modify('+30 day');

        $cur_date_obj = new DateTime('now');

        $customers = $this->customer_model->get_single_data('id', $this->session->userdata('id'));

        $kode_unik = $this->shop_model->generate_kode_unik();

        $sales_invoice = $this->shop_model->generate_sales_invoice($kode_unik);

        $products = $this->produk_model->get_single_data('id', $product_id);
        $product_price = $products->row()->price;

        $sizes = $this->ukuran_model->get_single_data('id', $this->input->post('size_id'));
        $size_price = $sizes->row()->cost;

        if ($this->input->post('pilih_jahitan') == "standard") {
            $pilih_jahitan_price = 0;
        } elseif ($this->input->post('pilih_jahitan') == "express") {
            $pilih_jahitan_price = 50000;
        } elseif ($this->input->post('pilih_jahitan') == "urgent") {
            $pilih_jahitan_price = 100000;
        } elseif ($this->input->post('pilih_jahitan') == "super urgent") {
            $pilih_jahitan_price = 150000;
        }

        $sub_total   = $product_price + $size_price + $pilih_jahitan_price;
        $grand_total = $sub_total + $kode_unik;

        $dp_value        = ($grand_total * 30) / 100;
        $pelunasan_value = ($grand_total * 70) / 100;

        $data = [
            'project_id'            => $project_id,
            'sales_invoice'         => $sales_invoice,
            'durasi_batas_transfer' => '3',
            'batas_waktu_transfer'  => $batas_waktu_transfer_obj->format('Y-m-d H:i:s'),
            'estimasi_selesai'      => $estimasi_selesai_obj->format('Y-m-d H:i:s'),
            'order_via'             => 'web',
            'product_id'            => $product_id,
            'product_price'         => $product_price,
            'color_id'              => $this->input->post('color_id'),
            'size_id'               => $this->input->post('size_id'),
            'size_price'            => $size_price,
            'pilih_jahitan'         => $this->input->post('pilih_jahitan'),
            'pilih_jahitan_price'   => $pilih_jahitan_price,
            'catatan'               => null,
            'customer_id'           => $this->session->userdata('id'),
            'whatsapp'              => $customers->row()->whatsapp,
            'id_tokped'             => $customers->row()->id_tokped,
            'id_shopee'             => $customers->row()->id_shopee,
            'id_instagram'          => $customers->row()->id_instagram,
            'status_order'          => 'order dibuat',
            'status_pembayaran'     => 'menunggu pembayaran',
            'status_pengiriman'     => 'antrian',
            'sub_total'             => $sub_total,
            'kode_unik'             => $kode_unik,
            'grand_total'           => $grand_total,
            'jenis_dp'              => '30',
            'dp_value'              => $dp_value,
            'pelunasan_value'       => $pelunasan_value,
            'terbayarkan'           => 0,
            'tanggal_pengiriman'    => null,
            'ekspedisi'             => null,
            'no_resi'               => null,
            'alamat_pengiriman'     => null,
            'admin_order'           => 0,
            'admin_finance'         => 0,
            'admin_cs'              => 0,
            'admin_produksi'        => 0,
            'is_printed'            => 'no',
            'is_production'         => 'no',
            'is_paid_off'           => 'no',
            'status'                => 'temp',
            'created_at'            => $cur_date_obj->format('Y-m-d H:i:s'),
            'created_by'            => $this->session->userdata('id'),
            'updated_at'            => $cur_date_obj->format('Y-m-d H:i:s'),
            'updated_by'            => $this->session->userdata('id'),
            'deleted_at'            => null,
            'deleted_by'            => null,
        ];
        $exec = $this->order_model->store('orders', $data);

        if (!$exec) {
            $this->db->trans_rollback();
            show_error('Tidak terhubung dengan server, periksa koneksi anda', 500, 'Terjadi Kesalahan');
            exit;
        }

        $this->db->trans_commit();
        redirect(base_url('shop/requests'), 'location');
    }

    public function requests()
    {
        if (!$this->session->userdata('id') && !$this->session->userdata('whatsapp') && !$this->session->userdata('name')) {
            redirect(base_url('customer/logout'), 'location');
            exit;
        }

        $customer_id = $this->session->userdata('id');
        $customers   = $this->customer_model->get_single_data('id', $customer_id);
        $exec        = $this->order_model->get_temp_order($customer_id);

        $projects = $this->project_model->get_single_data('PKG');
        $requests = $this->produk_model->get_product_request('product_request_params.product_id', $exec->row()->product_id);

        $data = [
            'page_title' => 'Shop',
            'page'       => 'shop/request',
            'vitamin'    => 'shop/request_vitamin',
            'customers'  => $customers,
            'projects'   => $projects,
            'requests'   => $requests,
            'orders'     => $exec,
        ];
        $this->load->view('template/customer/master', $data);
    }

    public function render_order()
    {
        $customer_id = $this->session->userdata('id');
        $orders      = $this->order_model->get_temp_order($customer_id);

        $order_id      = $orders->row()->id;
        $product_id    = $orders->row()->product_id;
        $color_id      = $orders->row()->color_id;
        $size_id       = $orders->row()->size_id;
        $kode_unik     = $orders->row()->kode_unik;
        $pilih_jahitan = $orders->row()->pilih_jahitan;
        $jenis_dp      = $this->input->get('jenis_dp');

        $exec  = $this->order_model->render_detail($order_id, $product_id, $color_id, $size_id, $kode_unik, $jenis_dp, $pilih_jahitan);

        echo json_encode([
            'code' => 200,
            'data' => $exec
        ]);
    }

    public function store_request()
    {
        $customer_id = $this->session->userdata('id');
        $orders      = $this->order_model->get_temp_order($customer_id);

        $order_id   = $orders->row()->id;
        $request_id = $this->input->post('request_id');
        $exec       = $this->produk_model->get_product_request('product_request_params.id', $request_id);
        $cost       = $exec->row()->cost;

        $cur_date_obj = new DateTime('now');

        $data = array(
            'order_id'   => $order_id,
            'request_id' => $request_id,
            'cost'       => $cost,
            'created_at' => $cur_date_obj->format('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id'),
        );

        $exec = $this->order_model->store('order_requests', $data);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = [
            'code' => 200,
            'cost' => $cost,
        ];

        echo json_encode($return);
    }

    public function remove_request()
    {
        $id   = $this->input->post('id');
        $exec = $this->order_model->remove_request($id);
        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function finish()
    {
        $this->db->trans_begin();

        $customer_id = $this->session->userdata('id');
        $orders      = $this->order_model->get_temp_order($customer_id);

        $order_id            = $orders->row()->id;
        $alamat_pengiriman   = $this->input->post('alamat_pengiriman');
        $catatan             = $this->input->post('catatan');
        $jenis_dp            = $this->input->post('jenis_dp');
        $kode_unik           = $orders->row()->kode_unik;
        $product_price       = $orders->row()->product_price;
        $size_price          = $orders->row()->size_price;
        $pilih_jahitan_price = $orders->row()->pilih_jahitan_price;
        $request_price       = 0;
        $sub_total           = 0;
        $grand_total         = 0;
        $dp_value            = 0;
        $pelunasan_value     = 0;

        $requests = $this->order_model->get_request_data($order_id);
        $request_price = $requests->row()->cost;

        $sub_total = $product_price + $size_price + $pilih_jahitan_price + $request_price;
        $grand_total = $sub_total + $kode_unik;
        $dp_value = $grand_total * $jenis_dp / 100;

        if ($jenis_dp == 100) {
            $pelunasan_value = 0;
        } else {
            $pelunasan_value = $grand_total * (100 - $jenis_dp) / 100;
        }

        $cur_date_obj = new DateTime('now');

        $data = [
            'sub_total'       => $sub_total,
            'grand_total'     => $grand_total,
            'jenis_dp'        => $jenis_dp,
            'dp_value'        => $dp_value,
            'pelunasan_value' => $pelunasan_value,
            'status'          => 'active',
            'updated_at'      => $cur_date_obj->format('Y-m-d H:i:s'),
            'updated_by'      => $this->session->userdata('id'),
        ];
        $where = [
            'id'     => $order_id,
            'status' => 'temp',
        ];
        $exec = $this->order_model->update('orders', $data, $where);
        if (!$exec) {
            $this->db->trans_rollback();
            show_error('Proses Create Order gagal. Tidak terhubung dengan database, silahkan coba kembali', 500, 'Terjadi Kesalahan');
            exit;
        }

        $exec = $this->order_model->update_customer($customer_id, $grand_total);
        if (!$exec) {
            $this->db->trans_rollback();
            show_error('Proses Update customer gagal. Tidak terhubung dengan database, silahkan coba kembali', 500, 'Terjadi Kesalahan');
            exit;
        }

        $this->db->trans_commit();
        redirect(base_url('shop/thanks'), 'location');
    }

    public function thanks()
    {
        $projects = $this->project_model->get_single_data('PKG');

        $data = [
            'page_title' => 'Shop',
            'page'       => 'shop/thanks',
            'projects'   => $projects,
        ];
        $this->load->view('template/customer/master', $data);
    }

    public function list_order()
    {
        if (!$this->session->userdata('id') && !$this->session->userdata('whatsapp') && !$this->session->userdata('name')) {
            redirect(base_url('customer/logout'), 'location');
            exit;
        }

        $customer_id = $this->session->userdata('id');

        $projects = $this->project_model->get_single_data('PKG');

        $config['base_url']           = base_url('shop/list_order');
        $config['total_rows']         = $this->order_model->count_customer_order($customer_id)->num_rows();
        $config['per_page']           = 1;
        $config['reuse_query_string'] = TRUE;
        $config['uri_segment']        = 3;
        $config["num_links"]          = floor($config["total_rows"] / $config["per_page"]);

        $config['full_tag_open']   = '<ul>';
        $config['full_tag_close']  = '</ul>';
        $config['first_link']      = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']       = '<i class="fas fa-chevron-left fa-fw"></i>';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '<i class="fas fa-chevron-right fa-fw"></i>';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="active"><span>';
        $config['cur_tag_close']   = '</span></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $this->pagination->initialize($config);

        $segment = ($this->uri->segment(3)) ?? null;

        $orders   = $this->order_model->get_customer_order($config['per_page'], $segment, $this->session->userdata('id'));

        $data = [
            'page_title' => 'Shop',
            'page'       => 'shop/list_order',
            'vitamin'    => 'shop/list_order_vitamin',
            'projects'   => $projects,
            'orders'     => $orders,
        ];
        $this->load->view('template/customer/master', $data);
    }

    public function order_detail()
    {
        header('Content-type: application/json; charset=utf-8');
        $order_id = $this->input->get('order_id');
        $data = $this->order_model->get_order_detail($order_id);
        echo json_encode($data);
    }

    public function check_pembayaran_dp()
    {
        $order_id = $this->input->get('order_id');
        $code     = $this->pembayaran_model->cek_pembayaran_dp($order_id);
        echo json_encode(['code' => $code]);
    }

    public function store_dp()
    {
        $this->db->trans_begin();

        $config['upload_path']   = './assets/img/pembayaran/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = 2048;
        $config['max_width']     = 0;
        $config['max_height']    = 0;
        $config['encrypt_name']  = true;
        $config['remove_spaces'] = true;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('path_image_dp')) {
            $error = $this->upload->display_errors();
            show_error($error, 500, "Terjadi Kesalahan");
            exit;
        } else {
            $order_id = $this->input->post('id_dp');

            $check = $this->order_model->count_customer_order_by_id($order_id);

            if ($check->num_rows() == 0) {
                $this->db->trans_rollback();
                show_error('Order tidak ditemukan', 500, "Terjadi Kesalahan");
                exit;
            }

            $image_data = $this->upload->data();
            $path_image = $image_data['file_name'];

            $customer_id    = $this->session->userdata('id');

            $cur_datetime = new DateTime('now');

            $data = [
                'order_id'          => $order_id,
                'customer_id'       => $customer_id,
                'path_image'        => $path_image,
                'status_pembayaran' => 'menunggu verifikasi',
                'jenis_pembayaran'  => 'dp',
                'created_at'        => $cur_datetime->format('Y-m-d H:i:s'),
                'created_by'        => $this->session->userdata('id'),
                'updated_at'        => $cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'        => $this->session->userdata('id'),
            ];
            $exec = $this->pembayaran_model->store_dp_2($data);
            if (!$exec) {
                $this->db->trans_rollback();
                show_error('Proses Pembayaran Gagal', 500, "Terjadi Kesalahan");
                exit;
            }

            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Upload Bukti Pembayaran DP Berhasil');
            session_write_close();
            redirect(base_url() . 'shop/list_order', 'location');
        }
    }

    public function check_pembayaran_pelunasan()
    {
        $order_id = $this->input->get('order_id');
        $code     = $this->pembayaran_model->cek_pembayaran_pelunasan($order_id);
        echo json_encode(['code' => $code]);
    }

    public function store_pelunasan()
    {
        $this->db->trans_begin();

        $config['upload_path']   = './assets/img/pembayaran/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = 2048;
        $config['max_width']     = 0;
        $config['max_height']    = 0;
        $config['encrypt_name']  = true;
        $config['remove_spaces'] = true;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('path_image_pelunasan')) {
            $error = $this->upload->display_errors();
            show_error($error, 500, "Terjadi Kesalahan");
            exit;
        } else {
            $order_id = $this->input->post('id_pelunasan');

            $check = $this->order_model->count_customer_order_by_id($order_id);

            if ($check->num_rows() == 0) {
                $this->db->trans_rollback();
                show_error('Order tidak ditemukan', 500, "Terjadi Kesalahan");
                exit;
            }

            $image_data = $this->upload->data();
            $path_image = $image_data['file_name'];

            $customer_id    = $this->session->userdata('id');

            $cur_datetime = new DateTime('now');

            $data = [
                'order_id'          => $order_id,
                'customer_id'       => $customer_id,
                'path_image'        => $path_image,
                'status_pembayaran' => 'menunggu verifikasi',
                'jenis_pembayaran'  => 'pelunasan',
                'created_at'        => $cur_datetime->format('Y-m-d H:i:s'),
                'created_by'        => $this->session->userdata('id'),
                'updated_at'        => $cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'        => $this->session->userdata('id'),
            ];
            $exec = $this->pembayaran_model->store_pelunasan_2($data);
            if (!$exec) {
                $this->db->trans_rollback();
                show_error('Proses Pembayaran Gagal', 500, "Terjadi Kesalahan");
                exit;
            }

            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Upload Bukti Pembayaran Pelunasan Berhasil');
            session_write_close();
            redirect(base_url() . 'shop/list_order', 'location');
        }
    }
}
        
    /* End of file  Cshop.php */
