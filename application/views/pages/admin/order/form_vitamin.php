<script>
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
    let modalCariCustomer = $('#modal_cari_customer')

    let subTotal = $('#sub_total')
    let kodeUnik = $('#kode_unik')
    let grandTotal = $('#grand_total')
    let nilaiDp = $('#nilai_dp')
    let nilaiLunas = $('#nilai_lunas')

    let dSubTotal = 0
    let dKodeUnik = 0
    let dGrandTotal = 0
    let dDp = 0
    let dLunas = 0
    let dPersenLunas = 0

    $(document).ready(() => {
        $('.select2').select2()

        durasiBatasTransfer.on('change', () => gantiBatasTransfer())
        pilihJahitan.on('change', () => gantiEstimasi())
        customerId.on('change', () => getDetailCustomer())
        productId.on('change', () => getDetailProduk())
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
            beforeSend: () => $.blockUI()
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
        })
    }

    function getDetailProduk() {
        let id_product = productId.val()

        $.ajax({
            url: `<?= base_url(); ?>produk/show/${id_product}`,
            type: 'get',
            dataType: 'json',
            beforeSend: () => $.blockUI()
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
    }
</script>