<script>
    $(document).ready(() => {
        $('.datatables').DataTable()
    })

    function destroy(id, name) {
        Swal.fire({
            icon: 'question',
            title: `Delete ${urldecode(name)}`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?= base_url(); ?>pengurangan/destroy/${id}`,
                    type: 'delete',
                    dataType: 'json',
                    data: {
                        'id': id,
                    },
                    beforeSend: () => $.blockUI()
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
                        }).then(() => window.location.replace('<?= base_url('pengurangan/index'); ?>'))
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Delete Data berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.replace('<?= base_url('pengurangan/index'); ?>'))
                    }
                })
            }
        })
    }
</script>