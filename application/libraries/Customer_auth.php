<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_auth
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function check_session()
    {
        $this->CI->load->model('Customer_model');

        if (!$this->CI->session->userdata()) {
            redirect('clogout');
        } elseif ($this->CI->session->userdata('id') == null && $this->CI->session->userdata('whatsapp') == null) {
            redirect('clogout');
        } else {
            $whatsapp = $this->CI->session->userdata('whatsapp');
            $exec     = $this->CI->Customer_model->get_single_data('whatsapp', $whatsapp);

            if ($exec->num_rows() == 0 || $exec->num_rows() > 1) {
                redirect('clogout');
                exit;
            }

            // update datetime log
            $this->CI->Customer_model->update_log($exec->row()->id, $whatsapp);
        }
    }
}
                                                
/* End of file Customer_auth.php */
