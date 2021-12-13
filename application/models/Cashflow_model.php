<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cashflow_model extends CI_Model
{

    protected $select;

    public function __construct()
    {
        parent::__construct();
        $this->select = array(
            'cashflow.id',
            'cashflow.tanggal',
            'cashflow.account_id',
            'cashflow.no_voucher',
            'cashflow.dari_untuk',
            'cashflow.keterangan',
            'cashflow.debet',
            'cashflow.kredit',
            'cashflow.jenis_cashflow',
            'accounts.no_akun',
            'accounts.nama_akun',
        );
    }

    public function get_all_data($from = null, $to = null, $jenis_cashflow = null)
    {
        if ($from == null && $to == null) {
            $return  = [
                'code' => 404,
                'data' => [],
            ];
        } else {
            $this->db->select($this->select);
            $this->db->from('cashflow');
            $this->db->join('accounts', 'accounts.id = cashflow.account_id', 'left');
            $this->db->where('cashflow.deleted_at', null);

            if ($from != null && $to != null) {
                $this->db->where('cashflow.tanggal >=', $from);
                $this->db->where('cashflow.tanggal <=', $to);
            }

            if ($jenis_cashflow != null) {
                $this->db->where('cashflow.jenis_cashflow', $jenis_cashflow);
            }

            $this->db->order_by('cashflow.tanggal', 'asc');
            $this->db->order_by('cashflow.created_at', 'asc');
            $exec = $this->db->get();

            $return  = [
                'code' => 404,
                'data' => [],
            ];
            $total = 0;
            $x     = 0;

            foreach ($exec->result() as $key) {
                $total += $key->debet;
                $total -= $key->kredit;

                $return['data'][$x]['id']         = $key->id;
                $return['data'][$x]['tanggal']    = $key->tanggal;
                $return['data'][$x]['no_akun']    = $key->no_akun;
                $return['data'][$x]['nama_akun']  = $key->nama_akun;
                $return['data'][$x]['no_voucher'] = $key->no_voucher;
                $return['data'][$x]['dari_untuk'] = $key->dari_untuk;
                $return['data'][$x]['keterangan'] = nl2br($key->keterangan);
                $return['data'][$x]['debet']      = number_format($key->debet, 2);
                $return['data'][$x]['kredit']     = number_format($key->kredit, 2);
                $return['data'][$x]['total']      = number_format($total, 2);

                $x++;
                $return['code'] = 200;
            }
        }

        return $return;
    }

    public function get_monthly_data($month, $year, $jenis_cashflow)
    {
        $this->db->select($this->select);
        $this->db->from('cashflow');
        $this->db->join('accounts', 'accounts.id = cashflow.account_id', 'left');
        $this->db->where('cashflow.deleted_at', null);

        $this->db->where('MONTH(cashflow.tanggal)', $month);
        $this->db->where('YEAR(cashflow.tanggal)', $year);

        $this->db->where('cashflow.jenis_cashflow', $jenis_cashflow);

        $this->db->order_by('cashflow.tanggal', 'asc');
        $this->db->order_by('cashflow.created_at', 'asc');
        $exec = $this->db->get();

        $return  = [
            'code' => 404,
            'data' => [],
        ];
        $total = 0;
        $x     = 0;

        foreach ($exec->result() as $key) {
            $total += $key->debet;
            $total -= $key->kredit;

            $return['data'][$x]['id']         = $key->id;
            $return['data'][$x]['tanggal']    = $key->tanggal;
            $return['data'][$x]['no_akun']    = $key->no_akun;
            $return['data'][$x]['nama_akun']  = $key->nama_akun;
            $return['data'][$x]['no_voucher'] = $key->no_voucher;
            $return['data'][$x]['dari_untuk'] = $key->dari_untuk;
            $return['data'][$x]['keterangan'] = nl2br($key->keterangan);
            $return['data'][$x]['debet']      = number_format($key->debet, 2);
            $return['data'][$x]['kredit']     = number_format($key->kredit, 2);
            $return['data'][$x]['total']      = number_format($total, 2);

            $x++;
            $return['code'] = 200;
        }

        return $return;
    }


    public function store($data)
    {
        return $this->db->insert('cashflow', $data);
    }

    public function update($data, $where)
    {
        return $this->db->update('cashflow', $data, $where);
    }

    public function destroy($data, $where)
    {
        return $this->db->update('cashflow', $data, $where);
    }

    public function render_account_list()
    {
        $this->db->select([
            'account_groups.id as account_group_id',
            'account_groups.name as kelompok_akun',
        ]);
        $this->db->where('account_groups.deleted_at', null);
        $this->db->order_by('account_groups.name', 'asc');
        $exec = $this->db->get('account_groups');

        $data = "";
        foreach ($exec->result() as $key) {
            $account_group_id = $key->account_group_id;
            $this->db->select([
                'accounts.id',
                'accounts.no_akun',
                'accounts.nama_akun',
            ]);
            $this->db->where('accounts.deleted_at', null);
            $this->db->where('accounts.account_group_id', $account_group_id);
            $this->db->order_by('accounts.no_akun', 'asc');
            $exec_account = $this->db->get('accounts');

            if ($exec_account->num_rows() > 0) {
                $data .= '<optgroup label="' . $key->kelompok_akun . '">';
            }

            foreach ($exec_account->result() as $key2) {
                $data .= '<option value="' . $key2->id . '">' . $key2->no_akun . ' ' . $key2->nama_akun . '</option>';
            }

            if ($exec_account->num_rows() > 0) {
                $data .= "</optgroup>";
            }
        }
        return $data;
    }
}
                        
/* End of file Cashflow_model.php */
