<script>
    $(document).ready(() => {
        $('.select2').select2({
            theme: 'bootstrap4',
            allowClear: true,
        })

        $('#tanggal').on('change', () => {
            if ($('#tanggal').val() == null || $('#tanggal').val().length < 10) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Tanggal Tidak Boleh Kosong',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => $('#tanggal').focus())
            } else {
                renderData()
            }
        })

        $('#form_add').on('submit', e => {
            e.preventDefault()

            if ($('#tanggal').val() == null || $('#tanggal').val().length < 10) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Tanggal Tidak Boleh Kosong',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => $('#tanggal').focus())
            } else if ($('#account_id').val() == null) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'No Akun Boleh Kosong',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => $('#account_id').focus())
            } else if ($('#no_voucher').val() == null) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'No Voucher Boleh Kosong',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => $('#no_voucher').focus())
            } else if ($('#dari_untuk').val() == null) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Dari / Untuk Boleh Kosong',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => $('#dari_untuk').focus())
            } else if ($('#keterangan').val() == null) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Keterangan Boleh Kosong',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => $('#keterangan').focus())
            } else if ($('#debet').val() == "") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Nilai Debet Minimal 0',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => {
                    $('#debet').val(0).focus()
                    $('#form_add').trigger('submit')
                })
            } else if ($('#kredit').val() == "") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Nilai Kredit Minimal 0',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => {
                    $('#kredit').val(0).focus()
                    $('#form_add').trigger('submit')
                })
            } else if ($('#debet').val() > 0 && $('#kredit').val() > 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Nilai Debet & Kredit Tidak Dapat Terisi Keduanya',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true
                }).then(() => $('#debet').focus())
            } else {
                tambahData()
            }
        })
    })

    function tambahData() {
        $.ajax({
            url: `<?= base_url(); ?>cashflow_bca/store`,
            type: 'post',
            dataType: 'json',
            data: {
                'tanggal': $('#tanggal').val(),
                'account_id': $('#account_id').val(),
                'no_voucher': $('#no_voucher').val(),
                'dari_untuk': $('#dari_untuk').val(),
                'keterangan': $('#keterangan').val(),
                'debet': $('#debet').val(),
                'kredit': $('#kredit').val(),
            },
            beforeSend: () => $.blockUI({
                message: '<i class="fas fa-spinner fa-spin"></i>'
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            if (e.code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Tambah Data gagal',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tambah Data Berhasil',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => {
                    clearForm()
                    renderData()
                })
            }
        })
    }

    function renderData() {
        $.ajax({
            url: `<?= base_url(); ?>cashflow_bca/render`,
            type: 'get',
            dataType: 'json',
            data: {
                'tanggal': $('#tanggal').val(),
            },
            beforeSend: () => $.blockUI({
                message: '<i class="fas fa-spinner fa-spin"></i>'
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            if (e.code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Render Data gagal',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 404) {
                let htmlnya = `
                <tr>
                    <td colspan="9" class="text-center">Tidak ada data</td>
                </tr>
                `;
                $('#v_data').html(htmlnya)
            } else if (e.code == 200) {
                let htmlnya = ``;
                $.each(e.data, (i, k) => {
                    htmlnya += `
                    <tr>
                        <td class="text-center">
                            <button class="btn btn-danger btn-xs" onclick="destroy(${k.id})" title="delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                        <td>${k.tanggal}</td>
                        <td>[${k.no_akun}] ${k.nama_akun}</td>
                        <td>${k.no_voucher}</td>
                        <td>${k.dari_untuk}</td>
                        <td>${k.keterangan}</td>
                        <td class="text-right">Rp. ${k.debet}</td>
                        <td class="text-right">Rp. ${k.kredit}</td>
                        <td class="text-right ${(k.total < 0) ? "text-danger" : "text-black"} "><strong>Rp. ${k.total}</strong></td>
                    </tr>
                    `;
                })
                $('#v_data').html(htmlnya)
            }
        })
    }

    function clearForm() {
        $('#account_id').val(null).trigger('change')
        $('#no_voucher').val('')
        $('#dari_untuk').val('')
        $('#keterangan').val('')
        $('#debet').val(0)
        $('#kredit').val(0)
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
                    url: `<?= base_url(); ?>cashflow_bca/destroy/${id}`,
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
                        }).then(() => window.location.reload())
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Delete Data berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => renderData())
                    }
                })
            }
        })
    }
</script>