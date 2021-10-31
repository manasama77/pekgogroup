<script>
    $(document).ready(() => {
        $('.select2').select2()
    })
</script>

<script>
    function verifikasiDP(id) {
        $.ajax({
            url: `<?= base_url(); ?>pembayaran/verifikasi_dp`,
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
                    title: 'Check DP failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 404) {
                Swal.fire({
                    title: `Customer belum melakukan verifikasi DP`,
                    showConfirmButton: false,
                })
            } else if (e.code == 200) {
                // show modal
                let htmlnya = `<img src="<?= base_url(); ?>assets/img/pembayaran/${e.data[0].path_image}" class="img-fluid" />`
                htmlnya += `<button type="button" class="btn btn-success btn-block btn-flat" onclick="approve_dp(${e.data[0].id}, ${e.data[0].order_id});">Verifikasi Pembayaran DP</button>`
                $('#v_dp').html(htmlnya)
                $('#modal_verifikasi_dp').modal('show')
            }
        })
    }

    function approve_dp(id, order_id) {
        $.ajax({
            url: `<?= base_url(); ?>pembayaran/approve_dp`,
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                order_id: order_id
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
                    title: 'Approve DP Failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Approve DP Success',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => {
                    $('#modal_verifikasi_dp').modal('hide')
                    window.location.reload()
                })
            }
        })
    }
</script>