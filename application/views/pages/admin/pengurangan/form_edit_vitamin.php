<script>
    let new_count = 0;
    $(document).ready(() => {
        $('.select2').select2({
            theme: 'bootstrap4',
            allowClear: true,
        })

        $('#supplier_id').on('change', e => {
            e.preventDefault()
            if ($('#supplier_id').val() != "") {
                $.ajax({
                    url: `<?= base_url(); ?>pembelian/get_barang_list`,
                    type: 'get',
                    dataType: 'json',
                    data: {
                        supplier_id: $('#supplier_id').val()
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
                            title: 'Render Data gagal',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.reload())
                    } else if (e.code == 200) {
                        if (e.data.length == 0) {
                            $('#barang_id').html('<option value=""></option>').attr('disabled', true)
                        } else {
                            let default_barang = '<option value=""></option>'

                            $.each(e.data, (i, k) => {
                                default_barang += `<option value="${k.id}">${k.name}</option>`
                            })
                            $('#barang_id').html(default_barang).attr('disabled', false)
                        }
                    }
                })
            } else {
                $("#barang_id").html('<option value=""></option>').attr('disabled', true)
                $("#sub_barang_id").html('<option value=""></option>').attr('disabled', true)
            }
        })

        $('#barang_id').on('change', e => {
            e.preventDefault()
            if ($('#barang_id').val() != "") {
                $.ajax({
                    url: `<?= base_url(); ?>pembelian/get_kode_list`,
                    type: 'get',
                    dataType: 'json',
                    data: {
                        barang_id: $('#barang_id').val()
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
                            title: 'Render Data gagal',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.reload())
                    } else if (e.code == 200) {
                        if (e.data.length == 0) {
                            $('#sub_barang_id').html('<option value=""></option>').attr('disabled', true)
                        } else {
                            let default_sub_barang = '<option value=""></option>'

                            $.each(e.data, (i, k) => {
                                default_sub_barang += `<option value="${k.id}" data-harga="${k.harga}">${k.kode}</option>`
                            })
                            $('#sub_barang_id').html(default_sub_barang).attr('disabled', false)
                        }
                    }
                })
            } else {
                $("#sub_barang_id").html('<option value=""></option>').attr('disabled', true)
            }
        })

        $('#sub_barang_id').on('change', e => {
            e.preventDefault()
            let harga = $("#sub_barang_id :selected").data('harga')
            $('#harga').val(harga)
        })

        $('#tambah').on('click', e => {
            e.preventDefault()
            let barang_id = $('#barang_id')
            let sub_barang_id = $('#sub_barang_id')
            let harga = $('#harga')
            let qty = $('#qty')

            if (barang_id.val().length == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Silahkan pilih Barang',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(e => {
                    if (e.isDismissed) {
                        barang_id.focus()
                    }
                })
            } else if (sub_barang_id.val().length == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Silahkan pilih Kode',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(e => {
                    if (e.isDismissed) {
                        sub_barang_id.focus()
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
            } else if (qty.val().length < 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Silahkan isi Qty',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(e => {
                    if (e.isDismissed) {
                        qty.focus()
                    }
                })
            } else {
                $.ajax({
                    url: `<?= base_url(); ?>pembelian/store_barang`,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'barang_id': barang_id.val(),
                        'sub_barang_id': sub_barang_id.val(),
                        'harga': harga.val(),
                        'qty': qty.val(),
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
                                barang_id.val('').trigger('change')
                                sub_barang_id.val('').trigger('change')
                                harga.val('')
                                qty.val('')
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
                    title: 'List Barang tidak boleh kosong',
                    showConfirmButton: true,
                }).then(() => renderSupplier())
            } else {
                $.ajax({
                    url: `<?= base_url(); ?>pembelian/store`,
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
                            title: 'List Barang tidak boleh kosong',
                            showConfirmButton: true,
                        })
                    } else if (e.code == 500) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Proses store barang gagal, silahkan coba kembali',
                            showConfirmButton: true,
                        }).then(() => window.location.reload())
                    } else if (e.code == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Proses store barang berhasil',
                            showConfirmButton: true,
                        }).then(e => {
                            if (e.isConfirmed) {
                                window.location.reload()
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
            url: `<?= base_url(); ?>pembelian/get_barang_temp`,
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
                        <td colspan="6" class="text-center">-Tidak ada data-</td>
                    </tr>
                    `;
                } else {
                    $.each(e.data, (i, k) => {
                        htmlnya += `
                    <tr>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteBarang(${k.id});" title="Delete">
                                <i class="fas fa-trash fa-fw"></i> Delete
                            </button>
                        </td>
                        <td>${k.nama_barang}</td>
                        <td>${k.kode_barang}</td>
                        <td class="text-right">${k.harga}</td>
                        <td class="text-right">${k.qty}</td>
                        <td class="text-right">${k.total}</td>
                    </tr>
                    `
                    })
                }

                new_count = e.data.length
                if (new_count < 0) {
                    new_count = 0
                }
                $('#count').val(new_count)

                $("#v_barang").html(htmlnya)
            }
        })
    }

    function deleteBarang(id) {
        $.ajax({
            url: `<?= base_url(); ?>pembelian/destroy_barang`,
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