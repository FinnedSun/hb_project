let feature_s_form = document.getElementById('feature_s_form')
let facility_s_form = document.getElementById('facility_s_form')

feature_s_form.addEventListener('submit', function (e) {
  e.preventDefault()
  add_feature()
})

function add_feature() {
  let data = new FormData()
  data.append('name', feature_s_form.elements['feature_name'].value)
  data.append('add_feature', '')

  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/fitur_fasilitas.php', true)

  xhr.onload = function () {
    var myModal = document.getElementById('feature-s')
    var modal = bootstrap.Modal.getInstance(myModal)
    modal.hide()
    if (this.responseText == 1) {
      alert('success', 'Fitur baru telah di tambahkan!')
      feature_s_form.elements['feature_name'].value = ''
      get_features()
    } else {
      alert('error', 'Server mati.')
    }
  }

  xhr.send(data)
}

function get_features() {
  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/fitur_fasilitas.php', true)
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  xhr.onload = function () {
    document.getElementById('features-data').innerHTML = this.responseText
  }

  xhr.send('get_features')
}

function rem_feature(val) {
  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/fitur_fasilitas.php', true)
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'Fitur telah dihapus!')
      get_features()
    } else if (this.responseText == 'room_added') {
      alert('error', 'fitur tambahkan di kamar!')
    } else {
      alert('success', 'Fitur telah dihapus!')
      get_features()
    }
  }

  xhr.send('rem_feature=' + val)
}

facility_s_form.addEventListener('submit', function (e) {
  e.preventDefault()
  add_facility()
})

function add_facility() {
  let data = new FormData()
  data.append('name', facility_s_form.elements['facility_name'].value)
  data.append('icon', facility_s_form.elements['facility_icon'].files[0])
  data.append('desc', facility_s_form.elements['facility_desc'].value)
  data.append('add_facility', '')

  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/fitur_fasilitas.php', true)

  xhr.onload = function () {
    var myModal = document.getElementById('facility-s')
    var modal = bootstrap.Modal.getInstance(myModal)
    modal.hide()
    if (this.responseText == 'inv_img') {
      alert('error', 'Hanya SVG yang di perbolehkan.')
    } else if (this.responseText == 'inv_size') {
      alert('error', 'Image harus kecil dari 2MB.')
    } else if (this.responseText == 'upd_failed') {
      alert('error', 'Mengupload image gagal.')
    } else {
      alert('success', 'Fasilitas baru telah di tambahkan!')
      facility_s_form.reset()
      get_facilities()
    }
  }

  xhr.send(data)
}

function get_facilities() {
  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/fitur_fasilitas.php', true)
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  xhr.onload = function () {
    document.getElementById('facilities-data').innerHTML = this.responseText
  }

  xhr.send('get_facilities')
}

function rem_facility(val) {
  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/fitur_fasilitas.php', true)
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'Fasilitas telah dihapus!')
      get_facilities()
    } else if (this.responseText == 'room_added') {
      alert('error', 'Fasilitas telah di tambahkan di Kamar!')
    } else {
      alert('success', 'Fasilitas telah dihapus!')
      get_facilities()
    }
  }

  xhr.send('rem_facility=' + val)
}

window.onload = function () {
  get_features()
  get_facilities()
}
