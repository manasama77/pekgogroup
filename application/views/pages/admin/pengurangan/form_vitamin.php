<script>
    let new_count = 0;
    $(document).ready(() => {
        $('.select2').select2({
            allowClear: true
        })

        $('#kategori_id').on('change', e => {
            e.preventDefault()
            if ($('#kategori_id').val() != "") {
                $.ajax({
                    url: `<?= base_url(); ?>pengurangan/get_barang_list`,
                    type: 'get',
                    dataType: 'json',
                    data: {
                        kategori_id: $('#kategori_id').val()
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
                            title: 'Render Data gagal',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.reload())
                    } else if (e.code == 200) {
                        if (e.data.length == 0) {
                            $('#barang_id').html('<option value=""></option>').attr('disabled', true)
                            $('#satuan').text('-')
                        } else {
                            let default_barang = '<option value=""></option>'

                            $.each(e.data, (i, k) => {
                                default_barang += `<option value="${k.id}" data-satuan="${k.nama_satuan}">${k.name} - ${k.nama_merk} - ${k.nama_warna}</option>`
                            })
                            $('#barang_id').html(default_barang).attr('disabled', false)
                        }
                    }
                })
            } else {
                $("#barang_id").html('<option value=""></option>').attr('disabled', true)
                $("#sub_barang_id").html('<option value=""></option>').attr('disabled', true)
                $('#satuan').text('-')
            }
        })

        $('#barang_id').on('change', e => {
            e.preventDefault()
            if ($('#barang_id').val() != "") {
                $.ajax({
                    url: `<?= base_url(); ?>pengurangan/get_kode_list`,
                    type: 'get',
                    dataType: 'json',
                    data: {
                        barang_id: $('#barang_id').val()
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
                                default_sub_barang += `<option value="${k.id}">${k.kode}</option>`
                            })
                            $('#sub_barang_id').html(default_sub_barang).attr('disabled', false)
                        }
                    }

                    $('#satuan').text($('#barang_id :selected').data('satuan'))
                })
            } else {
                $("#sub_barang_id").html('<option value=""></option>').attr('disabled', true)
                $('#satuan').text('-')
            }
        })
    })
</script>