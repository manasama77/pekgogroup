<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{

    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->cur_datetime = new DateTime('now');
        $this->select = array(
            'products.id',
            'products.code',
            'products.name',
            'products.price',
            'products.path_image',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('products');
        $this->db->where('products.status', 'active');
        $this->db->where('products.deleted_at', null);
        $this->db->order_by('products.id', 'asc');
        $exec = $this->db->get();

        if ($exec->num_rows() == 0) {
            return array(
                'num_rows' => 0,
                'data'     => array(),
            );
        } else {
            $return = array();
            $itteraion = 0;
            foreach ($exec->result() as $key) {
                $id         = $key->id;
                $code       = $key->code;
                $name       = $key->name;
                $price      = $key->price;
                $path_image = $key->path_image;

                $return[$itteraion]['id']         = $id;
                $return[$itteraion]['code']       = $code;
                $return[$itteraion]['name']       = $name;
                $return[$itteraion]['price']      = $price;
                $return[$itteraion]['path_image'] = $path_image;

                $this->db->select('colors.name');
                $this->db->from('product_color_params');
                $this->db->join('colors', 'colors.id = product_color_params.color_id', 'left');
                $this->db->where('product_color_params.product_id', $id);
                $this->db->where('product_color_params.deleted_at', null);
                $this->db->order_by('product_color_params.id', 'asc');
                $exec_color = $this->db->get();
                if ($exec_color->num_rows() == 0) {
                    $return[$itteraion]['colors'] = '-';
                } else {
                    $return[$itteraion]['colors'] = "<ul>";
                    foreach ($exec_color->result() as $color) {
                        $return[$itteraion]['colors'] .= "<li>" . $color->name . "</li>";
                    }
                    $return[$itteraion]['colors'] .= "</ul>";
                }

                $this->db->select('sizes.name');
                $this->db->from('product_size_params');
                $this->db->join('sizes', 'sizes.id = product_size_params.size_id', 'left');
                $this->db->where('product_size_params.product_id', $id);
                $this->db->where('product_size_params.deleted_at', null);
                $this->db->order_by('product_size_params.id', 'asc');
                $exec_size = $this->db->get();
                if ($exec_size->num_rows() == 0) {
                    $return[$itteraion]['sizes'] = '-';
                } else {
                    $return[$itteraion]['sizes'] = "<ul>";
                    foreach ($exec_size->result() as $size) {
                        $return[$itteraion]['sizes'] .= "<li>" . $size->name . "</li>";
                    }
                    $return[$itteraion]['sizes'] .= "</ul>";
                }

                $this->db->select('requests.name');
                $this->db->from('product_request_params');
                $this->db->join('requests', 'requests.id = product_request_params.request_id', 'left');
                $this->db->where('product_request_params.product_id', $id);
                $this->db->where('product_request_params.deleted_at', null);
                $this->db->order_by('product_request_params.id', 'asc');
                $exec_request = $this->db->get();
                if ($exec_request->num_rows() == 0) {
                    $return[$itteraion]['requests'] = '-';
                } else {
                    $return[$itteraion]['requests'] = "<ul>";
                    foreach ($exec_request->result() as $request) {
                        $return[$itteraion]['requests'] .= "<li>" . $request->name . "</li>";
                    }
                    $return[$itteraion]['requests'] .= "</ul>";
                }

                $this->db->select('hpps.name');
                $this->db->from('product_hpp_params');
                $this->db->join('hpps', 'hpps.id = product_hpp_params.hpp_id', 'left');
                $this->db->where('product_hpp_params.product_id', $id);
                $this->db->where('product_hpp_params.deleted_at', null);
                $this->db->order_by('product_hpp_params.id', 'asc');
                $exec_hpp = $this->db->get();
                if ($exec_hpp->num_rows() == 0) {
                    $return[$itteraion]['hpps'] = '-';
                } else {
                    $return[$itteraion]['hpps'] = "<ul>";
                    foreach ($exec_hpp->result() as $hpp) {
                        $return[$itteraion]['hpps'] .= "<li>" . $hpp->name . "</li>";
                    }
                    $return[$itteraion]['hpps'] .= "</ul>";
                }

                $itteraion++;
            }
            return $return;
        }
    }

    public function get_single_data($field, $key)
    {
        $this->db->where($field, $key);
        $this->db->where('products.status', 'active');
        $this->db->where('products.deleted_at', null);
        $exec = $this->db->get('produks', 1);
        return $exec;
    }

    public function get_detail_for_order($id)
    {
        $return = array(
            'colors'   => array(),
            'sizes'    => array(),
            'requests' => array(),
        );

        $this->db->select(array(
            'product_color_params.id',
            'colors.name',
        ));
        $this->db->from('product_color_params');
        $this->db->join('colors', 'colors.id = product_color_params.color_id', 'left');
        $this->db->where('product_color_params.product_id', $id);
        $this->db->where('product_color_params.deleted_at', null);
        $exec = $this->db->get();
        if ($exec->num_rows() > 0) {
            $i = 0;
            foreach ($exec->result() as $k) {
                $return['colors'][$i]['id']   = $k->id;
                $return['colors'][$i]['name'] = $k->name;
                $i++;
            }
        }

        $this->db->select(array(
            'product_size_params.id',
            'sizes.name',
        ));
        $this->db->from('product_size_params');
        $this->db->join('sizes', 'sizes.id = product_size_params.size_id', 'left');
        $this->db->where('product_size_params.product_id', $id);
        $this->db->where('product_size_params.deleted_at', null);
        $exec = $this->db->get();
        if ($exec->num_rows() > 0) {
            $i = 0;
            foreach ($exec->result() as $k) {
                $return['sizes'][$i]['id']   = $k->id;
                $return['sizes'][$i]['name'] = $k->name;
                $i++;
            }
        }

        $this->db->select(array(
            'product_request_params.id',
            'requests.name',
        ));
        $this->db->from('product_request_params');
        $this->db->join('requests', 'requests.id = product_request_params.request_id', 'left');
        $this->db->where('product_request_params.product_id', $id);
        $this->db->where('product_request_params.deleted_at', null);
        $exec = $this->db->get();
        if ($exec->num_rows() > 0) {
            $i = 0;
            foreach ($exec->result() as $k) {
                $return['requests'][$i]['id']   = $k->id;
                $return['requests'][$i]['name'] = $k->name;
                $i++;
            }
        }

        return $return;
    }

    public function store($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function store_hpp($data)
    {
        return $this->db->insert('product_hpp_params', $data);
    }

    public function generate_code()
    {
        $this->db->from('sequence_products');
        $this->db->where('sequence_products.created_at', $this->cur_datetime->format('Y-m-d'));
        $exec_seq = $this->db->get();

        if ($exec_seq->num_rows() == 0) {
            $sequence      = 1;
            $code_sequence = $this->generate_sequence($sequence);
            $code          = "P." . $this->cur_datetime->format('d') . "." . $this->cur_datetime->format('m') . "." . $this->cur_datetime->format('y') . $code_sequence;

            $data_sequence = array(
                'sequence'   => $sequence,
                'created_at' => $this->cur_datetime->format('Y-m-d'),
            );
            $this->db->insert('sequence_products', $data_sequence);
        } else {
            $sequence      = $exec_seq->row()->sequence + 1;
            $code_sequence = $this->generate_sequence($sequence);
            $code          = "P." . $this->cur_datetime->format('d') . "." . $this->cur_datetime->format('m') . "." . $this->cur_datetime->format('y') . $code_sequence;

            $data_sequence = array(
                'sequence'   => $sequence,
                'created_at' => $this->cur_datetime->format('Y-m-d'),
            );
            $where_sequence = array('id' => $exec_seq->row()->id);
            $this->db->update('sequence_products', $data_sequence, $where_sequence);
        }

        $data_product_temp = array(
            'code'       => $code,
            'name'       => '',
            'path_image' => null,
            'status'     => 'temp',
            'created_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id'),
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata('id'),
        );
        $this->store('products', $data_product_temp);
        $id_product = $this->db->insert_id();

        return array(
            'id_product' => $id_product,
            'code'       => $code,
        );
    }

    public function generate_sequence($sequence)
    {
        if ($sequence < 10) {
            return "00" . $sequence;
        } elseif ($sequence < 100) {
            return "0" . $sequence;
        } else {
            return $sequence;
        }
    }

    public function get_temp_hpp($product_id)
    {
        $this->db->select(array(
            'product_hpp_params.id',
            'product_hpp_params.qty',
            'product_hpp_params.basic_price',
            'product_hpp_params.total_price',
            'hpps.name',
            'units.name as unit_name',
        ));
        $this->db->from('product_hpp_params');
        $this->db->join('hpps', 'hpps.id = product_hpp_params.hpp_id', 'left');
        $this->db->join('units', 'units.id = hpps.unit_id', 'left');
        $this->db->where('product_hpp_params.product_id', $product_id);
        $this->db->where('product_hpp_params.created_by', $this->session->userdata('id'));
        $exec = $this->db->get();

        return $exec;
    }

    public function clear_temp()
    {
        $this->db->where('status', 'temp');
        $this->db->where('created_by', $this->session->userdata('id'));
        return $this->db->delete('products');
    }

    public function clear_hpp()
    {
        $this->db->where('created_by', $this->session->userdata('id'));
        $this->db->where('updated_at', null);
        $this->db->where('updated_by', null);
        return $this->db->delete('product_hpp_params');
    }

    public function destroy_hpp($where)
    {
        return $this->db->delete('product_hpp_params', $where);
    }

    public function update($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    public function get_product_request($field, $key)
    {
        $this->db->select(array(
            'produk_request_params.id',
            'request.name',
            'request.cost',
        ));
        $this->db->join('requests', 'requests.id = produk_request_params.request_id', 'left');
        $this->db->where($field, $key);
        $this->db->where('produk_request_params.deleted_at', null);
        $exec = $this->db->get('produk_request_params');
        return $exec;
    }
}
                        
/* End of file Produk_model.php */
