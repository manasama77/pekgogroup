<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Init extends CI_Controller
{

    public function admin()
    {
        $this->load->model('Admin_model');
        $exec = $this->Admin_model->init_admin();
        if ($exec === false) {
            echo "proses init admin gagal" . PHP_EOL;
        } else {
            echo "proses init admin berhasil" . PHP_EOL;
        }
    }
}
        
    /* End of file  Init.php */
