<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cproduk extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Customer_auth', null, 'auth');
        $this->load->library('Customer_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Produk_model');
        $this->load->model('Warna_model');
        $this->load->model('Ukuran_model');
        $this->load->model('Request_model');
        $this->load->model('Hpp_model');
        $this->cur_datetime = new DateTime('now');
    }

    public function show($id)
    {
        $exec = $this->Produk_model->get_detail_for_order($id);

        if (!$exec) {
            $return = [
                'code' => 500,
                'data' => null,
            ];
        }

        $return = [
            'code' => 200,
            'data' => $exec,
        ];

        echo json_encode($return);
    }
}
        
    /* End of file  Cproduk.php */
