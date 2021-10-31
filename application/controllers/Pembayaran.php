<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Pembayaran_model');
        $this->load->model('Customer_model');
        $this->load->model('Produk_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata('role'), array('owner', 'developer', 'komisaris', 'finance')) === false) {
            redirect('logout', 'location');
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
            $list = $this->Pembayaran_model->get_all_data($product_id, $customer_id, $field, $keyword);
        }

        $products  = $this->Produk_model->get_all_data();
        $customers = $this->Customer_model->get_all_data();

        $data = array(
            'title'     => 'Order',
            'page'      => 'pembayaran/main',
            'vitamin'   => 'pembayaran/main_vitamin',
            'list'      => $list,
            'products'  => $products,
            'customers' => $customers,
            'error'     => null,
        );
        $this->theme->render($data);
    }

    public function verifikasi_dp()
    {
        $id   = $this->input->get('id');
        $exec = $this->Pembayaran_model->get_data_dp($id);

        if (!$exec) {
            $return = array('code' => 500);
        } else {
            if ($exec->num_rows() == 0) {
                $return = array('code' => 404);
            } else {
                $return = array('code' => 200, 'data' => $exec->result());
            }
        }

        echo json_encode($return);
    }

    public function approve_dp()
    {
        $id       = $this->input->post('id');
        $order_id = $this->input->post('order_id');

        $exec = $this->Pembayaran_model->approve_dp($id, $order_id);

        if (!$exec) {
            $return = array('code' => 500);
        } else {
            $return = array('code' => 200);
        }

        echo json_encode($return);
    }

    public function reject_dp()
    {
        $id               = $this->input->post('id');
        $alasan_penolakan = $this->input->post('alasan_penolakan');

        $exec = $this->Pembayaran_model->reject_dp($id, $alasan_penolakan);

        if (!$exec) {
            $return = array('code' => 500);
        } else {
            $return = array('code' => 200);
        }

        echo json_encode($return);
    }

    public function verifikasi_pelunasan()
    {
        $id   = $this->input->get('id');
        $exec = $this->Pembayaran_model->get_data_pelunasan($id);

        if (!$exec) {
            $return = array('code' => 500);
        } else {
            if ($exec->num_rows() == 0) {
                $return = array('code' => 404);
            } else {
                $return = array('code' => 200, 'data' => $exec->result());
            }
        }

        echo json_encode($return);
    }

    public function approve_pelunasan()
    {
        $id       = $this->input->post('id');
        $order_id = $this->input->post('order_id');

        $exec = $this->Pembayaran_model->approve_pelunasan($id, $order_id);

        if (!$exec) {
            $return = array('code' => 500);
        } else {
            $return = array('code' => 200);
        }

        echo json_encode($return);
    }

    public function cek_pembayaran_dp()
    {
        $id = $this->input->post('id');

        $exec = $this->Pembayaran_model->cek_pembayaran_dp($id);
        $return = array('code' => $exec);

        echo json_encode($return);
    }

    public function store_tambah_dp()
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
            echo json_encode(['code' => 500, 'error' => $error]);
            exit;
        } else {
            $image_data = $this->upload->data();
            $path_image = $image_data['file_name'];

            $order_id       = $this->input->post('id_dp');
            $customer_id    = $this->input->post('id_customer_dp');
            $created_at_obj = new DateTime($this->input->post('created_at_dp'));
            $created_at     = $created_at_obj->format('Y-m-d H:i:s');
            $jenis_dp       = $this->input->post('id_customer_dp');
            $dp_value       = $this->input->post('dp_value_dp');

            $data = [
                'order_id'          => $order_id,
                'customer_id'       => $customer_id,
                'path_image'        => $path_image,
                'status_pembayaran' => 'valid',
                'jenis_pembayaran'  => 'dp',
                'created_at'        => $created_at,
                'created_by'        => $this->session->userdata('id'),
                'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'        => $this->session->userdata('id'),
            ];
            $exec = $this->Pembayaran_model->store_dp($data);
            if (!$exec) {
                echo json_encode(['code' => 500, 'error' => 'proses pembayaran gagal']);
                exit;
            }

            $status_pembayaran = 'partial';
            $is_paid_off       = 'no';
            if ($jenis_dp == 100) {
                $status_pembayaran = 'lunas';
                $is_paid_off = 'yes';
            }
            $terbayarkan = $dp_value;

            $data = [
                'status_pembayaran' => $status_pembayaran,
                'terbayarkan'       => $terbayarkan,
                'admin_finance'     => $this->session->userdata('id'),
                'is_paid_off'       => $is_paid_off,
                'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'        => $this->session->userdata('id'),
            ];
            $where = [
                'id' => $order_id
            ];
            $exec = $this->Pembayaran_model->update_order($data, $where);
            if (!$exec) {
                echo json_encode(['code' => 500, 'error' => 'proses update order gagal']);
                exit;
            }

            echo json_encode(['code' => 200]);
        }
    }

    public function cek_pembayaran_pelunasan()
    {
        $id = $this->input->post('id');

        $exec = $this->Pembayaran_model->cek_pembayaran_pelunasan($id);
        $return = array('code' => $exec);

        echo json_encode($return);
    }

    public function store_tambah_pelunasan()
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
            echo json_encode(['code' => 500, 'error' => $error]);
            exit;
        } else {
            $image_data = $this->upload->data();
            $path_image = $image_data['file_name'];

            $order_id        = $this->input->post('id_pelunasan');
            $customer_id     = $this->input->post('id_customer_pelunasan');
            $created_at_obj  = new DateTime($this->input->post('created_at_pelunasan'));
            $created_at      = $created_at_obj->format('Y-m-d H:i:s');
            $jenis_dp        = $this->input->post('id_customer_pelunasan');
            $dp_value        = $this->input->post('dp_value_pelunasan');
            $pelunasan_value = $this->input->post('pelunasan_value_pelunasan');

            $data = [
                'order_id'          => $order_id,
                'customer_id'       => $customer_id,
                'path_image'        => $path_image,
                'status_pembayaran' => 'valid',
                'jenis_pembayaran'  => 'pelunasan',
                'created_at'        => $created_at,
                'created_by'        => $this->session->userdata('id'),
                'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'        => $this->session->userdata('id'),
            ];
            $exec = $this->Pembayaran_model->store_pelunasan($data);
            if (!$exec) {
                echo json_encode(['code' => 500, 'error' => 'proses pembayaran gagal']);
                exit;
            }

            $status_pembayaran = 'lunas';
            $is_paid_off       = 'yes';
            $terbayarkan       = $dp_value + $pelunasan_value;

            $data = [
                'status_pembayaran' => $status_pembayaran,
                'terbayarkan'       => $terbayarkan,
                'admin_finance'     => $this->session->userdata('id'),
                'is_paid_off'       => $is_paid_off,
                'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'        => $this->session->userdata('id'),
            ];
            $where = [
                'id' => $order_id
            ];
            $exec = $this->Pembayaran_model->update_order($data, $where);
            if (!$exec) {
                echo json_encode(['code' => 500, 'error' => 'proses update order gagal']);
                exit;
            }

            echo json_encode(['code' => 200]);
        }
    }
}
        
    /* End of file  Pembayaran.php */
