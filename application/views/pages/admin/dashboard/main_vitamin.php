<script>
    $(document).ready(() => {
        $('#form_track').on('submit', e => {
            e.preventDefault()
            tracking()
        })
    })

    function tracking() {
        $.ajax({
            url: `<?= base_url(); ?>dashboard/show_track`,
            type: 'get',
            dataType: 'json',
            data: {
                keyword: $('#keyword').val()
            },
            beforeSend: () => $.blockUI({
                message: `<i class="fas fa-spinner fa-spin"></i>`
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            console.log(e)
            let htmlnya = ''

            $.each(e.data, function(i, k) {
                htmlnya += `
                <tr>
                    <th>${k.sales_invoice}</th>
                    <th>${k.created_at}</th>
                    <th>${k.estimasi_selesai}</th>
                    <th>${k.order_via}</th>
                    <th>${k.nama_customer}</th>
                    <th>${k.whatsapp}</th>
                    <th>${k.nama_produk}</th>
                    <th>${k.nama_warna}</th>
                    <th>${k.nama_ukuran}</th>
                    <th>${k.pilih_jahitan}</th>
                    <th>${k.status_order}</th>
                    <th>${k.status_pembayaran}</th>
                    <th>${k.grand_total}</th>
                </tr>
                `
            })

            $('#v_track').html(htmlnya)
        })
    }
</script>