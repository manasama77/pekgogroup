<script>
    $(document).ready(() => {
        $('.datatables').DataTable({
            columnDefs: [{
                orderable: false,
                targets: 5
            }],
        })

        $('#form_reset').on('submit', e => {
            e.preventDefault();
            $.ajax({
                url: `<?= base_url(); ?>admin/reset`,
                type: 'post',
                dataType: 'json',
                data: {
                    '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
                    'id': $('#id_reset').val(),
                    'password': $('#password').val(),
                },
                beforeSend: () => $.blockUI()
            }).always(() => $.unblockUI()).fail(e => Swal.fire({
                icon: 'warning',
                html: e.responseText,
            })).done(e => {
                console.log(e);
                if (e.code == 500) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Reset Password Gagal',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true
                    }).then(() => window.location.reload())
                } else if (e.code == 200) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Reset Password Success',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true
                    }).then(() => window.location.reload())
                }
            })
        })
    })
</script>

<script>
    function modalResetPassword(id, whatsapp) {
        $('#id_reset').val(id)
        $('#whatsapp').val(whatsapp)
        $('#modal_reset').modal('show')

        $('#modal_reset').on('shown.bs.modal', function() {
            $('#password').focus();
        })
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
                    url: `<?= base_url(); ?>admin/destroy/${id}`,
                    type: 'delete',
                    dataType: 'json',
                    data: {
                        '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
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
                        }).then(() => window.location.reload())
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Delete Data berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.reload())
                    }
                })
            }
        })
    }

    function nonAktifKan(id, whatsapp) {
        Swal.fire({
            icon: 'question',
            title: `Non Aktifkan ${whatsapp} ?`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?= base_url(); ?>admin/disable`,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
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
                            title: 'Non Aktifkan Admin Gagal',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.reload())
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Non Aktifkan Admin Berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.reload())
                    }
                })
            }
        })
    }

    function aktifKan(id, whatsapp) {
        Swal.fire({
            icon: 'question',
            title: `Aktifkan ${whatsapp} ?`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?= base_url(); ?>admin/active`,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
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
                            title: 'Aktifkan Admin Gagal',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.reload())
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Aktifkan Admin Berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.reload())
                    }
                })
            }
        })
    }
</script>