<script>
    let dSubTotal = 0
    let dKodeUnik = parseInt($('#h_kode_unik').val())
    let dGrandTotal = 0
    let dDp = 0
    let dLunas = 0
    let dPersenLunas = 0

    $(document).ready(() => {
        updateDP()
        renderOrder()

        $('#jenis_dp').on('change', () => updateDP());

        $('#btn_request').on('click', e => {
            // e.preventDefault()
            if ($('#request_id').val() == "") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Silahkan Pilih Request',
                    showConfirmButton: false,
                    timer: 20000,
                    toast: true
                })
            } else {
                addRequest()
            }
        })
    })

    function renderOrder() {
        $('#request_id').val('')

        $.ajax({
            url: `<?= base_url('shop/render_order'); ?>`,
            type: 'get',
            dataType: 'json',
            data: {
                jenis_dp: $('#jenis_dp').val(),
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
                $("#v_order").html(e.data.html)
                dSubTotal = e.data.sub_total
                generateDetailHarga()
            }
        })
    }

    function generateDetailHarga() {
        dGrandTotal = dSubTotal + dKodeUnik
        $('#grand_total').text(currency(dGrandTotal))

        dDp = (dGrandTotal * $('#jenis_dp').val()) / 100

        if ($('#jenis_dp').val() == 0) {
            dLunas = 0
        } else {
            dLunas = (dGrandTotal * dPersenLunas) / 100
        }
        $('#nilai_dp').text(currency(dDp))
        $('#nilai_pelunasan').text(currency(dLunas))
        $('#sub_total').html(currency(dSubTotal))
        $('#grand_total').val(dGrandTotal)
    }

    function updateDP() {
        let jenis_dp = $('#jenis_dp').val()

        if (jenis_dp == 30) {
            dPersenLunas = 70
            $('#persen_pelunasan').html(`70%`)
        } else if (jenis_dp == 50) {
            dPersenLunas = 50
            $('#persen_pelunasan').html(`50%`)
        } else if (jenis_dp == 100) {
            dPersenLunas = 0
            $('#persen_pelunasan').html(`0%`)
        }

        $("#persen_dp").text(jenis_dp + '%')

        generateDetailHarga()
    }

    function addRequest() {
        $.ajax({
            url: `<?= base_url(); ?>shop/store_request`,
            type: 'post',
            dataType: 'json',
            data: {
                request_id: $('#request_id').val()
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
                }).then(() => renderOrder())
            }
        })
    }

    function removeRequest(id, cost) {
        $.ajax({
            url: `<?= base_url(); ?>shop/remove_request`,
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
                }).then(() => renderOrder())
            }
        })
    }
</script>