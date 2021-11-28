<script>
    $(document).ready(() => {
        $('.datatables').DataTable()
    })

    function detail(id) {
        $.ajax({
            url: `<?= base_url(); ?>pembelian/detail`,
            type: 'get',
            dataType: 'json',
            data: {
                'id': id,
            },
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
                    title: 'Delete Data gagal',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => window.location.replace('<?= base_url('pembelian/index'); ?>'))
            } else if (e.code == 200) {
                $('#tanggal_pembelian').text(e.data.tanggal_pembelian)
                $('#no_invoice').text(e.data.no_invoice)
                $('#nama_supplier').text(e.data.nama_supplier)
                $('#total').text("Rp." + e.data.total)

                let htmlnya = ''
                $.each(e.data.sub, (i, k) => {
                    htmlnya += `
                    <tr>
                        <td>${k.nama_barang}</td>
                        <td>${k.kode_barang}</td>
                        <td class="text-right">Rp.${k.harga}</td>
                        <td class="text-right">${k.qty}</td>
                        <td class="text-right">Rp.${k.total}</td>
                    </tr>
                    `
                })

                $('#v_barang').html(htmlnya)
            }
        })

        $('#modal_detail').modal('show')
    }

    function destroy(id, name) {
        Swal.fire({
            icon: 'question',
            title: `Delete ${urldecode(name)}`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?= base_url(); ?>pembelian/destroy/${id}`,
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
                        }).then(() => window.location.replace('<?= base_url('pembelian/index'); ?>'))
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Delete Data berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => window.location.replace('<?= base_url('pembelian/index'); ?>'))
                    }
                })
            }
        })
    }
</script>