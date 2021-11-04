<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cli_model extends CI_Model
{

    public function check_expired()
    {
        $sql = "
        SELECT
            orders.id,
            orders.customer_id,
            orders.grand_total
        FROM
            orders 
        WHERE
            orders.batas_waktu_transfer < NOW() 
            AND orders.status_pembayaran = 'menunggu pembayaran' 
            AND orders.`status` = 'active' 
            AND orders.deleted_at IS NULL 
            AND (
            SELECT
                count(*) 
            FROM
                order_payments 
            WHERE
                order_payments.order_id = orders.id 
                AND order_payments.status_pembayaran IN ( 'menunggu verifikasi', 'valid' ) 
            AND order_payments.deleted_at IS NULL 
            ) = 0
        ";

        $exec = $this->db->query($sql);

        if ($exec->num_rows() == 0) {
            echo "Tidak ada data pembayaran expired" . PHP_EOL;
        } else {
            foreach ($exec->result() as $key) {
                $id          = $key->id;
                $customer_id = $key->customer_id;
                $grand_total = $key->grand_total;

                $this->db->set('orders.status_order', 'order dibatalkan');
                $this->db->where('orders.id', $id);
                $this->db->update('orders');

                $this->db->set('customers.order_canceled', 'customers.order_canceled + 1', false);
                $this->db->where('customers.id', $customer_id);
                $this->db->update('customers');

                $sql = "
                UPDATE `customers` 
                SET customers.order_total = 
                    CASE 
                        WHEN customers.order_total < " . $grand_total . " 
                        THEN customers.order_total 
                        ELSE customers.order_total - " . $grand_total . " END
                WHERE
                    `customers`.`id` = " . $customer_id . " 
                ";
                $this->db->query($sql);
            }
        }
    }

    public function check_resi()
    {
        $this->db->select('id, ekspedisi, no_resi');
        $this->db->where_in('status_pengiriman', ["antrian", "proses pengiriman"]);
        $this->db->where('ekspedisi !=', null);
        $this->db->where('no_resi !=', null);
        $exec = $this->db->get('orders');

        if ($exec->num_rows() > 0) {
            foreach ($exec->result() as $key) {
                $id        = $key->id;
                $ekspedisi = $key->ekspedisi;
                $no_resi   = $key->no_resi;

                $this->check_rajaongkir($id, $ekspedisi, $no_resi);
            }
        }
    }

    protected function check_rajaongkir($id, $ekspedisi, $no_resi)
    {
        $ekspedisi = strtolower($ekspedisi);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "waybill=" . $no_resi . "&courier=" . $ekspedisi,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key:" . RAJAONGKIR_API_KEY
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo $err . PHP_EOL;
            exit;
        }

        $obj = json_decode($response);

        foreach ($obj as $key) {
            if ($key->status->code == 200) {
                if ($key->result->delivered == 1) {
                    $data  = ['status_order' => 'selesai', 'status_pengiriman' => 'terkirim'];
                    $where = ['id' => $id];
                    $this->db->update('orders', $data, $where);
                    echo $no_resi . PHP_EOL;
                }
            }
        }
    }
}
                        
/* End of file Cli_model.php */
