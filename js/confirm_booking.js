// let booking_form = document.getElementById('booking_form')
// let info_loader = document.getElementById('info_loader')
// let pay_info = document.getElementById('pay_info')

// function check_availability() {
//   let cheackin_val = booking_form.elements['checkin'].value
//   let cheackout_val = booking_form.elements['checkout'].value

//   booking_form.elements['pay_now'].setAttribute('disabled', true)

//   if (cheackin_val != '' && cheackout_val != '') {
//     pay_info.classList.add('d-none')
//     pay_info.classList.replace('text-dark', 'text-danger')
//     info_loader.classList.remove('d-none')

//     let data = new FormData()

//     data.append('check_availability', '')
//     data.append('check_in', cheackin_val)
//     data.append('check_out', cheackout_val)

//     let xhr = new XMLHttpRequest()
//     xhr.open('POST', 'ajax/confirm_booking.php', true)

//     xhr.onload = function () {
//       let data = JESON.parse(this.responseText)

//       if (data.status == 'check_in_out_equel') {
//         pay_info.innerText = 'Anda tidak bisa check-out di hari yang sama!'
//       } else if (data.status == 'check_out_earlier') {
//         pay_info.innerText = 'Tanggal check-out lebih awal dari check-in'
//       } else if (data.status == 'check_in_earlier') {
//         pay_info.innerText = 'Tanggal check-in lebih awal dari hari ini'
//       } else if (data.status == 'unavailable') {
//         pay_info.innerText = 'Tanggal check-in lebih awal dari hari ini'
//       } else {
//         pay_info.innerText =
//           'No. of Days: ' +
//           data.days +
//           '<br>Total Amount to Pay: RP ' +
//           data.payment
//         pay_info.classList.replace('text-danger', 'text-dark')
//         booking_form.elements['pay_now'].removeAttribute('disabled')
//       }

//       pay_info.classList.remove('d-none')
//       info_loader.classList.add('d-none')
//     }

//     xhr.send(data)
//   }
// }

let add_room_form = document.getElementById('booking_form')

add_room_form.addEventListener('submit', function (e) {
  e.preventDefault()
  buy_ship()
})

function buy_ship() {
  let data = new FormData()
  data.append('buy_ship', '')
  data.append('nama', add_room_form.elements['name'].value)
  data.append('email', add_room_form.elements['email'].value)
  data.append('no_hp', add_room_form.elements['no_hp'].value)
  data.append('alamat', add_room_form.elements['alamat'].value)
  data.append('nama_product', add_room_form.elements['nama_product'].value)
  data.append('harga_product', add_room_form.elements['harga_product'].value)
  data.append(
    'catatan_product',
    add_room_form.elements['catatan_product'].value
  )
  data.append('image', add_room_form.elements['image'].value)

  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/confirm_booking.php', true)

  xhr.send(data)
}
