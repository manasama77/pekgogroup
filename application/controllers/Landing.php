<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model', 'project_model');
        $this->load->model('Produk_model', 'produk_model');
        $this->load->library('pagination');
    }


    public function index()
    {
        $projects = $this->project_model->get_single_data('PKG');
        $products = $this->produk_model->get_all_data();
        // echo '<pre>' . print_r($products, 1) . '</pre>';
        // exit;


        $config['base_url']   = base_url();
        $config['total_rows'] = $products['num_rows'];
        $config['per_page']   = 1;
        $this->pagination->initialize($config);

        $data = [
            'page_title' => 'Home',
            'page'       => 'home/index',
            'projects'   => $projects,
            'products'   => $products,
        ];
        $this->load->view('template/customer/master', $data);
    }
}
        
    /* End of file  Landing.php */
