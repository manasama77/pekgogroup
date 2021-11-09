<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
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
            $this->load->view('login', $data);
        } else {
            $whatsapp = $this->input->post('whatsapp');
            $exec     = $this->Admin_model->get_single_data($whatsapp);
            $id       = $exec->row()->id;
            $name     = $exec->row()->name;
            $role     = $exec->row()->role;

            $sesi_admin = array(
                SESS_ADM . 'id'       => $id,
                SESS_ADM . 'whatsapp' => $whatsapp,
                SESS_ADM . 'name'     => $name,
                SESS_ADM . 'role'     => $role,
            );
            $this->session->set_userdata($sesi_admin);
            session_write_close();
            redirect('dashboard');
        }
    }

    public function whatsapp_check($whatsapp)
    {
        $check_admin = $this->Admin_model->whatsapp_check($whatsapp);

        if ($check_admin == false) {
            $this->form_validation->set_message('whatsapp_check', '{field} tidak ditemukan');
            return false;
        }

        return true;
    }

    public function password_check($password)
    {
        $whatsapp    = $this->input->post('whatsapp');
        $check_admin = $this->Admin_model->password_check($whatsapp, $password);

        if ($check_admin == 404) {
            return true;
        } elseif ($check_admin == false) {
            $this->form_validation->set_message('password_check', '{field} salah');
            return false;
        }
        return true;
    }

    public function logout()
    {
        $this->session->unset_userdata(SESS_ADM . 'id');
        $this->session->unset_userdata(SESS_ADM . 'whatsapp');
        $this->session->unset_userdata(SESS_ADM . 'name');
        $this->session->unset_userdata(SESS_ADM . 'role');
        session_write_close();
        redirect('login');
    }
}
