function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
    textbox.addEventListener(event, function () {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}

function currency(cur) {
  let vTotalPrice = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR'
  }).format(cur)
  return vTotalPrice
}

function copyClipboard(text) {
  /* Copy the text inside the text field */
  navigator.clipboard.writeText(text);
}

function comingSoon() {
  Swal.fire({
    position: 'top-end',
    icon: 'info',
    title: 'Coming Soon',
    showConfirmButton: false,
    timer: 1500,
    toast: true
  })
}

function urldecode(url) {
  return decodeURIComponent(url.replace(/\+/g, ' '));

}