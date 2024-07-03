function get_all_payment() {
  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/bulanan.php', true)
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  xhr.onload = function () {
    document.getElementById('room-data').innerHTML = this.responseText
  }

  xhr.send('get_all_payment')
}

function get_room_images() {}
window.onload = function () {
  get_all_payment()
}
