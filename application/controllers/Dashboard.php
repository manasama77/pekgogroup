<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
    }

    public function index()
    {
        $data = array(
            'page' => 'dashboard/main'
        );
        $this->theme->render($data);
    }
}
        
    /* End of file  Dashboard.php */
