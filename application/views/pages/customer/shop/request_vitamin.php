<script>
    $(document).ready(() => {
        $('#btn_request').on('click', e => {
            e.preventDefault()
            if ($('#request_id').val() == "") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Silahkan Pilih Request',
                    showConfirmButton: false,
                    timer: 2000,
                    toast: true
                })
            } else {
                addRequest()
            }
        })
    })

    function addRequest() {
        let request_id = $('#request_id').val()
        console.log(request_id);
    }
</script>