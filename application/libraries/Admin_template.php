<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_template
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function render($data)
    {
        $this->CI->load->model('Project_model');
        $project_data = $this->CI->Project_model->get_single_data(APP_ABBR);
        $data['theme_name'] = $project_data['name'];
        $data['theme_logo'] = $project_data['logo'];
        $this->CI->load->view('admin_template', $data);
    }
}
                                                
/* End of file Admin_template.php */
