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
            'products.path_image_2',
            'products.path_image_3',
            'products.description',
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
            $return = array(
                'num_rows' => $exec->num_rows(),
                'data'     => array(),
            );
            $itteraion = 0;
            foreach ($exec->result() as $key) {
                $id           = $key->id;
                $code         = $key->code;
                $name         = $key->name;
                $price        = $key->price;
                $path_image   = $key->path_image;
                $path_image_2 = $key->path_image_2;
                $path_image_3 = $key->path_image_3;
                $description  = $key->description;

                $return['data'][$itteraion]['id']           = $id;
                $return['data'][$itteraion]['code']         = $code;
                $return['data'][$itteraion]['name']         = $name;
                $return['data'][$itteraion]['price']        = $price;
                $return['data'][$itteraion]['path_image']   = $path_image;
                $return['data'][$itteraion]['path_image_2'] = $path_image_2;
                $return['data'][$itteraion]['path_image_3'] = $path_image_3;
                $return['data'][$itteraion]['description']  = $description;

                $this->db->select('colors.name');
                $this->db->from('product_color_params');
                $this->db->join('colors', 'colors.id = product_color_params.color_id', 'left');
                $this->db->where('product_color_params.product_id', $id);
                $this->db->where('product_color_params.deleted_at', null);
                $this->db->order_by('product_color_params.id', 'asc');
                $exec_color = $this->db->get();
                if ($exec_color->num_rows() == 0) {
                    $return['data'][$itteraion]['colors'] = '-';
                } else {
                    $return['data'][$itteraion]['colors'] = "<ul>";
                    foreach ($exec_color->result() as $color) {
                        $return['data'][$itteraion]['colors'] .= "<li>" . $color->name . "</li>";
                    }
                    $return['data'][$itteraion]['colors'] .= "</ul>";
                }

                $this->db->select('sizes.name');
                $this->db->from('product_size_params');
                $this->db->join('sizes', 'sizes.id = product_size_params.size_id', 'left');
                $this->db->where('product_size_params.product_id', $id);
                $this->db->where('product_size_params.deleted_at', null);
                $this->db->order_by('product_size_params.id', 'asc');
                $exec_size = $this->db->get();
                if ($exec_size->num_rows() == 0) {
                    $return['data'][$itteraion]['sizes'] = '-';
                } else {
                    $return['data'][$itteraion]['sizes'] = "<ul>";
                    foreach ($exec_size->result() as $size) {
                        $return['data'][$itteraion]['sizes'] .= "<li>" . $size->name . "</li>";
                    }
                    $return['data'][$itteraion]['sizes'] .= "</ul>";
                }

                $this->db->select('requests.name');
                $this->db->from('product_request_params');
                $this->db->join('requests', 'requests.id = product_request_params.request_id', 'left');
                $this->db->where('product_request_params.product_id', $id);
                $this->db->where('product_request_params.deleted_at', null);
                $this->db->order_by('product_request_params.id', 'asc');
                $exec_request = $this->db->get();
                if ($exec_request->num_rows() == 0) {
                    $return['data'][$itteraion]['requests'] = '-';
                } else {
                    $return['data'][$itteraion]['requests'] = "<ul>";
                    foreach ($exec_request->result() as $request) {
                        $return['data'][$itteraion]['requests'] .= "<li>" . $request->name . "</li>";
                    }
                    $return['data'][$itteraion]['requests'] .= "</ul>";
                }

                $this->db->select('hpps.name');
                $this->db->from('product_hpp_params');
                $this->db->join('hpps', 'hpps.id = product_hpp_params.hpp_id', 'left');
                $this->db->where('product_hpp_params.product_id', $id);
                $this->db->where('product_hpp_params.deleted_at', null);
                $this->db->order_by('product_hpp_params.id', 'asc');
                $exec_hpp = $this->db->get();
                if ($exec_hpp->num_rows() == 0) {
                    $return['data'][$itteraion]['hpps'] = '-';
                } else {
                    $return['data'][$itteraion]['hpps'] = "<ul>";
                    foreach ($exec_hpp->result() as $hpp) {
                        $return['data'][$itteraion]['hpps'] .= "<li>" . $hpp->name . "</li>";
                    }
                    $return['data'][$itteraion]['hpps'] .= "</ul>";
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
        $exec = $this->db->get('products', 1);
        return $exec;
    }

    public function get_detail_for_order($id)
    {
        $this->db->select('products.path_image');
        $this->db->where('products.id', $id);
        $p = $this->db->get('products');

        $images = ($p->row()->path_image != null || $p->row()->path_image != "") ? $p->row()->path_image : 'default.jpg';

        $return = array(
            'image'    => $images,
            'colors'   => array(),
            'sizes'    => array(),
            'requests' => array(),
        );

        $this->db->select(array(
            'colors.id',
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
            'sizes.id',
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
            'requests.id',
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
            'created_by' => $this->session->userdata(SESS_ADM . 'id'),
            'updated_at' => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by' => $this->session->userdata(SESS_ADM . 'id'),
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
        $this->db->where('product_hpp_params.created_by', $this->session->userdata(SESS_ADM . 'id'));
        $exec = $this->db->get();

        return $exec;
    }

    public function get_active_hpp($product_id)
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
        $exec = $this->db->get();

        return $exec;
    }

    public function clear_temp()
    {
        $this->db->where('status', 'temp');
        $this->db->where('created_by', $this->session->userdata(SESS_ADM . 'id'));
        return $this->db->delete('products');
    }

    public function clear_hpp()
    {
        $this->db->where('created_by', $this->session->userdata(SESS_ADM . 'id'));
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

    public function destroy($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    public function get_product_request($field, $key)
    {
        $this->db->select(array(
            'product_request_params.id',
            'requests.name',
            'requests.cost',
        ));
        $this->db->join('requests', 'requests.id = product_request_params.request_id', 'left');
        $this->db->where($field, $key);
        $this->db->where('product_request_params.deleted_at', null);
        $exec = $this->db->get('product_request_params');
        return $exec;
    }

    public function count_all($f_size = null)
    {
        $this->db->join('product_size_params', 'product_size_params.product_id = products.id', 'left');
        $this->db->group_by('products.id');


        if ($f_size != null) {
            $this->db->where_in('product_size_params.size_id', $f_size);
        }

        $this->db->where('products.status', 'active');
        $this->db->where('products.deleted_at', null);
        $this->db->where('product_size_params.deleted_at', null);
        return $this->db->get('products');
    }

    public function get_paging_data($limit, $offset, $f_size)
    {
        $this->db->select('products.*');

        $this->db->join('product_size_params', 'product_size_params.product_id = products.id', 'left');
        $this->db->group_by('products.id');


        if ($f_size != null) {
            $this->db->where_in('product_size_params.size_id', $f_size);
        }

        $this->db->where('products.status', 'active');
        $this->db->where('products.deleted_at', null);
        $this->db->where('product_size_params.deleted_at', null);
        return $this->db->get('products', $limit, $offset);
    }

    public function show_single_data($id)
    {
        $this->db->select($this->select);
        $this->db->from('products');
        $this->db->where('products.id', $id);
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
            $return = array(
                'num_rows' => $exec->num_rows(),
                'data'     => array(),
            );
            $itteraion = 0;
            foreach ($exec->result() as $key) {
                $id           = $key->id;
                $code         = $key->code;
                $name         = $key->name;
                $price        = $key->price;
                $path_image   = $key->path_image;
                $path_image_2 = $key->path_image_2;
                $path_image_3 = $key->path_image_3;
                $description  = $key->description;

                $return['data'][$itteraion]['id']           = $id;
                $return['data'][$itteraion]['code']         = $code;
                $return['data'][$itteraion]['name']         = $name;
                $return['data'][$itteraion]['price']        = $price;
                $return['data'][$itteraion]['path_image']   = $path_image;
                $return['data'][$itteraion]['path_image_2'] = $path_image_2;
                $return['data'][$itteraion]['path_image_3'] = $path_image_3;
                $return['data'][$itteraion]['description']  = $description;

                $this->db->select('colors.id, colors.name');
                $this->db->from('product_color_params');
                $this->db->join('colors', 'colors.id = product_color_params.color_id', 'left');
                $this->db->where('product_color_params.product_id', $id);
                $this->db->where('product_color_params.deleted_at', null);
                $this->db->order_by('product_color_params.id', 'asc');
                $exec_color = $this->db->get();
                if ($exec_color->num_rows() == 0) {
                    $return['data'][$itteraion]['colors'] = [];
                } else {
                    $return['data'][$itteraion]['colors'] = $exec_color->result_array();
                }

                $this->db->select('sizes.id, sizes.name');
                $this->db->from('product_size_params');
                $this->db->join('sizes', 'sizes.id = product_size_params.size_id', 'left');
                $this->db->where('product_size_params.product_id', $id);
                $this->db->where('product_size_params.deleted_at', null);
                $this->db->order_by('product_size_params.id', 'asc');
                $exec_size = $this->db->get();
                if ($exec_size->num_rows() == 0) {
                    $return['data'][$itteraion]['sizes'] = [];
                } else {
                    $return['data'][$itteraion]['sizes'] = $exec_size->result_array();
                }

                $this->db->select('requests.id, requests.name');
                $this->db->from('product_request_params');
                $this->db->join('requests', 'requests.id = product_request_params.request_id', 'left');
                $this->db->where('product_request_params.product_id', $id);
                $this->db->where('product_request_params.deleted_at', null);
                $this->db->order_by('product_request_params.id', 'asc');
                $exec_request = $this->db->get();
                if ($exec_request->num_rows() == 0) {
                    $return['data'][$itteraion]['requests'] = [];
                } else {
                    $return['data'][$itteraion]['requests'] = $exec_request->result_array();
                }

                $this->db->select('hpps.id, hpps.name');
                $this->db->from('product_hpp_params');
                $this->db->join('hpps', 'hpps.id = product_hpp_params.hpp_id', 'left');
                $this->db->where('product_hpp_params.product_id', $id);
                $this->db->where('product_hpp_params.deleted_at', null);
                $this->db->order_by('product_hpp_params.id', 'asc');
                $exec_hpp = $this->db->get();
                if ($exec_hpp->num_rows() == 0) {
                    $return['data'][$itteraion]['hpps'] = [];
                } else {
                    $return['data'][$itteraion]['hpps'] = $exec_hpp->result_array();
                }

                $itteraion++;
            }
            return $return;
        }
    }

    public function get_top_product($id)
    {
        $this->db->where_not_in('id', $id);
        $this->db->where('status', 'active');
        $this->db->where('deleted_at', null);
        $this->db->order_by('sold', 'desc');
        return $this->db->get('products', 5);
    }

    public function get_product_colors($product_id)
    {
        $this->db->select([
            'colors.id',
        ]);
        $this->db->join('colors', 'colors.id = product_color_params.color_id', 'left');
        $this->db->where('product_color_params.product_id', $product_id);
        $this->db->where('product_color_params.deleted_at', null);
        $exec = $this->db->get('product_color_params');
        $return = [];

        foreach ($exec->result() as $key) {
            array_push($return, $key->id);
        }

        return $return;
    }

    public function get_product_sizes($product_id)
    {
        $this->db->select([
            'sizes.id',
        ]);
        $this->db->join('sizes', 'sizes.id = product_size_params.size_id', 'left');
        $this->db->where('product_size_params.product_id', $product_id);
        $this->db->where('product_size_params.deleted_at', null);
        $exec = $this->db->get('product_size_params');
        $return = [];

        foreach ($exec->result() as $key) {
            array_push($return, $key->id);
        }

        return $return;
    }

    public function get_product_requests($product_id)
    {
        $this->db->select([
            'requests.id',
        ]);
        $this->db->join('requests', 'requests.id = product_request_params.request_id', 'left');
        $this->db->where('product_request_params.product_id', $product_id);
        $this->db->where('product_request_params.deleted_at', null);
        $exec = $this->db->get('product_request_params');
        $return = [];

        foreach ($exec->result() as $key) {
            array_push($return, $key->id);
        }

        return $return;
    }

    public function clear_color($product_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_color_params');
    }

    public function clear_size($product_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_size_params');
    }

    public function clear_request($product_id)
    {
        $this->db->where('product_id', $product_id);
        $this->db->delete('product_request_params');
    }
}
                        
/* End of file Produk_model.php */
