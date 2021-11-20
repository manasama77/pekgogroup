<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Hpp extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Hpp_model');
        $this->load->model('Satuan_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('name', 'NAMA HPP', 'required');
        $this->form_validation->set_rules('cost', 'HPP', 'required|numeric');
        $this->form_validation->set_rules('unit_id', 'SATUAN', 'required');
        $this->form_validation->set_rules('supplier', 'SUPPLIER', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $list  = $this->Hpp_model->get_all_data();
            $units = $this->Satuan_model->get_all_data();
            $data = array(
                'title'   => 'HPP',
                'page'    => 'hpp/main',
                'vitamin' => 'hpp/main_vitamin',
                'csrf'    => $csrf,
                'list'    => $list,
                'units'   => $units,
                'error'   => null,
            );
            $this->theme->render($data);
        } else {
            $this->store();
        }
    }

    protected function store()
    {
        $name     = $this->input->post('name');
        $cost     = $this->input->post('cost');
        $unit_id  = $this->input->post('unit_id');
        $supplier = $this->input->post('supplier');

        $data = array(
            'name'       => $name,
            'cost'       => $cost,
            'unit_id'    => $unit_id,
            'supplier'   => $supplier,
            'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata(SESS_ADM . 'id'),
            'updated_by' => $this->session->userdata(SESS_ADM . 'id'),
        );
        $exec = $this->Hpp_model->store($data);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Tambah Hpp Gagal');
            session_write_close();
            redirect(base_url() . 'setup/hpp', 'location');
        }

        $this->session->set_flashdata('success', 'Tambah Hpp Berhasil');
        session_write_close();
        redirect(base_url() . 'setup/hpp', 'location');
    }

    public function update()
    {
        $id       = $this->input->post('xid');
        $name     = $this->input->post('xname');
        $cost     = $this->input->post('xcost');
        $unit_id  = $this->input->post('xunit_id');
        $supplier = $this->input->post('xsupplier');

        $data = array(
            'name'       => $name,
            'cost'       => $cost,
            'unit_id'    => $unit_id,
            'supplier'   => $supplier,
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata(SESS_ADM . 'id'),
        );
        $where = array('id' => $id);
        $exec = $this->Hpp_model->update($data, $where);

        if (!$exec) {
            echo "Update data gagal, silahkan coba kembali!";
        }

        $this->session->set_flashdata('success', 'Update HPP Berhasil');
        session_write_close();
        redirect(base_url() . 'setup/hpp', 'location');
    }

    public function destroy($id)
    {
        $data = [
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['id' => $id];
        $exec = $this->Hpp_model->destroy($data, $where);
        $code = ($exec) ? 200 : 500;
        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  Hpp.php */
