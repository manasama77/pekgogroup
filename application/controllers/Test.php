<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    public function index()
    {
        $this->session->set_flashdata('error', "error");
        redirect('produk/add', 'refresh');
        // $this->load->view('test');
    }

    public function upload()
    {
        $config['upload_path']   = './assets/img/products/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = 2048;
        $config['max_width']     = 0;
        $config['max_height']    = 0;
        $config['encrypt_name']  = true;
        $config['remove_spaces'] = true;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('path_image')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            redirect(base_url() . 'test', 'auto');
        } else {
            $image_data = $this->upload->data();
            $path_image = $image_data['file_name'];

            if ($_FILES['path_image_2']['size'] > 0) {
                if (!$this->upload->do_upload('path_image_2')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect(base_url() . 'test', 'auto');
                }
            } else {
                $image_data_2 = $this->upload->data();
                $path_image_2 = $image_data_2['file_name'];
            }

            if ($_FILES['path_image_3']['size'] > 0) {
                if (!$this->upload->do_upload('path_image_3')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect(base_url() . 'test', 'auto');
                }
            } else {
                $image_data_3 = $this->upload->data();
                $path_image_3 = $image_data_3['file_name'];
            }

            $this->session->set_flashdata('success', $path_image . " - " . $path_image_2 . " - " . $path_image_3);
            redirect(base_url() . 'test', 'auto');
        }
    }
}
        
    /* End of file  Test.php */
