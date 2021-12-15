<script>
    let new_count = 0;
    $(document).ready(() => {
        $('.select2').select2({
            theme: 'bootstrap4',
            allowClear: true,
        })

        renderSupplier()

        $('#tambah').on('click', e => {
            e.preventDefault()
            let barang_id = $('#barang_id')
            let supplier_id = $('#supplier_id')
            let kode = $('#kode')
            let harga = $('#harga')

            if (supplier_id.val().length == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Silahkan pilih Supplier',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(e => {
                    if (e.isDismissed) {
                        supplier_id.focus()
                    }
                })
            } else if (kode.val().length == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Silahkan isi Kode',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(e => {
                    if (e.isDismissed) {
                        kode.focus()
                    }
                })
            } else if (harga.val().length < 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Silahkan isi Harga',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(e => {
                    if (e.isDismissed) {
                        harga.focus()
                    }
                })
            } else {
                $.ajax({
                    url: `<?= base_url(); ?>inventory/store_supplier_fix`,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'barang_id': barang_id.val(),
                        'supplier_id': supplier_id.val(),
                        'kode': kode.val(),
                        'harga': harga.val(),
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
                            title: 'Tambah Data gagal',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.reload())
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Tambah Data berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(e => {
                            if (e.isDismissed) {
                                supplier_id.val('').trigger('change')
                                kode.val('')
                                harga.val('')
                                renderSupplier()
                            }
                        })
                    }
                })
            }
        })

        $('#form_barang').on('submit', e => {
            e.preventDefault()

            let count = $('#count')

            if (count.val() == 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'List Supplier tidak boleh kosong',
                    showConfirmButton: true,
                }).then(() => renderSupplier())
            } else {
                $.ajax({
                    url: `<?= base_url(); ?>inventory/update`,
                    type: 'post',
                    dataType: 'json',
                    data: $('#form_barang').serialize(),
                    beforeSend: () => $.blockUI()
                }).fail(e => {
                    $.unblockUI()
                    Swal.fire({
                        icon: 'warning',
                        html: e.responseText,
                    })
                }).done(e => {
                    if (e.code == 404) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'List Supplier tidak boleh kosong',
                            showConfirmButton: true,
                        })
                    } else if (e.code == 500) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Proses update barang gagal, silahkan coba kembali',
                            showConfirmButton: true,
                        }).then(() => window.location.reload())
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Proses update barang berhasil',
                            showConfirmButton: true,
                        }).then(e => {
                            if (e.isConfirmed) {
                                window.location.replace('<?= base_url('inventory/index'); ?>')
                            }
                        })
                    }
                    $.unblockUI()
                })
            }
        })
    })

    function renderSupplier() {
        $.ajax({
            url: `<?= base_url(); ?>inventory/get_supplier/<?= $barang_id; ?>`,
            type: 'get',
            dataType: 'json',
            beforeSend: () => $.blockUI()
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
                }).then(() => window.location.reload())
            } else if (e.code == 200) {
                let htmlnya = ''

                if (e.data.length == 0) {
                    htmlnya += `
                    <tr>
                        <td colspan="4" class="text-center">-Tidak ada data-</td>
                    </tr>
                    `;
                } else {
                    $.each(e.data, (i, k) => {
                        htmlnya += `
                    <tr>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteSupplier(${k.id});" title="Delete">
                                <i class="fas fa-trash fa-fw"></i> Delete
                            </button>
                        </td>
                        <td>${k.nama_supplier}</td>
                        <td>${k.kode}</td>
                        <td class="text-right">${k.harga}</td>
                    </tr>
                    `
                    })
                }

                new_count = e.data.length
                if (new_count < 0) {
                    new_count = 0
                }
                $('#count').val(new_count)

                $("#v_supplier").html(htmlnya)
            }
        })
    }

    function deleteSupplier(id) {
        $.ajax({
            url: `<?= base_url(); ?>inventory/destroy_supplier`,
            type: 'post',
            dataType: 'json',
            data: {
                id: id
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
                    title: 'Delete Data Gagal',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Delete Data Berhasil',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(e => {
                    if (e.isDismissed) {
                        renderSupplier()
                    }
                })
            }
        })
    }
</script>