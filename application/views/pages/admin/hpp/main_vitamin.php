<script>
    function modalEdit(id, name, cost, unit_id) {
        $('#xid').val(id)
        $('#xname').val(name)
        $('#xcost').val(cost)
        $('#xunit_id').val(unit_id)
        $('#modal_edit').modal('show')
    }

    function destroy(id, name) {
        Swal.fire({
            icon: 'question',
            title: `Delete ${name}`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?= base_url(); ?>hpp/destroy/${id}`,
                    type: 'delete',
                    dataType: 'json',
                    data: {
                        '<?= $csrf['name']; ?>': '<?= $csrf['hash']; ?>',
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
                        }).then(() => window.location.replace('<?= base_url('setup/hpp'); ?>'))
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Delete Data berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.replace('<?= base_url('setup/hpp'); ?>'))
                    }
                })
            }
        })
    }
</script>