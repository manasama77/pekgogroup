<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->load->model('Dashboard_model');

        $this->auth->check_session();
    }

    public function index()
    {
        $total_order          = $this->Dashboard_model->get_total_order_this_month();
        $pendapatan           = $this->Dashboard_model->get_pendapatan_this_month();
        $total_customers      = $this->Dashboard_model->get_total_customers();
        $customers_this_month = $this->Dashboard_model->get_total_customers_this_month();

        $data = array(
            'title'                => 'Dashboard',
            'page'                 => 'dashboard/main',
            'vitamin'              => 'dashboard/main_vitamin',
            'total_order'          => $total_order,
            'pendapatan'           => $pendapatan,
            'total_customers'      => $total_customers,
            'customers_this_month' => $customers_this_month,
        );
        $this->theme->render($data);
    }

    public function show_track()
    {
        $sales_invoice = $this->input->get('sales_invoice');
        $data          = $this->Dashboard_model->get_track($sales_invoice);

        echo json_encode(['data' => $data]);
    }
}
        
    /* End of file  Dashboard.php */
