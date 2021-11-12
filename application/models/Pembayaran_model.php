<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
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
            'products.name as nama_produk',
            'products.price as harga_produk',
            'colors.name as nama_warna',
            'sizes.name as nama_ukuran',
            'sizes.cost as harga_ukuran',
            'customers.name as nama_customer',
            'admin_order.name as nama_admin_order',
            'admin_produksi.name as nama_admin_produksi',
            'admin_cs.name as nama_admin_cs',
            'admin_finance.name as nama_admin_finance',
        );
    }

    public function get_all_data($product_id, $customer_id, $field, $keyword)
    {
        $this->db->select($this->select);
        $this->db->from('orders');
        $this->db->join('products', 'products.id = orders.product_id', 'left');
        $this->db->join('product_color_params', 'product_color_params.id = orders.color_id', 'left');
        $this->db->join('colors', 'colors.id = product_color_params.color_id', 'left');
        $this->db->join('product_size_params', 'product_size_params.id = orders.size_id', 'left');
        $this->db->join('sizes', 'sizes.id = product_size_params.size_id', 'left');
        $this->db->join('customers', 'customers.id = orders.customer_id', 'left');
        $this->db->join('admins as admin_order', 'admin_order.id = orders.admin_order', 'left');
        $this->db->join('admins as admin_produksi', 'admin_produksi.id = orders.admin_produksi', 'left');
        $this->db->join('admins as admin_cs', 'admin_cs.id = orders.admin_cs', 'left');
        $this->db->join('admins as admin_finance', 'admin_finance.id = orders.admin_finance', 'left');

        if ($product_id != 'all') {
            $this->db->where('orders.product_id', $product_id);
        }

        if ($customer_id != 'all') {
            $this->db->where('orders.customer_id', $customer_id);
        }

        if ($field == 'all') {
            $this->db->group_start();
            $this->db->like('orders.created_at', $keyword);
            $this->db->or_like('orders.sales_invoice', $keyword);
            $this->db->or_like('orders.whatsapp', $keyword);
            $this->db->or_like('orders.id_tokped', $keyword);
            $this->db->or_like('orders.id_shopee', $keyword);
            $this->db->or_like('orders.id_instagram', $keyword);
            $this->db->or_like('orders.grand_total', $keyword);
            $this->db->group_end();
        } else {
            $this->db->like('orders.' . $field, $keyword);
        }

        $array_status_order = ['order dibuat', 'naik produksi'];
        $this->db->where_in('orders.status_order', $array_status_order);

        $array_status_pembayaran = ['menunggu pembayaran', 'partial'];
        $this->db->where_in('orders.status_pembayaran', $array_status_pembayaran);

        $this->db->where('orders.status', 'active');
        $this->db->where('orders.deleted_at', null);
        $this->db->order_by('orders.id', 'desc');
        $exec = $this->db->get();

        return $exec;
    }

    public function get_data_dp($id)
    {
        $this->db->from('order_payments');
        $this->db->where('order_payments.order_id', $id);
        $this->db->where('order_payments.status_pembayaran', 'menunggu verifikasi');
        $this->db->where('order_payments.jenis_pembayaran', 'dp');
        $this->db->where('order_payments.deleted_at', null);
        return $this->db->get();
    }

    public function approve_dp($id, $order_id)
    {
        $data = [
            'status_pembayaran' => 'valid',
            'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'        => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['id' => $id];
        $this->db->update('order_payments', $data, $where);

        $this->db->select('orders.jenis_dp, orders.dp_value');
        $this->db->where('orders.id', $order_id);
        $exec     = $this->db->get('orders');
        $jenis_dp = $exec->row()->jenis_dp;
        $dp_value = $exec->row()->dp_value;

        if ($jenis_dp == 100) {
            $status_pembayaran = 'lunas';
            $is_paid_off       = 'yes';
        } else {
            $status_pembayaran = 'partial';
            $is_paid_off       = 'no';
        }

        $data = [
            'status_pembayaran' => $status_pembayaran,
            'terbayarkan'       => $dp_value,
            'is_paid_off'       => $is_paid_off,
            'admin_finance'     => $this->session->userdata(SESS_ADM . 'id'),
            'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'        => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['id' => $order_id];
        return $this->db->update('orders', $data, $where);
    }

    public function reject_dp($id, $alasan_penolakan)
    {
        $data = [
            'status_pembayaran' => 'ditolak',
            'alasan_penolakan'  => $alasan_penolakan,
            'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'        => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['id' => $id];
        return $this->db->update('order_payments', $data, $where);
    }

    public function get_data_pelunasan($id)
    {
        $this->db->from('order_payments');
        $this->db->where('order_payments.order_id', $id);
        $this->db->where('order_payments.status_pembayaran', 'menunggu verifikasi');
        $this->db->where('order_payments.jenis_pembayaran', 'pelunasan');
        $this->db->where('order_payments.deleted_at', null);
        return $this->db->get();
    }

    public function approve_pelunasan($id, $order_id)
    {
        $data = [
            'status_pembayaran' => 'valid',
            'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'        => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['id' => $id];
        $this->db->update('order_payments', $data, $where);

        $this->db->select('orders.grand_total');
        $this->db->where('orders.id', $order_id);
        $exec        = $this->db->get('orders');
        $grand_total = $exec->row()->grand_total;

        $status_pembayaran = 'lunas';
        $is_paid_off       = 'yes';

        $data = [
            'status_pembayaran' => $status_pembayaran,
            'terbayarkan'       => $grand_total,
            'is_paid_off'       => $is_paid_off,
            'admin_finance'     => $this->session->userdata(SESS_ADM . 'id'),
            'updated_at'        => $this->cur_datetime->format('Y-m-d H:i:s'),
            'updated_by'        => $this->session->userdata(SESS_ADM . 'id'),
        ];
        $where = ['id' => $order_id];
        $exec = $this->db->update('orders', $data, $where);

        $this->db->where('order_productions.order_id', $order_id);
        $exec = $this->db->get('order_productions');
        if ($exec->num_rows() == 1) {
            $petugas_potong_kain = ($exec->row()->petugas_potong_kain) ?? null;
            $petugas_jahit       = ($exec->row()->petugas_jahit) ?? null;
            $petugas_qc_1        = ($exec->row()->petugas_qc_1) ?? null;
            $petugas_aksesoris   = ($exec->row()->petugas_aksesoris) ?? null;
            $petugas_qc_2        = ($exec->row()->petugas_qc_2) ?? null;

            if ($petugas_potong_kain != null && $petugas_jahit != null && $petugas_qc_1 != null && $petugas_aksesoris != null && $petugas_qc_2 != null) {
                $data = [
                    'status_order' => 'pengiriman',
                    'updated_at'   => $this->cur_datetime->format('Y-m-d H:i:s'),
                    'updated_by'   => $this->session->userdata(SESS_ADM . 'id'),
                ];
                $this->db->where('orders.status_pembayaran', 'lunas');
                $this->db->where('orders.id', $order_id);
                $this->db->update('orders', $data);
            }
        }

        return $exec;
    }

    public function cek_pembayaran_dp($id)
    {
        $this->db->from('order_payments');
        $this->db->where('order_payments.order_id', $id);
        $this->db->where('order_payments.jenis_pembayaran', 'dp');
        $this->db->where_in('order_payments.status_pembayaran', ['menunggu verifikasi', 'valid']);
        $exec = $this->db->get();

        if ($exec->num_rows() == 0) {
            return 200;
        } elseif ($exec->num_rows() > 0) {
            return 404;
        } else {
            return 500;
        }
    }

    public function store_dp($data, $order_id, $alamat_pengiriman)
    {
        if ($alamat_pengiriman != null || $alamat_pengiriman != "") {
            $object = ['alamat_pengiriman' => $alamat_pengiriman];
            $where  = ['id' => $order_id];
            $this->db->update('orders', $object, $where);
        }

        return $this->db->insert('order_payments', $data);
    }

    public function update_order($data, $where)
    {
        return $this->db->update('orders', $data, $where);
    }

    public function cek_pembayaran_pelunasan($id)
    {
        $this->db->from('order_payments');
        $this->db->where('order_payments.order_id', $id);
        $this->db->where('order_payments.jenis_pembayaran', 'pelunasan');
        $this->db->where_in('order_payments.status_pembayaran', ['menunggu verifikasi', 'valid']);
        $exec = $this->db->get();

        if ($exec->num_rows() == 0) {
            return 200;
        } elseif ($exec->num_rows() > 0) {
            return 404;
        } else {
            return 500;
        }
    }

    public function store_pelunasan($data, $order_id, $alamat_pengiriman)
    {
        if ($alamat_pengiriman != null || $alamat_pengiriman != "") {
            $object = ['alamat_pengiriman' => $alamat_pengiriman];
            $where  = ['id' => $order_id];
            $this->db->update('orders', $object, $where);
        }

        return $this->db->insert('order_payments', $data);
    }

    public function check_produksi($order_id)
    {
        $this->db->where('order_productions.order_id', $order_id);
        $exec = $this->db->get('order_productions');
        if ($exec->num_rows() == 1) {
            $petugas_potong_kain = ($exec->row()->petugas_potong_kain) ?? null;
            $petugas_jahit       = ($exec->row()->petugas_jahit) ?? null;
            $petugas_qc_1        = ($exec->row()->petugas_qc_1) ?? null;
            $petugas_aksesoris   = ($exec->row()->petugas_aksesoris) ?? null;
            $petugas_qc_2        = ($exec->row()->petugas_qc_2) ?? null;

            if ($petugas_potong_kain != null && $petugas_jahit != null && $petugas_qc_1 != null && $petugas_aksesoris != null && $petugas_qc_2 != null) {
                $data = [
                    'status_order' => 'pengiriman',
                    'updated_at'   => $this->cur_datetime->format('Y-m-d H:i:s'),
                    'updated_by'   => $this->session->userdata(SESS_ADM . 'id'),
                ];
                $this->db->where('orders.status_pembayaran', 'lunas');
                $this->db->where('orders.id', $order_id);
                $this->db->update('orders', $data);
            }
        }
    }

    public function store_dp_2($data)
    {
        return $this->db->insert('order_payments', $data);
    }

    public function store_pelunasan_2($data)
    {
        return $this->db->insert('order_payments', $data);
    }
}
                        
/* End of file Pembayaran_model.php */
