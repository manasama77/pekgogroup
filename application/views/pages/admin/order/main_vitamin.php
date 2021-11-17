<script>
    $(document).ready(() => {
        $('.select2').select2()
    })
</script>

<script>
    function showRequest(id, sales_invoice) {
        $.ajax({
            url: `<?= base_url(); ?>order/show_request`,
            type: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            beforeSend: () => $.blockUI({
                message: `<i class="fas fa-spinner fa-spin"></i>`
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            if (e.code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Show request failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 200) {
                let rend = '';
                $.each(e.data, (i, k) => {
                    rend += `<p>${k.nama_request} - ${currency(k.harga_request)}</p>`
                })
                Swal.fire({
                    title: `Request Order ${sales_invoice}`,
                    html: rend,
                    showConfirmButton: false,
                })
            }
        })
    }

    function showCatatan(catatan, sales_invoice) {
        Swal.fire({
            title: `Catatan Order ${sales_invoice}`,
            html: catatan,
            showConfirmButton: false,
        })
    }

    function copyOrder(order_id, product_id, color_id, size_id, kode_unik, jenis_dp, pilih_jahitan) {
        $.ajax({
            url: `<?= base_url(); ?>order/copy_order`,
            type: 'get',
            dataType: 'json',
            data: {
                order_id: order_id,
                product_id: product_id,
                color_id: color_id,
                size_id: size_id,
                kode_unik: kode_unik,
                jenis_dp: jenis_dp,
                pilih_jahitan: pilih_jahitan,
            },
            beforeSend: () => $.blockUI({
                message: `<i class="fas fa-spinner fa-spin"></i>`
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            console.log(e)
            if (e.code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Copy Detail Order Failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 200) {
                copyClipboard(e.data)
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Copy Detail Order Success',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            }
        })
    }

    function showDetail(id, sales_invoice) {
        $.ajax({
            url: `<?= base_url(); ?>order/show_detail`,
            type: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            beforeSend: () => $.blockUI({
                message: `<i class="fas fa-spinner fa-spin"></i>`
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            console.log(e)
            if (e[0].code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Show Detail Failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e[0].code == 200) {
                let htmlnya = ''

                let requestsnya = ''

                $.each(e[0].requests, (i, k) => {
                    requestsnya += `<p>k.name</p>`
                })

                htmlnya += `
                <tr>
                    <th>Tanggal & Jam Order</th>
                    <th>${e[0].orders.created_at}</th>
                </tr>
                <tr>
                    <th>Durasi Batas Transfer</th>
                    <th>${e[0].orders.durasi_batas_transfer} Jam</th>
                </tr>
                <tr>
                    <th>Batas Waktu Transfer</th>
                    <th>${e[0].orders.batas_waktu_transfer}</th>
                </tr>
                <tr>
                    <th>Estimasi Selesai</th>
                    <th>${e[0].orders.estimasi_selesai}</th>
                </tr>
                <tr>
                    <th>Order Via</th>
                    <th>${e[0].orders.order_via}</th>
                </tr>
                <tr>
                    <th>Customer</th>
                    <th>${e[0].orders.customer_name}</th>
                </tr>
                <tr>
                    <th>Whatsapp</th>
                    <th>${e[0].orders.whatsapp}</th>
                </tr>
                <tr>
                    <th>ID Tokped</th>
                    <th>${e[0].orders.id_tokped}</th>
                </tr>
                <tr>
                    <th>ID Shopee</th>
                    <th>${e[0].orders.id_shopee}</th>
                </tr>
                <tr>
                    <th>ID Instagram</th>
                    <th>${e[0].orders.id_instagram}</th>
                </tr>
                <tr>
                    <th>Produk</th>
                    <th>${e[0].orders.product_name}</th>
                </tr>
                <tr>
                    <th>Warna</th>
                    <th>${e[0].orders.color_name}</th>
                </tr>
                <tr>
                    <th>Ukuran</th>
                    <th>${e[0].orders.size_name}</th>
                </tr>
                <tr>
                    <th>Jahitan</th>
                    <th>${e[0].orders.pilih_jahitan}</th>
                </tr>
                <tr>
                    <th>Request</th>
                    <th>${requestsnya}</th>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <th>${e[0].orders.catatan}</th>
                </tr>
                <tr>
                    <th>Status Order</th>
                    <th>${e[0].orders.status_order}</th>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <th>${e[0].orders.status_pembayaran}</th>
                </tr>
                <tr>
                    <th>Sub Total</th>
                    <th>Rp.${e[0].orders.sub_total}</th>
                </tr>
                <tr>
                    <th>Kode Unik</th>
                    <th>Rp.${e[0].orders.kode_unik}</th>
                </tr>
                <tr>
                    <th>Grand Total</th>
                    <th>Rp.${e[0].orders.grand_total}</th>
                </tr>
                <tr>
                    <th>DP (${e[0].orders.dp_persen}%)</th>
                    <th>Rp.${e[0].orders.dp_value}</th>
                </tr>
                <tr>
                    <th>Pelunasan (${e[0].orders.pelunasan_persen}%)</th>
                    <th>Rp.${e[0].orders.pelunasan_value}</th>
                </tr>
                `

                $('#v_sales_invoice').text(sales_invoice)
                $('#v_detail').html(htmlnya)
                $('#modal_detail').modal('show')
            }
        })
    }
</script>