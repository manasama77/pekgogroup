<script>
    function modalEdit(id, name, role) {
        $('#xid').val(id)
        $('#xname').val(name)
        if (role == "potong kain") {
            $('#xrole_potong_kain').prop('checked', true)
        } else if (role == "penjahit") {
            $('#xrole_penjahit').prop('checked', true)
        } else if (role == "qc") {
            $('#xrole_qc').prop('checked', true)
        } else if (role == "aksesoris") {
            $('#xrole_aksesoris').prop('checked', true)
        }
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
                    url: `<?= base_url(); ?>karyawan/destroy/${id}`,
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
                        }).then(() => window.location.replace('<?= base_url('setup/karyawan'); ?>'))
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Delete Data berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.replace('<?= base_url('setup/karyawan'); ?>'))
                    }
                })
            }
        })
    }
</script>