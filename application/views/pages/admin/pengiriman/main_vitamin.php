<script>
    $(document).ready(() => {
        $('.select2').select2()

        $('#form_pengiriman').on('submit', e => {
            e.preventDefault()
            storeTambahPengiriman()
        })
    })
</script>

<script>
    function inputDataPengiriman(id, sales_invoice, alamat_pengiriman) {
        $.ajax({
            url: `<?= base_url(); ?>pengiriman/cek_data_pengiriman`,
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
            if (e.code == 404) {
                Swal.fire({
                    title: `Data pengiriman telah diisi`,
                    showConfirmButton: false,
                })
            } else if (e.code == 200) {
                $('#id_order').val(id)
                $('#sales_invoice').val(sales_invoice)
                $('#alamat_pengiriman').val(alamat_pengiriman)
                $('#modal_pengiriman').modal('show')
            }
        })
    }

    function selesaikanOrder(id, sales_invoice) {
        Swal.fire({
            icon: 'question',
            title: `Selesaikan Order ${sales_invoice} ?`,
            showConfirmButton: true,
            showCancelButton: true,
        }).then((e) => {
            if (e.isConfirmed) {
                $.ajax({
                    url: `<?= base_url(); ?>pengiriman/selesai`,
                    type: 'post',
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
                            title: 'Selesaikan Order Failed',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.reload())
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Selesaikan Order Success',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => {
                            window.location.reload()
                        })
                    }
                })
            }
        })
    }

    function historyPengiriman(no_resi, ekspedisi) {
        if (no_resi != null) {
            $.ajax({
                url: `<?= base_url(); ?>pengiriman/track`,
                type: 'get',
                dataType: 'json',
                data: {
                    no_resi: no_resi,
                    ekspedisi: ekspedisi,
                },
                beforeSend: () => $.blockUI({
                    message: `<i class="fas fa-spinner fa-spin"></i>`
                })
            }).always(() => $.unblockUI()).fail(e => Swal.fire({
                icon: 'warning',
                html: e.responseText,
            })).done(e => {
                console.log(e)
                if (e.rajaongkir.status.code == 200) {
                    let html = ``;
                    html += `<p>No Resi: ${e.rajaongkir.query.waybill}</p>`;
                    html += `<p>Ekspedisi: ${e.rajaongkir.query.courier}</p>`;
                    html += `<p>Status Pengiriman: ${(e.rajaongkir.result.delivered == true) ? "Terkirim" : "Proses Pengiriman"}</p>`;

                    $.each(e.rajaongkir.result.manifest, (i, k) => {
                        html += `
                        <div class="callout callout-info">
                            <p>
                                Tanggal Jam: ${k.manifest_date} ${k.manifest_time}<br/>
                                Kota: ${k.city_name}<br/>
                                ${k.manifest_description}
                            </p>
                        </div>
                        `;
                    })

                    $('#v_history').html(html)
                    $('#modal_history_pengiriman').modal('show')
                }
            })
        } else {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'No Resi Belum terisi',
                showConfirmButton: false,
            })
        }
    }
</script>