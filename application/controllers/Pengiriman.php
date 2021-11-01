<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengiriman extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Pengiriman_model');
        $this->load->model('Customer_model');
        $this->load->model('Produk_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata('role'), array('owner', 'developer', 'komisaris', 'order')) === false) {
            // redirect('logout', 'location');
            show_error('Kamu tidak memiliki akses', 403, 'Akses ditolak');
        }
    }

    public function index()
    {
        $product_id  = ($this->input->get('product_id')) ?? null;
        $customer_id = ($this->input->get('customer_id')) ?? null;
        $field       = ($this->input->get('field')) ?? null;
        $keyword     = ($this->input->get('keyword')) ?? null;

        $list = null;

        if ($product_id != null) {
            $list = $this->Pengiriman_model->get_all_data($product_id, $customer_id, $field, $keyword);
        }

        $products  = $this->Produk_model->get_all_data();
        $customers = $this->Customer_model->get_all_data();

        $data = array(
            'title'     => 'Pengiriman',
            'page'      => 'Pengiriman/main',
            'vitamin'   => 'Pengiriman/main_vitamin',
            'list'      => $list,
            'products'  => $products,
            'customers' => $customers,
            'error'     => null,
        );
        $this->theme->render($data);
    }

    public function cek_data_pengiriman()
    {
        $id     = $this->input->get('id');
        $exec   = $this->Pengiriman_model->get_data_pengiriman($id);
        $return = array('code' => $exec);
        echo json_encode($return);
    }
}
        
    /* End of file  Pengiriman.php */
