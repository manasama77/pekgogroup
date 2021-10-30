<script>
    $(document).ready(() => {})
</script>

<script>
    function modalEdit(id, name, abbr) {
        $('#xid').val(id)
        $('#xname').val(name)
        $('#xabbr').val(abbr)
        $('#modal_edit').modal('show')
    }
</script>