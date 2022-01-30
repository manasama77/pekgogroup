<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Account_model');
        $this->load->model('Account_group_model');
        $this->load->model('Satuan_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('no_akun', 'NO AKUN', 'required|is_unique[accounts.no_akun]', [
            'is_unique' => 'No Akun telah digunakan, silahkan gunakan No Akun lain'
        ]);
        $this->form_validation->set_rules('nama_akun', 'NAMA AKUN', 'required|is_unique[accounts.nama_akun]', [
            'is_unique' => 'Nama Akun telah digunakan, silahkan gunakan Nama Akun lain'
        ]);
        $this->form_validation->set_rules('account_group_id', 'KELOMPOK AKUN', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $account_groups = $this->Account_group_model->get_all_data();
            $list           = $this->Account_model->get_all_data();
            $data = array(
                'title'          => 'AKUN',
                'page'           => 'account/main',
                'vitamin'        => 'account/main_vitamin',
                'csrf'           => $csrf,
                'account_groups' => $account_groups,
                'list'           => $list,
                'error'          => null,
            );
            $this->theme->render($data);
        } else {
            $this->store();
        }
    }

    protected function store()
    {
        $no_akun          = $this->input->post('no_akun');
        $nama_akun        = $this->input->post('nama_akun');
        $account_group_id = $this->input->post('account_group_id');

        $data = array(
            'no_akun'          => $no_akun,
            'nama_akun'        => $nama_akun,
            'account_group_id' => $account_group_id,
            'created_at'       => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_at'       => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by'       => $this->session->userdata(SESS_ADM . 'id'),
            'updated_by'       => $this->session->userdata(SESS_ADM . 'id'),
        );
        $exec = $this->Account_model->store($data);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Tambah Account Gagal');
            redirect(base_url() . 'account/index', 'location');
        }

        $this->session->set_flashdata('success', 'Tambah Account Berhasil');
        redirect(base_url() . 'account/index', 'location');
    }

    public function update()
    {
        $id               = $this->input->post('xid');
        $no_akun          = $this->input->post('xno_akun');
        $nama_akun        = $this->input->post('xnama_akun');
        $account_group_id = $this->input->post('xaccount_group_id');

        $data = array(
            'no_akun'          => $no_akun,
            'nama_akun'        => $nama_akun,
            'account_group_id' => $account_group_id,
            'updated_at'       => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'       => $this->session->userdata(SESS_ADM . 'id'),
        );
        $where = array('id' => $id);
        $exec = $this->Account_model->update($data, $where);

        if (!$exec) {
            echo "Update data gagal, silahkan coba kembali!";
        }

        $this->session->set_flashdata('success', 'Update Account Berhasil');
        redirect(base_url() . 'account/index', 'location');
    }

    public function destroy($id)
    {
        $data = [
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['id' => $id];
        $exec = $this->Account_model->destroy($data, $where);
        $code = ($exec) ? 200 : 500;
        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  Account.php */
