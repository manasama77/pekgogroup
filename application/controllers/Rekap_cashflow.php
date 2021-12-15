<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekap_cashflow extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Cashflow_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $tahun = ($this->input->get('tahun')) ?? null;

        $list = null;
        if ($tahun != null) {
            $list = $this->Cashflow_model->render_rekap($tahun);
        }
        $data = array(
            'title'   => 'REKAP CASHFLOW ' . $tahun,
            'page'    => 'rekap_cashflow/main',
            'vitamin' => 'rekap_cashflow/main_vitamin',
            'tahun'   => $tahun,
            'list'    => $list,
        );
        $this->theme->render($data);
    }

    public function add()
    {
        $accounts = $this->Cashflow_model->render_account_list();
        $data = array(
            'title'    => 'TAMBAH CASHFLOW BANK BCA',
            'page'     => 'cashflow_mandiri/form',
            'vitamin'  => 'cashflow_mandiri/form_vitamin',
            'accounts' => $accounts,
        );
        $this->theme->render($data);
    }

    public function store()
    {
        $tanggal    = $this->input->post('tanggal');
        $account_id = $this->input->post('account_id');
        $no_voucher = $this->input->post('no_voucher');
        $dari_untuk = $this->input->post('dari_untuk');
        $keterangan = $this->input->post('keterangan');
        $debet      = $this->input->post('debet');
        $kredit     = $this->input->post('kredit');

        $data = array(
            'tanggal'        => $tanggal,
            'account_id'     => $account_id,
            'no_voucher'     => $no_voucher,
            'dari_untuk'     => $dari_untuk,
            'keterangan'     => $keterangan,
            'debet'          => $debet,
            'kredit'         => $kredit,
            'jenis_cashflow' => 'mandiri',
            'created_at'     => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_at'     => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by'     => $this->session->userdata(SESS_ADM . 'id'),
            'updated_by'     => $this->session->userdata(SESS_ADM . 'id'),
        );
        $exec = $this->Cashflow_model->store($data);

        if (!$exec) {
            $code = 500;
        } else {
            $code = 200;
        }

        echo json_encode(['code' => $code]);
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
        $exec = $this->Cashflow_model->destroy($data, $where);
        $code = ($exec) ? 200 : 500;
        echo json_encode(['code' => $code]);
    }

    public function render()
    {
        $tanggal        = $this->input->get('tanggal');
        $tgl_obj        = new DateTime($tanggal);
        $jenis_cashflow = 'mandiri';

        $exec = $this->Cashflow_model->get_monthly_data($tgl_obj->format('m'), $tgl_obj->format('Y'), $jenis_cashflow);

        echo json_encode($exec);
    }
}
        
    /* End of file  Rekap_cashflow.php */
