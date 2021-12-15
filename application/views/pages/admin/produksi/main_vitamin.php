<script>
    $(document).ready(() => {
        $('.select2').select2({
            theme: 'bootstrap4'
        })
        $('#form_history').on('submit', e => {
            e.preventDefault()
            storeHistory()
        })
    })
</script>

<script>
    function printData(id) {
        window.open(`<?= base_url(); ?>produksi/print/${id}`, '_blank')
        setTimeout(() => {
            window.location.reload()
        }, 1000)
    }

    function inputHistory(id, sales_invoice, petugas_potong_kain, tanggal_potong_kain, petugas_jahit, tanggal_jahit, petugas_qc_1, tanggal_qc_1, petugas_aksesoris, tanggal_aksesoris, petugas_qc_2, tanggal_qc_2) {
        $('#order_id').val(id)
        $('#sales_invoice').val(sales_invoice)
        $('#petugas_potong_kain').val(petugas_potong_kain)
        $('#tanggal_potong_kain').val(tanggal_potong_kain)
        $('#petugas_jahit').val(petugas_jahit)
        $('#tanggal_jahit').val(tanggal_jahit)
        $('#petugas_qc_1').val(petugas_qc_1)
        $('#tanggal_qc_1').val(tanggal_qc_1)
        $('#petugas_aksesoris').val(petugas_aksesoris)
        $('#tanggal_aksesoris').val(tanggal_aksesoris)
        $('#petugas_qc_2').val(petugas_qc_2)
        $('#tanggal_qc_2').val(tanggal_qc_2)
        $('#modal_history').modal('show')
    }

    function storeHistory() {
        $.ajax({
            url: `<?= base_url(); ?>produksi/store_history`,
            type: 'post',
            dataType: 'json',
            data: $('#form_history').serialize(),
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
                    title: 'Store History Failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Store History Success',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            }
        })
    }
</script>