<script>
    $(document).ready(() => {
        $('.datatables').DataTable()
    })

    function pendingToOrder(id) {
        Swal.fire({
            icon: 'question',
            title: `Ubah Status dari Pending menjadi Order ?`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Ya Ubah',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?= base_url(); ?>permintaan/pending_to_order`,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'id': id,
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
                            title: 'Ubah Status Gagal',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.replace('<?= base_url('permintaan/index'); ?>'))
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Ubah Status Berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.replace('<?= base_url('permintaan/index'); ?>'))
                    }
                })
            }
        })
    }

    function orderToSelesai(id) {
        Swal.fire({
            icon: 'question',
            title: `Ubah Status dari Order menjadi Selesai ?`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Ya Ubah',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?= base_url(); ?>permintaan/order_to_selesai`,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'id': id,
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
                            title: 'Ubah Status Gagal',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.replace('<?= base_url('permintaan/index'); ?>'))
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Ubah Status Berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.replace('<?= base_url('permintaan/index'); ?>'))
                    }
                })
            }
        })
    }

    function destroy(id) {
        Swal.fire({
            icon: 'question',
            title: `Delete Data ?`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?= base_url(); ?>permintaan/destroy/${id}`,
                    type: 'delete',
                    dataType: 'json',
                    data: {
                        'id': id,
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
                            title: 'Delete Data gagal',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.replace('<?= base_url('permintaan/index'); ?>'))
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Delete Data berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.replace('<?= base_url('permintaan/index'); ?>'))
                    }
                })
            }
        })
    }
</script>