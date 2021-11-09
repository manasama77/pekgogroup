<script src="<?= base_url(); ?>assets/plugins/flexbox2/js/lightbox.min.js"></script>
<script>
    $('form').on('submit', e => {
        e.preventDefault()
        if ($('input[name="size_id"]:checked').val() == undefined) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Silahkan Pilih Size',
                showConfirmButton: false,
                timer: 2000,
                toast: true
            })
        } else {
            e.currentTarget.submit();
        }
    })
</script>