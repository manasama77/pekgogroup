<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{

    private $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->cur_datetime = new DateTime('now');
        $this->select = array(
            'orders.id',
            'orders.project_id',
            'orders.sales_invoice',
            'orders.durasi_batas_transfer',
            'orders.batas_waktu_transfer',
            'orders.estimasi_selesai',
            'orders.order_via',
            'orders.product_id',
            'orders.color_id',
            'orders.size_id',
            'orders.pilih_jahitan',
            'orders.catatan',
            'orders.customer_id',
            'orders.whatsapp',
            'orders.id_tokped',
            'orders.id_shopee',
            'orders.id_instagram',
            'orders.status_order',
            'orders.status_pembayaran',
            'orders.sub_total',
            'orders.kode_unik',
            'orders.grand_total',
            'orders.jenis_dp',
            'orders.dp_value',
            'orders.pelunasan_value',
            'orders.terbayarkan',
            'orders.tanggal_pengiriman',
            'orders.ekspedisi',
            'orders.no_resi',
            'orders.admin_order',
            'orders.alamat_pengiriman',
            'orders.admin_finance',
            'orders.admin_cs',
            'orders.admin_produksi',
            'orders.is_printed',
            'orders.is_production',
            'orders.is_paid_off',
            'orders.status',
            'orders.created_at',
        );
    }

    public function get_all_data()
    {
        $this->db->select($this->select);
        $this->db->from('orders');
        $this->db->where('orders.status', 'active');
        $this->db->where('orders.deleted_at', null);
        $this->db->order_by('orders.id', 'desc');
        $exec = $this->db->get();
        return $exec;
    }

    public function get_single_data($whatsapp)
    {
        $this->db->where('whatsapp', $whatsapp);
        $this->db->where('orders.status', 'active');
        $this->db->where('orders.deleted_at', null);
        $exec = $this->db->get('orders', 1);

        return $exec;
    }

    public function store($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function store_hpp($data)
    {
        return $this->db->insert('product_hpp_params', $data);
    }

    public function generate_sales_invoice()
    {
        $this->db->from('sequence_orders');
        $this->db->where('sequence_orders.created_at', $this->cur_datetime->format('Y-m-d'));
        $exec_seq = $this->db->get();

        if ($exec_seq->num_rows() == 0) {
            $sequence      = 1;
            $code_sequence = $this->generate_sequence($sequence);
            $sales_invoice = "PKG." . $this->cur_datetime->format('d') . "." . $this->cur_datetime->format('m') . "." . $this->cur_datetime->format('y') . $code_sequence;

            $data_sequence = array(
                'sequence'   => $sequence,
                'created_at' => $this->cur_datetime->format('Y-m-d'),
            );
            $this->db->insert('sequence_orders', $data_sequence);
        } else {
            $sequence      = $exec_seq->row()->sequence + 1;
            $code_sequence = $this->generate_sequence($sequence);
            $sales_invoice = "PKG." . $this->cur_datetime->format('d') . "." . $this->cur_datetime->format('m') . "." . $this->cur_datetime->format('y') . $code_sequence;

            $data_sequence = array(
                'sequence'   => $sequence,
                'created_at' => $this->cur_datetime->format('Y-m-d'),
            );
            $where_sequence = array('id' => $exec_seq->row()->id);
            $this->db->update('sequence_orders', $data_sequence, $where_sequence);
        }

        $data_order_temp = array(
            'project_id'            => '',
            'sales_invoice'         => $sales_invoice,
            'durasi_batas_transfer' => '',
            'batas_waktu_transfer'  => '',
            'order_via'             => '',
            'product_id'            => '',
            'color_id'              => '',
            'size_id'               => '',
            'pilih_jahitan'         => '',
            'customer_id'           => '',
            'whatsapp'              => '',
            'status_order'          => '',
            'status_pembayaran'     => '',
            'sub_total'             => '',
            'kode_unik'             => $sequence,
            'grand_total'           => '',
            'jenis_dp'              => '',
            'dp_value'              => '',
            'pelunasan_value'       => '',
            'terbayarkan'           => '',
            'admin_order'           => '',
            'is_printed'            => 'no',
            'is_production'         => 'no',
            'is_paid_off'           => 'no',
            'status'                => 'temp',
            'created_at'            => $this->cur_datetime->format('Y-m-d H:i:s'),
            'created_by'            => $this->session->userdata('id'),
            'updated_at'            => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'            => $this->session->userdata('id'),
        );
        $this->store('orders', $data_order_temp);
        $id_order = $this->db->insert_id();

        return array(
            'id_order'             => $id_order,
            'sales_invoice'        => $sales_invoice,
            'kode_unik'            => $sequence,
            'created_at'           => $this->cur_datetime->format('Y-m-d H:i:s'),
            'batas_waktu_transfer' => $this->cur_datetime->modify('+3 hour')->format('Y-m-d H:i:s'),
            'estimasi_selesai'     => $this->cur_datetime->modify('+30 day')->format('Y-m-d'),
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
        $this->db->where('orders.status', 'temp');
        $this->db->where('orders.created_by', $this->session->userdata('id'));
        return $this->db->delete('orders');
    }

    public function clear_request()
    {
        $this->db->where('order_requests.created_by', $this->session->userdata('id'));
        $this->db->where('order_requests.updated_at', null);
        $this->db->where('order_requests.updated_by', null);
        return $this->db->delete('order_requests');
    }

    public function destroy_hpp($where)
    {
        return $this->db->delete('product_hpp_params', $where);
    }

    public function update($table, $data, $where)
    {
        return $this->db->update($table, $data, $where);
    }

    public function render_detail($order_id, $product_id, $color_id, $size_id, $kode_unik, $jenis_dp)
    {
        $data = array(
            'product_id' => $product_id,
            'color_id'   => $color_id,
            'size_id'    => $size_id,
        );
        $where = array('id' => $order_id);
        $this->db->update('orders', $data, $where);

        ////////////////////////////////////////
        $this->db->select('products.name as nama_produk, products.price as harga_produk');
        $this->db->from('orders');
        $this->db->join('products', 'products.id = orders.product_id', 'left');
        $this->db->where('orders.id', $order_id);

        if ($color_id != null) {
            $this->db->select('colors.name as nama_warna');
            $this->db->join('product_color_params', 'product_color_params.product_id = products.id', 'left');
            $this->db->join('colors', 'colors.id = product_color_params.color_id', 'left');
            $this->db->where('product_color_params.id', $color_id);
        }

        if ($size_id != null) {
            $this->db->select('sizes.name as nama_ukuran, sizes.cost as harga_ukuran');
            $this->db->join('product_size_params', 'product_size_params.product_id = products.id', 'left');
            $this->db->join('sizes', 'sizes.id = product_size_params.size_id', 'left');
            $this->db->where('product_size_params.id', $size_id);
        }

        $this->db->limit(1);
        $exec = $this->db->get();

        // echo $this->db->last_query();
        // echo '<pre>' . print_r($exec->result(), 1) . '</pre>';
        // exit;

        $nama_produk  = $exec->row()->nama_produk;
        $harga_produk = $exec->row()->harga_produk;
        $harga_ukuran = 0;

        $text_warna = " (Warna: -)";
        if ($color_id != null) {
            $nama_warna   = $exec->row()->nama_warna;
            $text_warna = " (Warna: " . $nama_warna . ")";
        }

        $html = '<tr>';
        $html .= '<td>' . $nama_produk . $text_warna . '</td>';
        $html .= '<td class="text-right">Rp ' . number_format($harga_produk, 2, ",", ".") . '</td>';
        $html .= '</tr>';

        if ($size_id != null) {
            $nama_ukuran  = $exec->row()->nama_ukuran;
            $harga_ukuran = $exec->row()->harga_ukuran;

            $html .= '<tr>';
            $html .= '<td>Size: ' . $nama_ukuran . '</td>';
            $html .= '<td class="text-right">' . number_format($harga_ukuran, 2, ",", ".") . '</td>';
            $html .= '</tr>';
        }

        $this->db->select(array(
            'order_requests.id',
            'requests.name',
            'requests.cost',
        ));

        $this->db->from('order_requests');
        $this->db->join('product_request_params', 'product_request_params.id = order_requests.request_id', 'left');
        $this->db->join('requests', 'requests.id = product_request_params.request_id', 'left');
        $this->db->where('order_requests.order_id', $order_id);
        $exec = $this->db->get();
        $harga_request = 0;
        if ($exec->num_rows() > 0) {
            foreach ($exec->result() as $key) {
                $id             = $key->id;
                $name           = $key->name;
                $cost           = $key->cost;
                $harga_request += $cost;

                $html .= '<tr>';
                $html .= '<td><button type="button" class="btn btn-xs btn-danger" onclick="removeRequest(' . $id . ', \'' . $cost . '\');"><i class="fas fa-times"></i></button> Request: ' . $name . '</td>';
                $html .= '<td class="text-right">' . number_format($cost, 2, ",", ".") . '</td>';
                $html .= '</tr>';
            }
        }


        $sub_total = $harga_produk + $harga_ukuran + $harga_request;

        // echo '<textarea style="width: 500px; height: 500px;">' . $html . '</textarea>';
        return array(
            'html' => $html,
            'sub_total' => $sub_total,
        );
    }

    public function remove_request($id)
    {
        return $this->db->delete('order_requests', ['id' => $id]);
    }

    public function copy_order($order_id, $product_id, $color_id, $size_id, $kode_unik, $jenis_dp, $catatan)
    {
        $this->db->select([
            "orders.sales_invoice",
            "orders.kode_unik",
            "products.name as nama_produk",
            "products.price as harga_produk",
        ]);
        $this->db->from("orders");
        $this->db->join("products", "products.id = orders.product_id", "left");
        $this->db->where("orders.id", $order_id);

        if ($color_id != null) {
            $this->db->select("colors.name as nama_warna");
            $this->db->join("product_color_params", "product_color_params.product_id = products.id", "left");
            $this->db->join("colors", "colors.id = product_color_params.color_id", "left");
            $this->db->where("product_color_params.id", $color_id);
        }

        if ($size_id != null) {
            $this->db->select("sizes.name as nama_ukuran, sizes.cost as harga_ukuran");
            $this->db->join("product_size_params", "product_size_params.product_id = products.id", "left");
            $this->db->join("sizes", "sizes.id = product_size_params.size_id", "left");
            $this->db->where("product_size_params.id", $size_id);
        }

        $this->db->limit(1);
        $exec = $this->db->get();

        // echo $this->db->last_query();
        // echo "<pre>" . print_r($exec->result(), 1) . "</pre>";
        // exit;

        $sales_invoice = $exec->row()->sales_invoice;
        $kode_unik     = $exec->row()->kode_unik;
        $nama_produk   = $exec->row()->nama_produk;
        $harga_produk  = $exec->row()->harga_produk;
        $harga_ukuran  = 0;

        $text_warna = " (Warna: -)";
        if ($color_id != null) {
            $nama_warna   = $exec->row()->nama_warna;
            $text_warna = " (Warna: " . $nama_warna . ")";
        }

        $html = "DETAIL ORDER \r\n";
        $html = "Sales Invoice: " . $sales_invoice . "\r\n";
        $html .= $nama_produk . $text_warna . " Rp" . number_format($harga_produk, 2, ",", ".") . "\r\n";

        if ($size_id != null) {
            $nama_ukuran  = $exec->row()->nama_ukuran;
            $harga_ukuran = $exec->row()->harga_ukuran;

            $html .= "Size: " . $nama_ukuran . " Rp " . number_format($harga_ukuran, 2, ",", ".") . "\r\n";
        }

        $this->db->select(array(
            "order_requests.id",
            "requests.name",
            "requests.cost",
        ));

        $this->db->from("order_requests");
        $this->db->join("product_request_params", "product_request_params.id = order_requests.request_id", "left");
        $this->db->join("requests", "requests.id = product_request_params.request_id", "left");
        $this->db->where("order_requests.order_id", $order_id);
        $exec = $this->db->get();
        $harga_request = 0;
        if ($exec->num_rows() > 0) {
            foreach ($exec->result() as $key) {
                $id             = $key->id;
                $name           = $key->name;
                $cost           = $key->cost;
                $harga_request += $cost;

                $html .= "Request: " . $name . " Rp " . number_format($cost, 2, ",", ".") . "\r\n";
            }
        }

        $sub_total   = $harga_produk + $harga_ukuran + $harga_request;
        $grand_total = $sub_total + $kode_unik;

        $val_dp = ($grand_total * $jenis_dp) / 100;
        $persen_lunas = 100 - $jenis_dp;
        $val_lunas = ($grand_total * $persen_lunas) / 100;

        $html .= "Sub total: Rp " . number_format($sub_total, 2, ",", ".") . "\r\n";
        $html .= "Kode Unik: Rp " . number_format($kode_unik, 0, ",", ".") . "\r\n";
        $html .= "Grand total: Rp " . number_format($grand_total, 2, ",", ".") . "\r\n";
        $html .= "DP " . $jenis_dp . "%: Rp " . number_format($val_dp, 2, ",", ".") . "\r\n";
        $html .= "Pelunasan " . $persen_lunas . "%: Rp " . number_format($val_lunas, 2, ",", ".") . "\r\n";
        if ($catatan != null) {
            $html .= "Catatan \r\n" . $catatan . "\r\n";
        }

        // echo "<textarea style="width: 500px; height: 500px;">" . $html . "</textarea>";
        // exit;
        return $html;
    }
}
                        
/* End of file Order_model.php */
