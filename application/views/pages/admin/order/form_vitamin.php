<script>
    let idOrder = $('#id_order')
    let formOrder = $('#form_order')
    let createdAt = $('#created_at')
    let durasiBatasTransfer = $('#durasi_batas_transfer')
    let batasWaktuTransfer = $('#batas_waktu_transfer')
    let pilihJahitan = $('#pilih_jahitan')
    let estimasiSelesai = $('#estimasi_selesai')
    let customerId = $('#customer_id')
    let whatsapp = $('#whatsapp')
    let id_tokped = $('#id_tokped')
    let id_shopee = $('#id_shopee')
    let id_instagram = $('#id_instagram')
    let productId = $('#product_id')
    let colorId = $('#color_id')
    let sizeId = $('#size_id')
    let requestId = $('#request_id')
    let jenisDp = $('#jenis_dp')
    let persenDp = $('#persen_dp')
    let persenLunas = $('#persen_lunas')
    let catatan = $('#catatan')
    let catatanTambahan = $('#catatan_tambahan')
    let tambahRequest = $('#tambah_request')
    let vOrder = $('#v_order')
    let copyDetailOrder = $('#copy_detail_order')
    let modalCariCustomer = $('#modal_cari_customer')

    let subTotal = $('#sub_total')
    let kodeUnik = $('#kode_unik')
    let grandTotal = $('#grand_total')
    let nilaiDp = $('#nilai_dp')
    let nilaiLunas = $('#nilai_lunas')
    let subTotalOrder = $('#sub_total_order')
    let grandTotalOrder = $('#grand_total_order')
    let dpOrder = $('#dp_order')
    let lunasOrder = $('#lunas_order')

    let dSubTotal = 0
    let dKodeUnik = 0
    let dGrandTotal = 0
    let dDp = 0
    let dLunas = 0
    let dPersenLunas = 0

    $(document).ready(() => {
        $('.select2').select2({
            theme: 'bootstrap4'
        })

        durasiBatasTransfer.on('change', () => gantiBatasTransfer())
        pilihJahitan.on('change', () => gantiEstimasi())
        customerId.on('change', () => getDetailCustomer())
        productId.on('change', () => getDetailProduk())
        colorId.on('change', () => renderDetail())
        sizeId.on('change', () => renderDetail())
        catatan.on('keyup', e => {
            catatanTambahan.html(catatan.val().replace(/\n/g, '<br />'))
        })
        tambahRequest.on('click', () => {
            let id = requestId.val()
            storeRequest(id)
        })
        updateDP()
        dKodeUnik = parseInt(kodeUnik.text())
        generateDetailHarga()

        copyDetailOrder.on('click', () => generateCopyOrder())
    })
</script>

<script>
    function gantiBatasTransfer() {
        let x = durasiBatasTransfer.val()
        let newBatas = new moment(createdAt.val()).add(x, 'h').format('YYYY-MM-DD HH:mm:ss')
        batasWaktuTransfer.val(newBatas)
    }

    function gantiEstimasi() {
        let x = pilihJahitan.val()
        let y = 0

        if (x == "standard") {
            y = 28
        } else if (x == "express") {
            y = 14
        } else if (x == "urgent") {
            y = 7
        } else if (x == "super urgent") {
            y = 3
        }

        let newEstimasi = new moment(batasWaktuTransfer.val()).add(y, 'd').format('YYYY-MM-DD')
        console.log(newEstimasi)
        estimasiSelesai.val(newEstimasi)
        renderDetail()
    }

    function showModalCari() {
        modalCariCustomer.modal('show')
    }

    function getDetailCustomer() {
        let id_customer = customerId.val()

        $.ajax({
            url: `<?= base_url(); ?>customer/show/${id_customer}`,
            type: 'get',
            dataType: 'json',
            beforeSend: () => $.blockUI({
                message: `<i class="fas fa-spinner fa-spin"></i>`
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            console.log(e)
            if (e.code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Get detail product failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 200) {
                console.log(e)
                if (e.data[0].active_order > 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: `Customer ${$('#customer_id :selected').text()}  tidak dapat melakukan order`,
                        text: 'Dikarekan ada order yang aktif',
                        toast: false
                    }).then(() => {
                        $('#save_order').attr('disabled', true)
                    })
                } else {
                    $('#save_order').attr('disabled', false)
                    $.each(e.data, (i, k) => {
                        let xwhatsapp = k.whatsapp
                        let xid_tokped = k.id_tokped
                        let xid_shopee = k.id_shopee
                        let xid_instagram = k.id_instagram
                        whatsapp.val(xwhatsapp)
                        id_tokped.val(xid_tokped)
                        id_shopee.val(xid_shopee)
                        id_instagram.val(xid_instagram)
                    })
                }
            }
        })
    }

    function getDetailProduk() {
        let id_product = productId.val()

        $.ajax({
            url: `<?= base_url(); ?>produk/show/${id_product}`,
            type: 'get',
            dataType: 'json',
            beforeSend: () => $.blockUI({
                message: `<i class="fas fa-spinner fa-spin"></i>`
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            console.log(e)
            if (e.code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Get detail product failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 200) {
                console.log(e)
                let vColors = `<option value=""></option>`
                $.each(e.data.colors, (i, k) => {
                    vColors += `<option value="${k.id}">${k.name}</option>`
                })
                colorId.html(vColors)

                let vSizes = `<option value=""></option>`
                $.each(e.data.sizes, (i, k) => {
                    vSizes += `<option value="${k.id}">${k.name}</option>`
                })
                sizeId.html(vSizes)

                let vRequests = `<option value=""></option>`
                $.each(e.data.requests, (i, k) => {
                    vRequests += `<option value="${k.id}">${k.name}</option>`
                })
                requestId.html(vRequests)

                let listJahitan = `<option value="standard">Standard (4 Minggu Jadi) Rp.0,-</option>`;

                if (e.data.express == "1") {
                    listJahitan += `<option value="express">Express (2 Minggu Jadi) Rp.50.000,-</option>`;
                }

                if (e.data.urgent == "1") {
                    listJahitan += `<option value="urgent">Urgent (1 Minggu Jadi) Rp.100.000,-</option>`;
                }

                if (e.data.super_urgent == "1") {
                    listJahitan += `<option value="super_urgent">Super Urgent (3 Hari Jadi) Rp.150.000,-</option>`;
                }

                console.log("listJahitan", listJahitan)

                $('#pilih_jahitan').html(listJahitan)

                renderDetail()
            }
        })
    }

    function updateDP() {
        let jenis_dp = jenisDp.val()
        persenDp.html(`(${jenis_dp}%)`)

        if (jenis_dp == 30) {
            dPersenLunas = 70
            persenLunas.html(`(70%)`)
        } else if (jenis_dp == 50) {
            dPersenLunas = 50
            persenLunas.html(`(50%)`)
        } else if (jenis_dp == 100) {
            dPersenLunas = 0
            persenLunas.html(`(0%)`)
        }

        generateDetailHarga()
    }

    function storeRequest(id) {
        console.log(id)
        $.ajax({
            url: `<?= base_url(); ?>order/store_request`,
            type: 'post',
            dataType: 'json',
            data: {
                'order_id': idOrder.val(),
                'request_id': id
            },
            beforeSend: () => $.blockUI({
                message: `<i class="fas fa-spinner fa-spin"></i>`
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            console.log(e)
            if (e.code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Store request order failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Store request order success',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => renderDetail())
            }
        })
    }

    function generateDetailHarga() {
        dGrandTotal = dSubTotal + dKodeUnik
        grandTotal.text(currency(dGrandTotal))

        dDp = (dGrandTotal * jenisDp.val()) / 100

        if (jenisDp.val() == 0) {
            dLunas = 0
        } else {
            dLunas = (dGrandTotal * dPersenLunas) / 100
        }
        nilaiDp.text(currency(dDp))
        nilaiLunas.text(currency(dLunas))
        subTotalOrder.val(dSubTotal)
        grandTotalOrder.val(dGrandTotal)
        dpOrder.val(dDp)
        lunasOrder.val(dLunas)
    }

    function renderDetail() {
        $.ajax({
            url: `<?= base_url(); ?>order/render_detail`,
            type: 'get',
            dataType: 'json',
            data: {
                order_id: $('#id_order').val(),
                product_id: $('#product_id').val(),
                color_id: $("#color_id").val(),
                size_id: $("#size_id").val(),
                kode_unik: $("#kode_unik").text(),
                pilih_jahitan: $("#pilih_jahitan").val(),
            },
            beforeSend: () => $.blockUI({
                message: `<i class="fas fa-spinner fa-spin"></i>`
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            console.log(e)
            if (e.code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Render detail product failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 200) {
                console.log(e.data)
                vOrder.html(e.data.html)
                dSubTotal = e.data.sub_total
                subTotal.html(currency(e.data.sub_total))
                generateDetailHarga()
            }
        })
    }

    function removeRequest(id, cost) {
        console.log(id)
        $.ajax({
            url: `<?= base_url(); ?>order/remove_request`,
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
            },
            beforeSend: () => $.blockUI({
                message: `<i class="fas fa-spinner fa-spin"></i>`
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            console.log(e)
            if (e.code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Remove request failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Remove request success',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => renderDetail())
            }
        })
    }

    function generateCopyOrder() {
        $.ajax({
            url: `<?= base_url(); ?>order/copy_order`,
            type: 'get',
            dataType: 'json',
            data: {
                order_id: idOrder.val(),
                product_id: productId.val(),
                color_id: colorId.val(),
                size_id: sizeId.val(),
                kode_unik: kodeUnik.text(),
                jenis_dp: jenisDp.val(),
                catatan: catatan.val(),
                pilih_jahitan: pilihJahitan.val(),
            },
            beforeSend: () => $.blockUI({
                message: `<i class="fas fa-spinner fa-spin"></i>`
            })
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            console.log(e)
            if (e.code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Copy Detail Order Failed',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 200) {
                copyClipboard(e.data)
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Copy Detail Order Success',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            }
        })
    }
</script>