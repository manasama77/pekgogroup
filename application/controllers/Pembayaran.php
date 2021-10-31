<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Pembayaran_model');
        $this->load->model('Customer_model');
        $this->load->model('Produk_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata('role'), array('owner', 'developer', 'komisaris', 'finance')) === false) {
            redirect('logout', 'location');
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
            $list = $this->Pembayaran_model->get_all_data($product_id, $customer_id, $field, $keyword);
        }

        $products  = $this->Produk_model->get_all_data();
        $customers = $this->Customer_model->get_all_data();

        $data = array(
            'title'     => 'Order',
            'page'      => 'pembayaran/main',
            'vitamin'   => 'pembayaran/main_vitamin',
            'list'      => $list,
            'products'  => $products,
            'customers' => $customers,
            'error'     => null,
        );
        $this->theme->render($data);
    }

    public function verifikasi_dp()
    {
        $id   = $this->input->get('id');
        $exec = $this->Pembayaran_model->get_data_dp($id);

        if (!$exec) {
            $return = array('code' => 500);
        } else {
            if ($exec->num_rows() == 0) {
                $return = array('code' => 404);
            } else {
                $return = array('code' => 200, 'data' => $exec->result());
            }
        }

        echo json_encode($return);
    }

    public function approve_dp()
    {
        $id       = $this->input->post('id');
        $order_id = $this->input->post('order_id');

        $exec = $this->Pembayaran_model->approve_dp($id, $order_id);

        if (!$exec) {
            $return = array('code' => 500);
        } else {
            $return = array('code' => 200);
        }

        echo json_encode($return);
    }
}
        
    /* End of file  Pembayaran.php */
