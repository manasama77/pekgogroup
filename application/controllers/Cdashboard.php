<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cdashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Customer_auth', null, 'auth');
        $this->load->library('Customer_template', null, 'theme');
        $this->load->model('Cdashboard_model');

        $this->auth->check_session();
    }

    public function index()
    {
        $total_order = $this->Cdashboard_model->get_total_order();

        $data = array(
            'title'       => 'Dashboard',
            'page'        => 'dashboard/main',
            'total_order' => $total_order,
        );
        $this->theme->render($data);
    }
}
        
    /* End of file  Cdashboard.php */
