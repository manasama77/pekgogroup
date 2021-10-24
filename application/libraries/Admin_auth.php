<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_auth
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function check_session()
    {
        $this->CI->load->model('Admin_model');

        if (!$this->CI->session->userdata()) {
            redirect('logout');
        } elseif ($this->CI->session->userdata('id') == null && $this->CI->session->userdata('whatsapp') == null && $this->CI->session->userdata('role') == null) {
            redirect('logout');
        } else {
            $whatsapp = $this->CI->session->userdata('whatsapp');
            $exec     = $this->CI->Admin_model->get_single_data($whatsapp);

            if ($exec->num_rows() == 0 || $exec->num_rows() > 1) {
                redirect('logout');
                exit;
            }

            // regenerate role
            $this->CI->session->set_userdata('role', $exec->row()->role);

            // update datetime log
            $this->CI->Admin_model->update_log($exec->row()->id, $whatsapp);
        }
    }
}
                                                
/* End of file AdminAuth.php */
