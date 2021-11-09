<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cabout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model', 'project_model');
    }

    public function index()
    {
        $projects = $this->project_model->get_single_data('PKG');

        $data = [
            'page_title' => 'About US',
            'page'       => 'about/index',
            'projects'   => $projects,
        ];
        $this->load->view('template/customer/master', $data);
    }
}
        
    /* End of file  Cabout.php */
