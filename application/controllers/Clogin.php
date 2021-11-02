<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clogin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('whatsapp', 'Whatsapp', 'required|callback_whatsapp_check');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');

        if ($this->form_validation->run() == FALSE) {
            $data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view('clogin', $data);
        } else {
            $whatsapp = $this->input->post('whatsapp');
            $exec     = $this->Customer_model->get_single_data('whatsapp', $whatsapp);
            $id       = $exec->row()->id;
            $name     = $exec->row()->name;

            $sesi_customer = array(
                'id'       => $id,
                'whatsapp' => $whatsapp,
                'name'     => $name,
            );
            $this->session->set_userdata($sesi_customer);
            session_write_close();
            redirect('cdashboard');
        }
    }

    public function whatsapp_check($whatsapp)
    {
        $check_customer = $this->Customer_model->whatsapp_check($whatsapp);

        if ($check_customer == false) {
            $this->form_validation->set_message('whatsapp_check', '{field} tidak ditemukan');
            return false;
        }

        return true;
    }

    public function password_check($password)
    {
        $whatsapp    = $this->input->post('whatsapp');
        $check_customer = $this->Customer_model->password_check($whatsapp, $password);

        if ($check_customer == 404) {
            return true;
        } elseif ($check_customer == false) {
            $this->form_validation->set_message('password_check', '{field} salah');
            return false;
        }
        return true;
    }

    public function logout()
    {
        $this->session->sess_destroy();
        session_write_close();
        redirect('clogin');
    }
}
