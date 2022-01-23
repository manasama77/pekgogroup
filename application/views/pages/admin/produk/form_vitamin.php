<script>
    let formProduk = $('#form_produk')
    let id_product = $('#id_product')
    let id_hpp = $('#id_hpp')
    let qty_hpp = $('#qty_hpp')
    let btn_tambah_hpp = $('#tambah_hpp')
    let vHPP = $('#v_hpp')
    let grandTotal = $('#grand_total')
    let count_hpp = $('#count_hpp')
    let counter = 0
    let path_image = document.getElementById('path_image')
    let preview1 = document.getElementById('preview1')
    let path_image_2 = document.getElementById('path_image_2')
    let preview2 = document.getElementById('preview2')
    let path_image_3 = document.getElementById('path_image_3')
    let preview3 = document.getElementById('preview3')

    $(document).ready(() => {
        $('.select2').select2({
            theme: 'bootstrap4',
            allowClear: true,
        })

        renderHppTable()

        btn_tambah_hpp.on('click', e => {
            console.log(e)
            e.preventDefault()
            storeHpp()
        })

        formProduk.on('submit', e => {
            e.preventDefault()
            if (count_hpp.val() == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'HPP Produk tidak boleh kosong',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true
                })
            } else if ($('input[name="color_id[]"]:checked').length == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Warna Produk minimal terpilih satu',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true
                })
            } else if ($('input[name="size_id[]"]:checked').length == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Ukuran Produk minimal terpilih satu',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true
                })
            } else if ($('input[name="request_id[]"]:checked').length == 0) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Request Produk minimal terpilih satu',
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true
                })
            } else {
                e.currentTarget.submit();
            }
        })

        path_image.onchange = evn => {
            const [file] = path_image.files

            if (file) {
                preview1.src = URL.createObjectURL(file)
            }
        }

        path_image_2.onchange = evn => {
            const [file] = path_image_2.files

            if (file) {
                preview2.src = URL.createObjectURL(file)
            }
        }

        path_image_3.onchange = evn => {
            const [file] = path_image_3.files

            if (file) {
                preview3.src = URL.createObjectURL(file)
            }
        }

        $('#remove1').on('click', e => {
            $("#path_image").val("")
            $('#preview1').attr('src', '<?= base_url('assets/img/products/default.jpg'); ?>')
        })

        $('#remove2').on('click', e => {
            $("#path_image_2").val("")
            $('#preview2').attr('src', '<?= base_url('assets/img/products/default.jpg'); ?>')
        })

        $('#remove3').on('click', e => {
            $("#path_image_3").val("")
            $('#preview3').attr('src', '<?= base_url('assets/img/products/default.jpg'); ?>')
        })
    })
</script>

<script>
    function storeHpp() {
        $.ajax({
            url: `<?= base_url(); ?>produk/hpp/store`,
            type: 'post',
            dataType: 'json',
            data: {
                'product_id': id_product.val(),
                'hpp_id': id_hpp.val(),
                'qty_hpp': qty_hpp.val(),
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
                    title: 'Tambah HPP gagal',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 200) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tambah HPP Berhasil',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                }).then(() => {
                    resetFormHPP()
                    renderHppTable()
                    counter += 1
                    count_hpp.val(counter)
                })
            }
        })
    }

    function resetFormHPP() {
        qty_hpp.val('')
    }

    function renderHppTable() {
        $.ajax({
            url: `<?= base_url(); ?>produk/hpp/render`,
            type: 'get',
            dataType: 'json',
            data: {
                'product_id': id_product.val()
            },
            beforeSend: () => $.blockUI()
        }).always(() => $.unblockUI()).fail(e => Swal.fire({
            icon: 'warning',
            html: e.responseText,
        })).done(e => {
            console.log(e)
            let vTotal = 0;
            if (e.code == 500) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Render HPP gagal',
                    showConfirmButton: false,
                    timer: 1500,
                    toast: true
                })
            } else if (e.code == 200) {
                let renderHTML = ``

                if (e.count == 0) {
                    renderHTML = `
                    <tr class="bg-warning">
                        <td class="text-center" colspan="4">Data HPP Kosong</td>
                    </tr>
                    `
                } else {
                    $.each(e.data, (i, k) => {
                        console.log(k.total_price)
                        let totalPrice = parseFloat(k.total_price)
                        let vTotalPrice = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(totalPrice)
                        renderHTML += `
                        <tr>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="destroyHPP(${k.id});"><i class="fas fa-trash"></i></button>
                            </td>
                            <td>${k.name}</td>
                            <td class="text-right">${parseFloat(k.qty)} ${k.unit_name}</td>
                            <td class="text-right">${vTotalPrice}</td>
                        </tr>
                        `
                        vTotal += totalPrice
                    })
                }
                vHPP.html(renderHTML)
                grandTotal.html(currency(vTotal))
            }
        })
    }

    function destroyHPP(id) {
        Swal.fire({
            icon: 'question',
            title: `Delete HPP ?`,
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `<?= base_url(); ?>produk/destroy_hpp/${id}`,
                    type: 'delete',
                    dataType: 'json',
                    data: {
                        '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>',
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
                        })
                    } else if (e.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Delete Data berhasil',
                            showConfirmButton: false,
                            timer: 1500,
                            toast: true
                        }).then(() => {
                            renderHppTable()
                            counter -= 1
                            count_hpp.val(counter)
                        })
                    }
                })
            }
        })
    }
</script>