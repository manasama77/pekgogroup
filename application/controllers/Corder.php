<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Corder extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Customer_auth', null, 'auth');
        $this->load->library('Customer_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Order_model');
        $this->load->model('Project_model');
        $this->load->model('Produk_model');
        $this->load->model('Customer_model');
        $this->load->model('Warna_model');
        $this->load->model('Ukuran_model');
        $this->load->model('Request_model');
        $this->load->model('Hpp_model');
        $this->load->model('Customer_model');
        $this->load->model('Pembayaran_model');
        $this->cur_datetime = new DateTime('now');
    }

    public function index()
    {
        $list = $this->Order_model->customer_get_all_data();

        $data = array(
            'title'   => 'Order',
            'page'    => 'order/main',
            'vitamin' => 'order/main_vitamin',
            'list'    => $list,
            'error'   => null,
        );
        $this->theme->render($data);
    }

    public function add()
    {
        $this->form_validation->set_rules('sales_invoice', 'SALES INVOICE', 'required');
        $this->form_validation->set_rules('created_at', 'TANGGAL & JAM ORDER', 'required');
        $this->form_validation->set_rules('durasi_batas_transfer', 'DURASI BATAS TRANSFER', 'required');
        $this->form_validation->set_rules('batas_waktu_transfer', 'BATAS WAKTU TRANSFER', 'required');
        $this->form_validation->set_rules('product_id', 'PRODUK', 'required');
        $this->form_validation->set_rules('color_id', 'WARNA', 'required');
        $this->form_validation->set_rules('size_id', 'UKURAN', 'required');
        $this->form_validation->set_rules('pilih_jahitan', 'JAHITAN', 'required');
        $this->form_validation->set_rules('estimasi_selesai', 'ESTIMASI SELESAI', 'required');
        $this->form_validation->set_rules('jenis_dp', 'JENIS DP', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );

            $this->Order_model->clear_temp();
            $this->Order_model->clear_request();

            $exec_code            = $this->Order_model->generate_sales_invoice();
            $id_order             = $exec_code['id_order'];
            $sales_invoice        = $exec_code['sales_invoice'];
            $kode_unik            = $exec_code['kode_unik'];
            $created_at           = $exec_code['created_at'];
            $batas_waktu_transfer = $exec_code['batas_waktu_transfer'];
            $estimasi_selesai     = $exec_code['estimasi_selesai'];
            $products             = $this->Produk_model->get_all_data();

            $data = array(
                'title'                => 'Order',
                'page'                 => 'order/form',
                'vitamin'              => 'order/form_vitamin',
                'id_order'             => $id_order,
                'sales_invoice'        => $sales_invoice,
                'kode_unik'            => $kode_unik,
                'created_at'           => $created_at,
                'batas_waktu_transfer' => $batas_waktu_transfer,
                'estimasi_selesai'     => $estimasi_selesai,
                'products'             => $products,
                'csrf'                 => $csrf,
                'error'                => null,
            );
            $this->theme->render($data);
        } else {
            $this->store();
        }
    }

    protected function store()
    {
        $customers = $this->Customer_model->get_single_data('id', $this->session->userdata('id'));

        $id_order              = $this->input->post('id_order');
        $project_id            = 1;
        $durasi_batas_transfer = $this->input->post('durasi_batas_transfer');
        $batas_waktu_transfer  = $this->input->post('batas_waktu_transfer');
        $estimasi_selesai      = $this->input->post('estimasi_selesai');
        $order_via             = "web";
        $product_id            = $this->input->post('product_id');
        $color_id              = $this->input->post('color_id');
        $size_id               = $this->input->post('size_id');
        $pilih_jahitan         = $this->input->post('pilih_jahitan');
        $catatan               = $this->input->post('catatan');
        $customer_id           = $this->session->userdata('id');
        $whatsapp              = $this->session->userdata('whatsapp');
        $id_tokped             = $customers->row()->id_tokped;
        $id_shopee             = $customers->row()->id_shopee;
        $id_instagram          = $customers->row()->id_instagram;
        $jenis_dp              = $this->input->post('jenis_dp');
        $sub_total             = $this->input->post('sub_total_order');
        $grand_total           = $this->input->post('grand_total_order');
        $dp_value              = $this->input->post('dp_order');
        $pelunasan_value       = $this->input->post('lunas_order');

        $data = array(
            'project_id'            => $project_id,
            'durasi_batas_transfer' => $durasi_batas_transfer,
            'batas_waktu_transfer'  => $batas_waktu_transfer,
            'estimasi_selesai'      => $estimasi_selesai,
            'order_via'             => $order_via,
            'product_id'            => $product_id,
            'color_id'              => $color_id,
            'size_id'               => $size_id,
            'pilih_jahitan'         => $pilih_jahitan,
            'catatan'               => $catatan,
            'customer_id'           => $customer_id,
            'whatsapp'              => $whatsapp,
            'id_tokped'             => $id_tokped,
            'id_shopee'             => $id_shopee,
            'id_instagram'          => $id_instagram,
            'status_order'          => 'order dibuat',
            'status_pembayaran'     => 'menunggu pembayaran',
            'sub_total'             => $sub_total,
            'grand_total'           => $grand_total,
            'jenis_dp'              => $jenis_dp,
            'dp_value'              => $dp_value,
            'pelunasan_value'       => $pelunasan_value,
            'status'                => 'active',
        );
        $where = array('id' => $id_order);
        $exec  = $this->Order_model->update('orders', $data, $where);

        if (!$exec) {
            echo "Tambah Order gagal, silahkan coba kembali!";
        }

        $data = array(
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id'),
        );
        $where = array('order_id' => $id_order);
        $exec  = $this->Order_model->update('order_requests', $data, $where);

        if (!$exec) {
            echo "Tambah request gagal, silahkan coba kembali!";
        }

        $exec = $this->Order_model->update_customer($customer_id, $grand_total);

        $this->session->set_flashdata('success', 'Tambah Order Berhasil');
        redirect(base_url() . 'corder/index', 'location');
    }

    public function store_request()
    {
        $order_id   = $this->input->post('order_id');
        $request_id = $this->input->post('request_id');
        $exec       = $this->Produk_model->get_product_request('product_request_params.id', $request_id);
        $cost       = $exec->row()->cost;

        $data = array(
            'order_id'   => $order_id,
            'request_id' => $request_id,
            'cost'       => $cost,
            'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id'),
        );

        $exec = $this->Order_model->store('order_requests', $data);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = [
            'code' => 200,
            'cost' => $cost,
        ];

        echo json_encode($return);
    }

    public function render_detail()
    {
        $order_id      = $this->input->get('order_id');
        $product_id    = $this->input->get('product_id');
        $color_id      = $this->input->get('color_id');
        $size_id       = $this->input->get('size_id');
        $kode_unik     = $this->input->get('kode_unik');
        $jenis_dp      = $this->input->get('jenis_dp');
        $pilih_jahitan = $this->input->get('pilih_jahitan');

        $exec  = $this->Order_model->render_detail($order_id, $product_id, $color_id, $size_id, $kode_unik, $jenis_dp, $pilih_jahitan);

        echo json_encode([
            'code' => 200,
            'data' => $exec
        ]);
    }

    public function remove_request()
    {
        $id   = $this->input->post('id');
        $exec = $this->Order_model->remove_request($id);
        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function copy_order()
    {
        $order_id      = $this->input->get('order_id');
        $product_id    = $this->input->get('product_id');
        $color_id      = $this->input->get('color_id');
        $size_id       = $this->input->get('size_id');
        $kode_unik     = $this->input->get('kode_unik');
        $jenis_dp      = $this->input->get('jenis_dp');
        $catatan       = $this->input->get('catatan');
        $pilih_jahitan = $this->input->get('pilih_jahitan');

        $exec  = $this->Order_model->copy_order($order_id, $product_id, $color_id, $size_id, $kode_unik, $jenis_dp, $catatan, $pilih_jahitan);

        echo json_encode([
            'code' => 200,
            'data' => $exec
        ]);
    }

    public function show_request()
    {
        $id = $this->input->get('id');

        $exec = $this->Order_model->show_request($id);

        echo json_encode([
            'code' => 200,
            'data' => $exec->result(),
        ]);
    }

    public function invoice($id)
    {
        $exec = $this->Order_model->generate_invoice($id);
        $this->load->view('invoice', $exec, FALSE);
    }







    public function destroy($id)
    {
        $data  = array(
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata('id'),
        );
        $where = array('id' => $id);
        $exec  = $this->Order_model->destroy($data, $where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function check_pembayaran_dp()
    {
        $order_id = $this->input->get('order_id');
        $code     = $this->Pembayaran_model->cek_pembayaran_dp($order_id);
        echo json_encode(['code' => $code]);
    }

    public function store_dp()
    {
        $config['upload_path']   = './assets/img/pembayaran/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = 2048;
        $config['max_width']     = 0;
        $config['max_height']    = 0;
        $config['encrypt_name']  = true;
        $config['remove_spaces'] = true;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('path_image_dp')) {
            $error = $this->upload->display_errors();
            show_error($error, 500, "Terjadi Kesalahan");
            exit;
        } else {
            $order_id          = $this->input->post('id_dp');
            $alamat_pengiriman = $this->input->post('alamat_pengiriman_dp');

            $image_data = $this->upload->data();
            $path_image = $image_data['file_name'];

            $customer_id    = $this->session->userdata('id');

            $data = [
                'order_id'          => $order_id,
                'customer_id'       => $customer_id,
                'path_image'        => $path_image,
                'status_pembayaran' => 'menunggu verifikasi',
                'jenis_pembayaran'  => 'dp',
                'created_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
                'created_by'        => $this->session->userdata('id'),
                'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'        => $this->session->userdata('id'),
            ];
            $exec = $this->Pembayaran_model->store_dp($data, $order_id, $alamat_pengiriman);
            if (!$exec) {
                show_error('Proses Pembayaran Gagal', 500, "Terjadi Kesalahan");
                exit;
            }

            $this->session->set_flashdata('success', 'Upload Bukti Pembayaran DP Berhasil');
            redirect(base_url() . 'corder/index', 'location');
        }
    }

    public function check_pembayaran_pelunasan()
    {
        $order_id = $this->input->get('order_id');
        $code     = $this->Pembayaran_model->cek_pembayaran_pelunasan($order_id);
        echo json_encode(['code' => $code]);
    }

    public function store_pelunasan()
    {
        $config['upload_path']   = './assets/img/pembayaran/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = 2048;
        $config['max_width']     = 0;
        $config['max_height']    = 0;
        $config['encrypt_name']  = true;
        $config['remove_spaces'] = true;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('path_image_pelunasan')) {
            $error = $this->upload->display_errors();
            show_error($error, 500, "Terjadi Kesalahan");
            exit;
        } else {
            $order_id          = $this->input->post('id_pelunasan');
            $alamat_pengiriman = $this->input->post('alamat_pengiriman_pelunasan');

            $image_data = $this->upload->data();
            $path_image = $image_data['file_name'];

            $customer_id    = $this->session->userdata('id');

            $data = [
                'order_id'          => $order_id,
                'customer_id'       => $customer_id,
                'path_image'        => $path_image,
                'status_pembayaran' => 'menunggu verifikasi',
                'jenis_pembayaran'  => 'pelunasan',
                'created_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
                'created_by'        => $this->session->userdata('id'),
                'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'        => $this->session->userdata('id'),
            ];
            $exec = $this->Pembayaran_model->store_pelunasan($data, $order_id, $alamat_pengiriman);
            if (!$exec) {
                show_error('Proses Pembayaran Gagal', 500, "Terjadi Kesalahan");
                exit;
            }

            $this->session->set_flashdata('success', 'Upload Bukti Pembayaran Pelunasan Berhasil');
            redirect(base_url() . 'corder/index', 'location');
        }
    }
}
        
    /* End of file  Corder.php */
