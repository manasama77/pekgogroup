<script>
    $(document).ready(() => {
        $('.select2').select2()

        $('#form_blokir').on('submit', e => {
            e.preventDefault();
            $.ajax({
                url: `<?= base_url(); ?>customer/blokir`,
                type: 'post',
                dataType: 'json',
                data: {
                    '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
                    'id': $('#id_blokir').val(),
                    'reason_inactive': $('#reason_inactive').val(),
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
                        title: 'Blokir Customer gagal',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true
                    }).then(() => window.location.reload())
                } else if (e.code == 200) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Blokir Customer berhasil',
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
    function modalBlokir(id, whatsapp) {
        $('#modal_blokir').modal('show')
        $('#id_blokir').val(id)
        $('#whatsapp_blokir').val(whatsapp)
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
                    url: `<?= base_url(); ?>customer/destroy/${id}`,
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
</script>