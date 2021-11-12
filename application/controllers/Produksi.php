<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produksi extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Produksi_model');
        $this->load->model('Customer_model');
        $this->load->model('Produk_model');
        $this->load->model('Karyawan_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris', 'produksi')) === false) {
            // redirect('logout', 'location');
            show_error('Kamu tidak memiliki akses', 403, 'Akses ditolak');
        }
    }

    public function index()
    {
        $product_id  = ($this->input->get('product_id')) ?? null;
        $customer_id = ($this->input->get('customer_id')) ?? null;
        $field       = ($this->input->get('field')) ?? null;
        $keyword     = ($this->input->get('keyword')) ?? null;

        $list = null;

        if ($product_id != null) {
            $list = $this->Produksi_model->get_all_data($product_id, $customer_id, $field, $keyword);
        }

        $products                 = $this->Produk_model->get_all_data();
        $customers                = $this->Customer_model->get_all_data();
        $list_petugas_potong_kain = $this->Karyawan_model->get_all_petugas('potong kain');
        $list_petugas_penjahit    = $this->Karyawan_model->get_all_petugas('penjahit');
        $list_petugas_qc_1        = $this->Karyawan_model->get_all_petugas('qc');
        $list_petugas_aksesoris   = $this->Karyawan_model->get_all_petugas('aksesoris');
        $list_petugas_qc_2        = $this->Karyawan_model->get_all_petugas('qc');

        $data = array(
            'title'                    => 'Order',
            'page'                     => 'produksi/main',
            'vitamin'                  => 'produksi/main_vitamin',
            'list'                     => $list,
            'list_petugas_potong_kain' => $list_petugas_potong_kain,
            'list_petugas_penjahit'    => $list_petugas_penjahit,
            'list_petugas_qc_1'        => $list_petugas_qc_1,
            'list_petugas_aksesoris'   => $list_petugas_aksesoris,
            'list_petugas_qc_2'        => $list_petugas_qc_2,
            'products'                 => $products,
            'customers'                => $customers,
            'error'                    => null,
        );
        $this->theme->render($data);
    }

    public function print($id)
    {
        $exec = $this->Produksi_model->generate_data_produksi($id);
        $this->load->view('data_produksi', $exec, FALSE);
    }

    public function store_history()
    {
        $order_id            = $this->input->post('order_id');
        $petugas_potong_kain = ($this->input->post('petugas_potong_kain') != null) ? $this->input->post('petugas_potong_kain') : null;
        $tanggal_potong_kain = ($this->input->post('tanggal_potong_kain') != null) ? $this->input->post('tanggal_potong_kain') : null;
        $petugas_jahit       = ($this->input->post('petugas_jahit') != null) ? $this->input->post('petugas_jahit') : null;
        $tanggal_jahit       = ($this->input->post('tanggal_jahit') != null) ? $this->input->post('tanggal_jahit') : null;
        $petugas_qc_1        = ($this->input->post('petugas_qc_1') != null) ? $this->input->post('petugas_qc_1') : null;
        $tanggal_qc_1        = ($this->input->post('tanggal_qc_1') != null) ? $this->input->post('tanggal_qc_1') : null;
        $petugas_aksesoris   = ($this->input->post('petugas_aksesoris') != null) ? $this->input->post('petugas_aksesoris') : null;
        $tanggal_aksesoris   = ($this->input->post('tanggal_aksesoris') != null) ? $this->input->post('tanggal_aksesoris') : null;
        $petugas_qc_2        = ($this->input->post('petugas_qc_2') != null) ? $this->input->post('petugas_qc_2') : null;
        $tanggal_qc_2        = ($this->input->post('tanggal_qc_2') != null) ? $this->input->post('tanggal_qc_2') : null;

        $data_1 = [
            'order_id'            => $order_id,
            'petugas_potong_kain' => $petugas_potong_kain,
            'tanggal_potong_kain' => $tanggal_potong_kain,
            'petugas_jahit'       => $petugas_jahit,
            'tanggal_jahit'       => $tanggal_jahit,
            'petugas_qc_1'        => $petugas_qc_1,
            'tanggal_qc_1'        => $tanggal_qc_1,
            'petugas_aksesoris'   => $petugas_aksesoris,
            'tanggal_aksesoris'   => $tanggal_aksesoris,
            'petugas_qc_2'        => $petugas_qc_2,
            'tanggal_qc_2'        => $tanggal_qc_2,
            'created_at'          => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by'          => $this->session->userdata(SESS_ADM . 'id'),
            'updated_at'          => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'          => $this->session->userdata(SESS_ADM . 'id'),
        ];

        $data_2 = [
            'order_id'            => $order_id,
            'petugas_potong_kain' => $petugas_potong_kain,
            'tanggal_potong_kain' => $tanggal_potong_kain,
            'petugas_jahit'       => $petugas_jahit,
            'tanggal_jahit'       => $tanggal_jahit,
            'petugas_qc_1'        => $petugas_qc_1,
            'tanggal_qc_1'        => $tanggal_qc_1,
            'petugas_aksesoris'   => $petugas_aksesoris,
            'tanggal_aksesoris'   => $tanggal_aksesoris,
            'petugas_qc_2'        => $petugas_qc_2,
            'tanggal_qc_2'        => $tanggal_qc_2,
            'updated_at'          => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'          => $this->session->userdata(SESS_ADM . 'id'),
        ];

        $exec = $this->Produksi_model->store_history($order_id, $data_1, $data_2);

        $code = 200;
        if (!$exec) {
            $code = 500;
        }

        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  Produksi.php */
