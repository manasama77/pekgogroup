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
</script>