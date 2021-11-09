<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_auth', null, 'auth');
        $this->load->library('Admin_template', null, 'theme');
        $this->auth->check_session();
        $this->load->model('Produk_model');
        $this->load->model('Warna_model');
        $this->load->model('Ukuran_model');
        $this->load->model('Request_model');
        $this->load->model('Hpp_model');
        $this->cur_datetime = new DateTime('now');
        if (in_array($this->session->userdata('role'), array('owner', 'developer', 'komisaris')) === false) {
            redirect('logout', 'location');
        }
    }

    public function index()
    {
        $list = $this->Produk_model->get_all_data();
        // echo '<pre>' . print_r($list, 1) . '</pre>';
        // exit;

        $data = array(
            'title'   => 'Produk',
            'page'    => 'produk/main',
            'vitamin' => 'produk/main_vitamin',
            'list'    => $list,
            'error'   => null,
        );
        $this->theme->render($data);
    }

    public function add()
    {
        $this->form_validation->set_rules('code', 'KODE PRODUK', 'required');
        $this->form_validation->set_rules('name', 'NAMA PRODUK', 'required');
        $this->form_validation->set_rules('color_id[]', 'WARNA', 'required');
        $this->form_validation->set_rules('size_id[]', 'UKURAN', 'required');
        $this->form_validation->set_rules('request_id[]', 'REQUEST', 'required');

        if ($this->form_validation->run() == FALSE) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );

            $this->Produk_model->clear_temp();
            $this->Produk_model->clear_hpp();

            $exec_code  = $this->Produk_model->generate_code();
            $id_product = $exec_code['id_product'];
            $code       = $exec_code['code'];
            $colors     = $this->Warna_model->get_all_data();
            $sizes      = $this->Ukuran_model->get_all_data();
            $requests   = $this->Request_model->get_all_data();
            $hpps       = $this->Hpp_model->get_all_data();

            $data = array(
                'title'      => 'Produk',
                'page'       => 'produk/form',
                'vitamin'    => 'produk/form_vitamin',
                'id_product' => $id_product,
                'code'       => $code,
                'colors'     => $colors,
                'sizes'      => $sizes,
                'requests'   => $requests,
                'hpps'       => $hpps,
                'csrf'       => $csrf,
                'error'      => null,
            );
            $this->theme->render($data);
        } else {
            $this->store();
        }
    }

    protected function store()
    {
        $id_product = $this->input->post('id_product');
        $code       = $this->input->post('code');
        $name       = $this->input->post('name');
        $price      = $this->input->post('price');
        $color_id   = $this->input->post('color_id');
        $size_id    = $this->input->post('size_id');
        $request_id = $this->input->post('request_id');

        $config['upload_path']   = './assets/img/products/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']      = 2048;
        $config['max_width']     = 0;
        $config['max_height']    = 0;
        $config['encrypt_name']  = true;
        $config['remove_spaces'] = true;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('path_image')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            session_write_close();
            redirect(base_url() . 'produk/add', 'location');
        } else {
            $image_data = $this->upload->data();
            $path_image = $image_data['file_name'];

            if ($_FILES['path_image_2']['size'] > 0) {
                if (!$this->upload->do_upload('path_image_2')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    session_write_close();
                    redirect(base_url() . 'produk/add', 'location');
                }
            } else {
                $image_data_2 = $this->upload->data();
                $path_image_2 = $image_data_2['file_name'];
            }

            if ($_FILES['path_image_3']['size'] > 0) {
                if (!$this->upload->do_upload('path_image_3')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    session_write_close();
                    redirect(base_url() . 'produk/add', 'location');
                }
            } else {
                $image_data_3 = $this->upload->data();
                $path_image_3 = $image_data_3['file_name'];
            }

            $data = array(
                'name'         => $name,
                'price'        => $price,
                'path_image'   => $path_image,
                'path_image_2' => $path_image_2,
                'path_image_3' => $path_image_3,
                'status'       => 'active',
                'updated_at'   => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_by'   => $this->session->userdata('id'),
            );
            $where = array('id' => $id_product);
            $exec  = $this->Produk_model->update('products', $data, $where);

            if (!$exec) {
                echo "Tambah Produk gagal, silahkan coba kembali!";
            }

            $data = array(
                'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
                'updated_by' => $this->session->userdata('id'),
            );
            $where = array('product_id' => $id_product);
            $exec  = $this->Produk_model->update('product_hpp_params', $data, $where);

            if (!$exec) {
                echo "Tambah HPP Produk gagal, silahkan coba kembali!";
            }

            for ($i = 0; $i < count($color_id); $i++) {
                $data = array(
                    'product_id' => $id_product,
                    'color_id'   => $color_id[$i],
                    'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
                    'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id'),
                    'updated_by' => $this->session->userdata('id'),
                );
                $exec  = $this->Produk_model->store('product_color_params', $data);
                if (!$exec) {
                    echo "Tambah Warna Produk gagal, silahkan coba kembali!";
                }
            }

            for ($i = 0; $i < count($size_id); $i++) {
                $data = array(
                    'product_id' => $id_product,
                    'size_id'   => $size_id[$i],
                    'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
                    'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id'),
                    'updated_by' => $this->session->userdata('id'),
                );
                $exec  = $this->Produk_model->store('product_size_params', $data);
                if (!$exec) {
                    echo "Tambah Ukuran Produk gagal, silahkan coba kembali!";
                }
            }

            for ($i = 0; $i < count($request_id); $i++) {
                $data = array(
                    'product_id' => $id_product,
                    'request_id'   => $request_id[$i],
                    'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
                    'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
                    'created_by' => $this->session->userdata('id'),
                    'updated_by' => $this->session->userdata('id'),
                );
                $exec  = $this->Produk_model->store('product_request_params', $data);
                if (!$exec) {
                    echo "Tambah Request Produk gagal, silahkan coba kembali!";
                }
            }

            $this->session->set_flashdata('success', 'Tambah Produk Berhasil');
            session_write_close();
            redirect(base_url() . 'produk/index', 'location');
        }
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
            $list = $this->Produk_model->get_single_data('id', $id);
            $data = array(
                'title' => 'Produk Edit',
                'page'  => 'produk/form_edit',
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
        $exec  = $this->Produk_model->update($data, $where);

        if (!$exec) {
            $this->session->set_flashdata('error', 'Edit Produk Gagal');
            session_write_close();
            redirect(base_url() . 'produk/index', 'location');
        }

        $this->session->set_flashdata('success', 'Edit Produk Berhasil');
        session_write_close();
        redirect(base_url() . 'produk/index', 'location');
    }

    public function destroy($id)
    {
        $data  = array(
            'deleted_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'deleted_by' => $this->session->userdata('id'),
        );
        $where = array('id' => $id);
        $exec  = $this->Produk_model->destroy($data, $where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function render_hpp()
    {
        $product_id = $this->input->get('product_id');
        $exec       = $this->Produk_model->get_temp_hpp($product_id);

        echo json_encode([
            'code'  => 200,
            'count' => $exec->num_rows(),
            'data'  => $exec->result(),
        ]);
    }

    public function store_hpp()
    {
        $product_id = $this->input->post('product_id');
        $hpp_id     = $this->input->post('hpp_id');
        $qty        = $this->input->post('qty_hpp');

        $basic_price = $this->Hpp_model->get_single_data('hpps.id', $hpp_id)->row()->cost;
        $total_price = $basic_price * $qty;

        $data  = array(
            'product_id'  => $product_id,
            'hpp_id'      => $hpp_id,
            'qty'         => $qty,
            'basic_price' => $basic_price,
            'total_price' => $total_price,
            'created_at'  => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by'  => $this->session->userdata('id'),
        );
        $exec  = $this->Produk_model->store_hpp($data);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function destroy_hpp($id)
    {
        $where = array('id' => $id);
        $exec  = $this->Produk_model->destroy_hpp($where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
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
        $exec  = $this->Produk_model->update($data, $where);

        if (!$exec) {
            $return = ['code' => 500];
        }

        $return = ['code' => 200];

        echo json_encode($return);
    }

    public function show($id)
    {
        $exec = $this->Produk_model->get_detail_for_order($id);

        if (!$exec) {
            $return = [
                'code' => 500,
                'data' => null,
            ];
        }

        $return = [
            'code' => 200,
            'data' => $exec,
        ];

        echo json_encode($return);
    }
}
        
    /* End of file  Produk.php */
