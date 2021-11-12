<script>
    $(document).ready(() => {
        //
    })

    function showModalDetail(id, sales_invoice) {
        $.ajax({
            url: `<?= base_url(); ?>shop/order_detail`,
            type: 'get',
            dataType: 'json',
            data: {
                order_id: id,
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
                    title: 'Gagal terhubung dengan database, silahkan coba kembali',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 404) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Order tidak ditemukan',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 200) {
                $('#sales_invoice_detail').text(sales_invoice)

                let htmlnya = ``;

                htmlnya += `
                <tr>
                    <th>Tanggal & Jam Order</th>
                    <td>${e.orders.created_at}</td>
                </tr>
                <tr>
                    <th>Batas Waktu Transfer</th>
                    <td>${e.orders.batas_waktu_transfer}</td>
                </tr>
                <tr>
                    <th>Estimasi Selesai</th>
                    <td>${e.orders.estimasi_selesai}</td>
                </tr>
                <tr>
                    <th>Produk</th>
                    <td>${e.orders.product_name}</td>
                </tr>
                <tr>
                    <th>Warna</th>
                    <td>${e.orders.color_name}</td>
                </tr>
                <tr>
                    <th>Ukuran</th>
                    <td>${e.orders.size_name}</td>
                </tr>
                <tr>
                    <th>Jahitan</th>
                    <td>${e.orders.pilih_jahitan}</td>
                </tr>
                `;

                let isiRequest = `-`;

                if (e.requests.length > 0) {
                    isiRequest = ``;
                    $.each(e.requests, (i, k) => {
                        isiRequest += `<p>${k.name}</p>`;
                    })
                }

                htmlnya += `
                <tr>
                    <th>Request</th>
                    <td>${isiRequest}</td>
                </tr>
                `;

                htmlnya += `
                <tr>
                    <th>Catatan</th>
                    <td>${e.orders.catatan}</td>
                </tr>
                <tr>
                    <th>Status Order</th>
                    <td>${e.orders.status_order}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td>${e.orders.status_pembayaran}</td>
                </tr>
                <tr>
                    <th>Sub Total</th>
                    <td>Rp.${e.orders.sub_total}</td>
                </tr>
                <tr>
                    <th>Kode Unik</th>
                    <td>${e.orders.kode_unik}</td>
                </tr>
                <tr>
                    <th>Grand Total</th>
                    <td>Rp.${e.orders.grand_total}</td>
                </tr>
                <tr>
                    <th>DP (${e.orders.dp_persen}%)</th>
                    <td>Rp.${e.orders.dp_value}</td>
                </tr>
                <tr>
                    <th>Pelunasan (${e.orders.pelunasan_persen}%)</th>
                    <td>Rp.${e.orders.pelunasan_value}</td>
                </tr>
                <tr>
                    <th>Terbayarkan</th>
                    <td>${e.orders.terbayarkan}</td>
                </tr>
                `;

                $('#v_detail').html(htmlnya)
                $('#modal_detail').modal('show')
            }
        })
    }

    function showModalDP(id, sales_invoice) {
        $.ajax({
            url: `<?= base_url(); ?>shop/check_pembayaran_dp`,
            type: 'get',
            dataType: 'json',
            data: {
                order_id: id,
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
                    title: 'Check Pembayaran Failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 404) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Pembayaran DP sedang dalam proses pemeriksaan',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 200) {
                $('#id_dp').val(id)
                $('#sales_invoice_dp').text(sales_invoice)
                $('#path_image_dp').val(null)
                $('#modal_dp').modal('show')
            }
        })
    }

    function showModalPelunasan(id, sales_invoice) {
        $.ajax({
            url: `<?= base_url(); ?>shop/check_pembayaran_pelunasan`,
            type: 'get',
            dataType: 'json',
            data: {
                order_id: id,
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
                    title: 'Check Pembayaran Failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 404) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Pembayaran Pelunasan sedang dalam proses pemeriksaan',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 200) {
                $('#id_pelunasan').val(id)
                $('#sales_invoice_pelunasan').text(sales_invoice)
                $('#path_image_pelunasan').val(null)
                $('#modal_pelunasan').modal('show')
            }
        })
    }
</script>