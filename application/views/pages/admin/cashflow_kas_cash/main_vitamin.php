<script>
    $(document).ready(() => {
        $('.select2').select2()
    })

    function modalEdit(id, no_akun, nama_akun, account_group_id) {
        $('#xid').val(id)
        $('#xno_akun').val(urldecode(no_akun))
        $('#xnama_akun').val(urldecode(nama_akun))
        $('#xaccount_group_id').val(urldecode(account_group_id))
        $('#modal_edit').modal('show')
    }

    function destroy(id, nama_akun) {
        Swal.fire({
            icon: 'question',
            title: `Delete ${urldecode(nama_akun)}`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?= base_url(); ?>account/destroy/${id}`,
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
                        }).then(() => window.location.replace('<?= base_url('account/index'); ?>'))
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Delete Data berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.replace('<?= base_url('account/index'); ?>'))
                    }
                })
            }
        })
    }
</script>