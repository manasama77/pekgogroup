<script>
    $(document).ready(() => {
        $('.select2').select2()

        $('#form_tambah_dp').on('submit', e => {
            e.preventDefault()
            let check = checkFormTambahDP()
            if (check == true) {
                var formData = new FormData(document.querySelector('#form_tambah_dp'));
                storeTambahDP(formData)
            }
        })

        $('#form_tambah_pelunasan').on('submit', e => {
            e.preventDefault()
            let check = checkFormTambahPelunasan()
            if (check == true) {
                var formData = new FormData(document.querySelector('#form_tambah_pelunasan'));
                storeTambahPelunasan(formData)
            }
        })
    })
</script>

<script>
    function verifikasiDP(id) {
        $.ajax({
            url: `<?= base_url(); ?>pembayaran/verifikasi_dp`,
            type: 'get',
            dataType: 'json',
            data: {
                id: id
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
                    title: 'Check DP failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 404) {
                Swal.fire({
                    title: `Customer belum melakukan verifikasi DP`,
                    showConfirmButton: false,
                })
            } else if (e.code == 200) {
                // show modal
                let htmlnya = `<img src="<?= base_url(); ?>assets/img/pembayaran/${e.data[0].path_image}" class="img-fluid" />`
                htmlnya += `<button type="button" class="btn btn-success btn-block btn-flat" onclick="approve_dp(${e.data[0].id}, ${e.data[0].order_id});">Verifikasi Pembayaran DP</button>`
                htmlnya += `<hr />`
                htmlnya += `<textarea class="form-control mt-4" id="alasan_penolakan" placeholder="Masukan Alasan Penolanak"></textarea>`
                htmlnya += `<button type="button" class="btn btn-danger btn-block btn-flat" onclick="reject_dp(${e.data[0].id}, ${e.data[0].order_id});">Tolak Pembayaran DP</button>`
                $('#v_dp').html(htmlnya)
                $('#modal_verifikasi_dp').modal('show')
            }
        })
    }

    function approve_dp(id, order_id) {
        $.ajax({
            url: `<?= base_url(); ?>pembayaran/approve_dp`,
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                order_id: order_id
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
                    title: 'Approve DP Failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Approve DP Success',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => {
                    $('#modal_verifikasi_dp').modal('hide')
                    window.location.reload()
                })
            }
        })
    }

    function reject_dp(id, order_id) {
        if ($('#alasan_penolakan').val() == null) {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Kolom Alasan Penolakan Wajib Diisi',
                showConfirmButton: false,
                timer: 1500,
                toast: true
            }).then(() => $('#alasan_penolakan').focus())
        } else {
            $.ajax({
                url: `<?= base_url(); ?>pembayaran/reject_dp`,
                type: 'post',
                dataType: 'json',
                data: {
                    id: id,
                    alasan_penolakan: $('#alasan_penolakan').val()
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
                        title: 'Tolak Pembayaran Failed',
                        showConfirmButton: false,
                        timer: 3000,
                        toast: true
                    }).then(() => window.location.reload())
                } else if (e.code == 200) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Tolak Pembayaran Success',
                        showConfirmButton: false,
                        timer: 1500,
                        toast: true
                    }).then(() => {
                        $('#modal_verifikasi_dp').modal('hide')
                        $('#modal_verifikasi_pelunasan').modal('hide')
                        window.location.reload()
                    })
                }
            })
        }
    }

    function verifikasiPelunasan(id) {
        $.ajax({
            url: `<?= base_url(); ?>pembayaran/verifikasi_pelunasan`,
            type: 'get',
            dataType: 'json',
            data: {
                id: id
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
                    title: 'Check Pelunasan failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 404) {
                Swal.fire({
                    title: `Customer belum melakukan verifikasi Pelunasan`,
                    showConfirmButton: false,
                })
            } else if (e.code == 200) {
                // show modal
                let htmlnya = `<img src="<?= base_url(); ?>assets/img/pembayaran/${e.data[0].path_image}" class="img-fluid" />`
                htmlnya += `<button type="button" class="btn btn-success btn-block btn-flat" onclick="approve_pelunasan(${e.data[0].id}, ${e.data[0].order_id});">Verifikasi Pembayaran Pelunasan</button>`
                htmlnya += `<hr />`
                htmlnya += `<textarea class="form-control mt-4" id="alasan_penolakan" placeholder="Masukan Alasan Penolanak"></textarea>`
                htmlnya += `<button type="button" class="btn btn-danger btn-block btn-flat" onclick="reject_dp(${e.data[0].id}, ${e.data[0].order_id});">Tolak Pembayaran Pelunasan</button>`
                $('#v_pelunasan').html(htmlnya)
                $('#modal_verifikasi_pelunasan').modal('show')
            }
        })
    }

    function approve_pelunasan(id, order_id) {
        $.ajax({
            url: `<?= base_url(); ?>pembayaran/approve_pelunasan`,
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                order_id: order_id
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
                    title: 'Approve Pelunasan Failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Approve Pelunasan Success',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => {
                    $('#modal_verifikasi_pelunasan').modal('hide')
                    window.location.reload()
                })
            }
        })
    }

    function checkDP(id, sales_invoice, customer_id, jenis_dp, dp_value) {
        $.ajax({
            url: `<?= base_url(); ?>pembayaran/cek_pembayaran_dp`,
            type: 'get',
            dataType: 'json',
            data: {
                id: id
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
                    title: 'Check DP failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 404) {
                Swal.fire({
                    title: `Customer sudah melakukan verifikasi Pembayaran DP`,
                    showConfirmButton: true,
                }).then(e => {
                    if (e.isConfirmed) {
                        verifikasiDP(id)
                    }
                })
            } else if (e.code == 200) {
                $('#sales_invoice_dp').val(sales_invoice)
                $('#id_dp').val(id)
                $('#id_customer_dp').val(customer_id)
                $('#jenis_dp_dp').val(jenis_dp)
                $('#dp_value_dp').val(dp_value)
                $('#modal_tambah_dp').modal('show')
            }
        })
    }

    function checkFormTambahDP() {
        if ($('#sales_invoice_dp').val() == null) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Sales Invoice tidak boleh kosong',
                showConfirmButton: false,
                timer: 1500,
                toast: true
            })
            return false;
        } else if ($('#created_at_dp').val() == null) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Tanggal & Jam Pembayaran tidak boleh kosong',
                showConfirmButton: false,
                timer: 1500,
                toast: true
            })
            return false;
        } else if ($('#path_image_dp').val() == null) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Bukti Pembayaran tidak boleh kosong',
                showConfirmButton: false,
                timer: 1500,
                toast: true
            })
            return false;
        } else {
            return true;
        }
    }

    function storeTambahDP(formData) {
        $.ajax({
            url: `<?= base_url(); ?>pembayaran/store_tambah_dp`,
            type: 'post',
            dataType: 'json',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
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
                    title: 'Tambah Pembayaran DP failed',
                    html: e.error,
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tambah Pembayaran DP success',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            }
        })
    }

    function checkPelunasan(id, sales_invoice, customer_id, jenis_dp, dp_value, pelunasan_value) {
        $.ajax({
            url: `<?= base_url(); ?>pembayaran/cek_pembayaran_pelunasan`,
            type: 'get',
            dataType: 'json',
            data: {
                id: id
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
                    title: 'Check Pelunasan failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 404) {
                Swal.fire({
                    title: `Customer sudah melakukan verifikasi Pembayaran Pelunasan`,
                    showConfirmButton: true,
                }).then(e => {
                    if (e.isConfirmed) {
                        verifikasiPelunasan(id)
                    }
                })
            } else if (e.code == 200) {
                $('#sales_invoice_pelunasan').val(sales_invoice)
                $('#id_pelunasan').val(id)
                $('#id_customer_pelunasan').val(customer_id)
                $('#jenis_dp_pelunasan').val(jenis_dp)
                $('#dp_value_pelunasan').val(dp_value)
                $('#pelunasan_value_pelunasan').val(pelunasan_value)
                $('#modal_tambah_pelunasan').modal('show')
            }
        })
    }

    function checkFormTambahPelunasan() {
        if ($('#sales_invoice_pelunasan').val() == null) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Sales Invoice tidak boleh kosong',
                showConfirmButton: false,
                timer: 1500,
                toast: true
            })
            return false;
        } else if ($('#created_at_pelunasan').val() == null) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Tanggal & Jam Pembayaran tidak boleh kosong',
                showConfirmButton: false,
                timer: 1500,
                toast: true
            })
            return false;
        } else if ($('#path_image_pelunasan').val() == null) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Bukti Pembayaran tidak boleh kosong',
                showConfirmButton: false,
                timer: 1500,
                toast: true
            })
            return false;
        } else {
            return true;
        }
    }

    function storeTambahPelunasan(formData) {
        $.ajax({
            url: `<?= base_url(); ?>pembayaran/store_tambah_pelunasan`,
            type: 'post',
            dataType: 'json',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
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
                    title: 'Tambah Pembayaran DP failed',
                    html: e.error,
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            } else if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tambah Pembayaran DP success',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.reload())
            }
        })
    }
</script>