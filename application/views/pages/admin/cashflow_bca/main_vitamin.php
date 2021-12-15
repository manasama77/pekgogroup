<script>
    $(document).ready(() => {
        $('.select2').select2()
        $('#table1').DataTable({
            dom: 'Btrip',
            theme: 'bootstrap',
            paging: false,
            ordering: false,
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["csv", "excel"],
        })
    })
</script>