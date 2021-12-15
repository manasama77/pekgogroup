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

    public function render_rekap($tahun)
    {
        $header_bulan = "";
        $content2     = "";
        $content3     = "";
        $content4     = "";

        for ($i = 1; $i <= 12; $i++) {
            $header_bulan .= "<th>" . $this->convert_nama_bulan($i) . "</th>";
        }

        $this->db->where('accounts.deleted_at', null);
        $this->db->where('SUBSTRING(accounts.no_akun, 1, 1) =', "2");
        $this->db->order_by('accounts.no_akun', 'asc');
        $accounts = $this->db->get('accounts');

        $total_x  = 0;
        $total_1  = 0;
        $total_2  = 0;
        $total_3  = 0;
        $total_4  = 0;
        $total_5  = 0;
        $total_6  = 0;
        $total_7  = 0;
        $total_8  = 0;
        $total_9  = 0;
        $total_10 = 0;
        $total_11 = 0;
        $total_12 = 0;
        foreach ($accounts->result() as $account) {
            $content2 .= "<tr>";
            $content2 .= "<th>$account->no_akun</th>";
            $content2 .= "<th>$account->nama_akun</th>";

            $total_y = 0;
            for ($i = 1; $i <= 12; $i++) {
                $sql = "
                SELECT
                    ( SUM( cashflow.debet ) + SUM( cashflow.kredit ) ) AS total 
                FROM
                    cashflow 
                WHERE
                    cashflow.deleted_at IS NULL 
                    AND account_id = $account->id 
                    AND MONTH ( cashflow.tanggal ) = $i 
                    AND YEAR ( cashflow.tanggal ) = $tahun
                ";
                $casflows = $this->db->query($sql);
                $content2 .= '<th class="text-right">' . number_format($casflows->row()->total, 2) . '</th>';
                $total_y += $casflows->row()->total;
                $total_x += $casflows->row()->total;

                if ($i == 1) {
                    $total_1 += $casflows->row()->total;
                }
                if ($i == 2) {
                    $total_2 += $casflows->row()->total;
                }
                if ($i == 3) {
                    $total_3 += $casflows->row()->total;
                }
                if ($i == 4) {
                    $total_4 += $casflows->row()->total;
                }
                if ($i == 5) {
                    $total_5 += $casflows->row()->total;
                }
                if ($i == 6) {
                    $total_6 += $casflows->row()->total;
                }
                if ($i == 7) {
                    $total_7 += $casflows->row()->total;
                }
                if ($i == 8) {
                    $total_8 += $casflows->row()->total;
                }
                if ($i == 9) {
                    $total_9 += $casflows->row()->total;
                }
                if ($i == 10) {
                    $total_10 += $casflows->row()->total;
                }
                if ($i == 11) {
                    $total_11 += $casflows->row()->total;
                }
                if ($i == 12) {
                    $total_12 += $casflows->row()->total;
                }
            }

            $content2 .= '<th class="text-right">' . number_format($total_y, 2) . '</th>';
            $content2 .= "</tr>";
        }
        $content2 .= '<tr class="bg-dark">';
        $content2 .= '<th></th>';
        $content2 .= '<th>SUBTOTAL PENDAPATAN</th>';
        $content2 .= '<th class="text-right">' . number_format($total_1, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_2, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_3, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_4, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_5, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_6, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_7, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_8, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_9, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_10, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_11, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_12, 2) . '</th>';
        $content2 .= '<th class="text-right">' . number_format($total_x, 2) . '</th>';
        $content2 .= "</tr>";

        $this->db->where('accounts.deleted_at', null);
        $this->db->where('SUBSTRING(accounts.no_akun, 1, 1) !=', "2");
        $this->db->order_by('accounts.no_akun', 'asc');
        $accounts3 = $this->db->get('accounts');

        $total_x3 = 0;
        $total_13 = 0;
        $total_23 = 0;
        $total_33 = 0;
        $total_43 = 0;
        $total_53 = 0;
        $total_63 = 0;
        $total_73 = 0;
        $total_83 = 0;
        $total_93 = 0;
        $total_103 = 0;
        $total_113 = 0;
        $total_123 = 0;
        foreach ($accounts3->result() as $account) {
            $content3 .= "<tr>";
            $content3 .= "<th>$account->no_akun</th>";
            $content3 .= "<th>$account->nama_akun</th>";

            $total_y = 0;
            for ($i = 1; $i <= 12; $i++) {
                $sql = "
                SELECT
                    ( SUM( cashflow.debet ) + SUM( cashflow.kredit ) ) AS total 
                FROM
                    cashflow 
                WHERE
                    cashflow.deleted_at IS NULL 
                    AND account_id = $account->id 
                    AND MONTH ( cashflow.tanggal ) = $i 
                    AND YEAR ( cashflow.tanggal ) = $tahun
                ";
                $casflows = $this->db->query($sql);
                $content3 .= '<th class="text-right">' . number_format($casflows->row()->total, 2) . '</th>';
                $total_y += $casflows->row()->total;
                $total_x3 += $casflows->row()->total;

                if ($i == 1) {
                    $total_13 += $casflows->row()->total;
                }
                if ($i == 2) {
                    $total_23 += $casflows->row()->total;
                }
                if ($i == 3) {
                    $total_33 += $casflows->row()->total;
                }
                if ($i == 4) {
                    $total_43 += $casflows->row()->total;
                }
                if ($i == 5) {
                    $total_53 += $casflows->row()->total;
                }
                if ($i == 6) {
                    $total_63 += $casflows->row()->total;
                }
                if ($i == 7) {
                    $total_73 += $casflows->row()->total;
                }
                if ($i == 8) {
                    $total_83 += $casflows->row()->total;
                }
                if ($i == 9) {
                    $total_93 += $casflows->row()->total;
                }
                if ($i == 10) {
                    $total_103 += $casflows->row()->total;
                }
                if ($i == 11) {
                    $total_113 += $casflows->row()->total;
                }
                if ($i == 12) {
                    $total_123 += $casflows->row()->total;
                }
            }

            $content3 .= '<th class="text-right">' . number_format($total_y, 2) . '</th>';
            $content3 .= "</tr>";
        }
        $content3 .= '<tr class="bg-dark">';
        $content3 .= '<th></th>';
        $content3 .= '<th>SUBTOTAL PENGELUARAN</th>';
        $content3 .= '<th class="text-right">' . number_format($total_13, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_23, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_33, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_43, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_53, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_63, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_73, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_83, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_93, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_103, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_113, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_123, 2) . '</th>';
        $content3 .= '<th class="text-right">' . number_format($total_x3, 2) . '</th>';
        $content3 .= "</tr>";

        $content4 .= '<tr class="bg-dark">';
        $content4 .= '<th></th>';
        $content4 .= '<th>GRAND TOTAL</th>';
        $content4 .= '<th class="text-right"><strong>' . number_format($total_1 - $total_13, 2) . '<strong></th>';
        $content4 .= '<th class="text-right">' . number_format($total_2 - $total_23, 2) . '</th>';
        $content4 .= '<th class="text-right">' . number_format($total_3 - $total_33, 2) . '</th>';
        $content4 .= '<th class="text-right">' . number_format($total_4 - $total_43, 2) . '</th>';
        $content4 .= '<th class="text-right">' . number_format($total_5 - $total_53, 2) . '</th>';
        $content4 .= '<th class="text-right">' . number_format($total_6 - $total_63, 2) . '</th>';
        $content4 .= '<th class="text-right">' . number_format($total_7 - $total_73, 2) . '</th>';
        $content4 .= '<th class="text-right">' . number_format($total_8 - $total_83, 2) . '</th>';
        $content4 .= '<th class="text-right">' . number_format($total_9 - $total_93, 2) . '</th>';
        $content4 .= '<th class="text-right">' . number_format($total_10 - $total_103, 2) . '</th>';
        $content4 .= '<th class="text-right">' . number_format($total_11 - $total_113, 2) . '</th>';
        $content4 .= '<th class="text-right">' . number_format($total_12 - $total_123, 2) . '</th>';
        $content4 .= '<th class="text-right">' . number_format($total_x - $total_x3, 2) . '</th>';
        $content4 .= "</tr>";


        $htmlnya = '<table id="table1" class="table table-bordered table-sm bg-light">';
        $htmlnya .= '<caption>Data Rekap Cashflow ' . $tahun . '</caption>';
        $htmlnya .= '<thead>';
        $htmlnya .= '<tr>';
        $htmlnya .= '<th>AKUN</th>';
        $htmlnya .= '<th>KETERANGAN</th>';
        $htmlnya .= $header_bulan;
        $htmlnya .= '<th>TOTAL</th>';
        $htmlnya .= '</tr>';
        $htmlnya .= '</thead>';
        $htmlnya .= '<tbody>';
        $htmlnya .= $content2;
        $htmlnya .= $content3;
        $htmlnya .= $content4;
        $htmlnya .= '</tbody>';
        $htmlnya .= '</table>';

        return $htmlnya;
    }

    public function convert_nama_bulan($i)
    {
        if ($i == 1) {
            return "Januari";
        } elseif ($i == 2) {
            return "Febuari";
        } elseif ($i == 3) {
            return "Maret";
        } elseif ($i == 4) {
            return "April";
        } elseif ($i == 5) {
            return "Mei";
        } elseif ($i == 6) {
            return "Juni";
        } elseif ($i == 7) {
            return "Juli";
        } elseif ($i == 8) {
            return "Agustus";
        } elseif ($i == 9) {
            return "September";
        } elseif ($i == 10) {
            return "Oktober";
        } elseif ($i == 11) {
            return "November";
        } elseif ($i == 12) {
            return "Desember";
        }
    }
}
                        
/* End of file Cashflow_model.php */
