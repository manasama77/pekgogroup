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

        $data = [
            'project_id'            => $project_id,
            'sales_invoice'         => '',
            'durasi_batas_transfer' => 3,
            'batas_waktu_transfer'  => $batas_waktu_transfer_obj->format('Y-m-d H:i:s'),
            'estimasi_selesai'      => $estimasi_selesai_obj->format('Y-m-d H:i:s'),
            'order_via'             => 'web',
            'product_id'            => $product_id,
            'color_id'              => $this->input->post('color_id'),
            'size_id'               => $this->input->post('size_id'),
            'pilih_jahitan'         => $this->input->post('pilih_jahitan'),
            'catatan'               => null,
            'customer_id'           => $this->session->userdata('id'),
            'whatsapp'              => $customers->row()->whatsapp,
            'id_tokped'             => $customers->row()->id_tokped,
            'id_shopee'             => $customers->row()->id_shopee,
            'id_instagram'          => $customers->row()->id_instagram,
            'status_order'          => 'order dibuat',
            'status_pembayaran'     => 'menunggu pembayaran',
            'status_pengiriman'     => 'antrian',
            'sub_total'             => 0,
            'kode_unik'             => 0,
            'grand_total'           => 0,
            'jenis_dp'              => 30,
            'dp_value'              => 0,
            'pelunasan_value'       => 0,
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
        $customer_id = $this->session->userdata('id');
        $customers = $this->customer_model->get_single_data('id', $customer_id);
        $exec = $this->order_model->get_temp_order($customer_id);

        // echo '<pre>' . print_r($exec->result(), 1) . '</pre>';
        // exit;

        $projects     = $this->project_model->get_single_data('PKG');
        $requests     = $this->produk_model->get_product_request('product_request_params.product_id', $exec->row()->product_id);

        $data = [
            'page_title' => 'Shop',
            'page'       => 'shop/request',
            'vitamin'    => 'shop/request_vitamin',
            'customers'  => $customers,
            'projects'   => $projects,
            'requests'   => $requests,
        ];
        $this->load->view('template/customer/master', $data);
    }
}
        
    /* End of file  Cshop.php */
