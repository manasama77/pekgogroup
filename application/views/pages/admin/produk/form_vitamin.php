<script>
    $(document).ready(() => {

    })
</script>

<script>
    setInputFilter(document.getElementById("whatsapp"), function(value) {
        return /^\d*?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
</script>