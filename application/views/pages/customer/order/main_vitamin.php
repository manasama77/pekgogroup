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

    function copyOrder(order_id, product_id, color_id, size_id, kode_unik, jenis_dp, catatan, pilih_jahitan) {
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
                catatan: catatan,
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
</script>