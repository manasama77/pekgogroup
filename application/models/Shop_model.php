<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shop_model extends CI_Model
{

    protected $cur_datetime;

    public function __construct()
    {
        parent::__construct();
        $this->cur_datetime = new DateTime('now');
    }


    public function generate_kode_unik()
    {
        $this->db->from('sequence_orders');
        $this->db->where('sequence_orders.created_at', $this->cur_datetime->format('Y-m-d'));
        $exec_seq = $this->db->get();

        if ($exec_seq->num_rows() == 0) {
            $sequence      = 1;
            $data_sequence = array(
                'sequence'   => $sequence,
                'created_at' => $this->cur_datetime->format('Y-m-d'),
            );
            $this->db->insert('sequence_orders', $data_sequence);
        } else {
            $sequence      = $exec_seq->row()->sequence + 1;
            $data_sequence = array(
                'sequence'   => $sequence,
                'created_at' => $this->cur_datetime->format('Y-m-d'),
            );
            $where_sequence = array('id' => $exec_seq->row()->id);
            $this->db->update('sequence_orders', $data_sequence, $where_sequence);
        }

        return $sequence;
    }

    public function generate_sales_invoice($kode_unik)
    {
        $code_sequence = $this->unique_invoice($kode_unik);
        $sales_invoice = "PKG." . $this->cur_datetime->format('d') . "." . $this->cur_datetime->format('m') . "." . $this->cur_datetime->format('y') . $code_sequence;
        return $sales_invoice;
    }

    protected function unique_invoice($kode_unik)
    {
        if ($kode_unik < 10) {
            return "00" . $kode_unik;
        } elseif ($kode_unik < 100) {
            return "0" . $kode_unik;
        } else {
            return $kode_unik;
        }
    }
}
                        
/* End of file Shop_model.php */
