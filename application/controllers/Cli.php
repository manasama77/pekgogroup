<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cli extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cli_model');
    }

    public function check_expired()
    {
        $this->Cli_model->check_expired();
        // if ($this->input->is_cli_request()) {
        //     $this->Cli_model->check_expired();
        // } else {
        //     echo "Access Denied" . PHP_EOL;
        // }
    }

    public function check_resi()
    {
        $exec = $this->Cli_model->check_resi();
        // if ($this->input->is_cli_request()) {
        // } else {
        //     echo "Access Denied" . PHP_EOL;
        // }
    }
}
        
    /* End of file  Cli.php */
