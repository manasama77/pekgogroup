<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengiriman extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Pengiriman_model');
        $this->load->model('Customer_model');
        $this->load->model('Produk_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata(SESS_ADM . 'role'), array('owner', 'developer', 'komisaris', 'order')) === false) {
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
            $list = $this->Pengiriman_model->get_all_data($product_id, $customer_id, $field, $keyword);
        }

        $products  = $this->Produk_model->get_all_data();
        $customers = $this->Customer_model->get_all_data();

        $data = array(
            'title'     => 'Pengiriman',
            'page'      => 'pengiriman/main',
            'vitamin'   => 'pengiriman/main_vitamin',
            'list'      => $list,
            'products'  => $products,
            'customers' => $customers,
            'error'     => null,
        );
        $this->theme->render($data);
    }

    public function cek_data_pengiriman()
    {
        $id     = $this->input->get('id');
        $exec   = $this->Pengiriman_model->get_data_pengiriman($id);
        $return = array('code' => $exec);
        echo json_encode($return);
    }

    public function store()
    {
        $order_id           = $this->input->post('id_order');
        $tanggal_pengiriman = $this->input->post('tanggal_pengiriman');
        $ekspedisi          = $this->input->post('ekspedisi');
        $no_resi            = $this->input->post('no_resi');
        $alamat_pengiriman  = $this->input->post('alamat_pengiriman');
        $exec               = $this->Pengiriman_model->store($order_id, $tanggal_pengiriman, $ekspedisi, $no_resi, $alamat_pengiriman);
        $code = ($exec) ? 200 : 500;
        echo json_encode(['code' => $code]);
    }

    public function track()
    {
        header('Content-Type: application/json; charset=utf-8');
        $no_resi   = $this->input->get('no_resi');
        $ekspedisi = strtolower($this->input->get('ekspedisi'));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "waybill=" . $no_resi . "&courier=" . $ekspedisi,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key:" . RAJAONGKIR_API_KEY
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo $err;
            exit;
        } else {
            echo $response;
            exit;
        }
    }

    public function selesai()
    {
        $id   = $this->input->post('id');
        $exec = $this->Pengiriman_model->selesai($id);
        $code = ($exec) ? 200 : 500;
        echo json_encode(['code' => $code]);
    }
}
        
    /* End of file  Pengiriman.php */
