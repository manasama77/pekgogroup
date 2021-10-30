<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Customer_model');
        $this->cur_datetime = new DateTime('now');
    }

    public function index()
    {
        $field   = ($this->input->get('field')) ? $this->input->get('field') : null;
        $status  = ($this->input->get('status')) ? $this->input->get('status') : null;
        $keyword = ($this->input->get('keyword')) ? trim($this->input->get('keyword')) : '';

        $list = $this->Customer_model->get_all_data($field, $status, $keyword);

        $field_show = '';
        $status_show = '';

        if ($field != null) {
            if ($field == 'all') {
                $field_show = "SEMUA";
            } elseif ($field == 'id_tokped') {
                $field_show = "ID TOKPED";
            } elseif ($field == 'id_shopee') {
                $field_show = "ID SHOPEE";
            } elseif ($field == 'id_instagram') {
                $field_show = "ID INSTAGRAM";
            } else {
                $field_show = strtoupper($field);
            }
        }

        if ($status != null) {
            $status_show = strtoupper($status);
        }

        $data = array(
            'title'        => 'Customer',
            'page'         => 'customer/main',
            'vitamin'      => 'customer/main_vitamin',
            'field_show'   => $field_show,
            'status_show'  => $status_show,
            'keyword_show' => $keyword,
            'list'         => $list,
            'error'        => null,
        );
        $this->theme->render($data);
    }

    public function add()
    {
        $this->form_validation->set_rules('whatsapp', 'WHATSAPP', 'required|is_unique[customers.whatsapp]');
        $this->form_validation->set_rules('password', 'PASSWORD', 'required');
        $this->form_validation->set_rules('password_verifikasi', 'PASSWORD VERIFIKASI', 'required|matches[password]');
        $this->form_validation->set_rules('name', 'NAMA', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $data = array(
                'title'   => 'Customer',
                'page'    => 'customer/form',
                'csrf'    => $csrf,
                'error'   => null,
            );
            $this->theme->render($data);
        } else {
            $this->store();
        }
    }

    protected function store()
    {
        $whatsapp     = $this->input->post('whatsapp');
        $password     = PASSWORD_HASH($this->input->post('password') . HASH_SLING_SLICER, PASSWORD_BCRYPT);
        $name         = $this->input->post('name');
        $id_tokped    = $this->input->post('id_tokped');
        $id_shopee    = $this->input->post('id_shopee');
        $id_instagram = $this->input->post('id_instagram');

        $data = array(
            'whatsapp'     => $whatsapp,
            'password'     => $password,
            'name'         => $name,
            'id_tokped'    => $id_tokped,
            'id_shopee'    => $id_shopee,
            'id_instagram' => $id_instagram,
            'created_at'   => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_at'   => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by'   => $this->session->userdata('id'),
            'updated_by'   => $this->session->userdata('id'),
        );
        $exec = $this->Customer_model->store($data);

        if (!$exec) {
            echo "Tambah Customer gagal, silahkan coba kembali!";
        }

        $this->session->set_flashdata('success', 'Tambah Customer Berhasil');
        session_write_close();
        redirect(base_url() . 'customer/index', 'location');
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('whatsapp', 'WHATSAPP', 'required');
        $this->form_validation->set_rules('name', 'NAMA', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $list = $this->Customer_model->get_single_data('id', $id);
            $data = array(
                'title' => 'Customer Edit',
                'page'  => 'customer/form_edit',
                'csrf'  => $csrf,
                'list'  => $list,
                'error' => null,
            );
            $this->theme->render($data);
        } else {
            $this->update($id);
        }
    }

    protected function update($id)
    {
        $data  = array(
            'name'         => $this->input->post('name'),
            'id_tokped'    => $this->input->post('id_tokped'),
            'id_shopee'    => $this->input->post('id_shopee'),
            'id_instagram' => $this->input->post('id_instagram'),
            'updated_at'   => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'   => $this->session->userdata('id'),
        );
        $where = array('id' => $id);
        $exec  = $this->Customer_model->update($data, $where);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Edit Customer Gagal');
            session_write_close();
            redirect(base_url() . 'customer/index', 'location');
        }

        $this->session->set_flashdata('success', 'Edit Customer Berhasil');
        session_write_close();
        redirect(base_url() . 'customer/index', 'location');
    }

    public function destroy($id)
    {
        $data  = array(
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata('id'),
        );
        $where = array('id' => $id);
        $exec  = $this->Customer_model->destroy($data, $where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function status($status, $id)
    {
        $new_status = ($status == 'aktifkan') ? 'aktif' : 'tidak aktif';
        $data  = array(
            'status'     => $new_status,
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id'),
        );
        $where = array('customers.id' => $id);
        $exec  = $this->Customer_model->update($data, $where);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Update status customer Gagal');
            session_write_close();
            redirect($_SERVER['HTTP_REFERER'], 'location');
        }

        $this->session->set_flashdata('success', 'Update status customer Berhasil');
        session_write_close();
        redirect($_SERVER['HTTP_REFERER'], 'location');
    }

    public function blokir()
    {
        $id              = $this->input->post('id');
        $reason_inactive = trim($this->input->post('reason_inactive'));

        $data = array(
            'status'          => 'tidak aktif',
            'reason_inactive' => $reason_inactive,
            'updated_at'      => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'      => $this->session->userdata('id'),
        );

        $where = array('id' => $id);
        $exec  = $this->Customer_model->update($data, $where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function show($id)
    {
        $exec = $this->Customer_model->get_single_data('id', $id);

        if (!$exec) {
            $return = [
                'code' => 500,
                'data' => null,
            ];
        }

        $return = [
            'code' => 200,
            'data' => $exec->result(),
            'id' => $id,
            'lq' => $this->db->last_query()
        ];

        echo json_encode($return);
    }
}
        
    /* End of file  Customer.php */
