let team_s_form = document.getElementById('carousel_s_form')
let carousel_picture_inp = document.getElementById('carousel_picture_inp')

carousel_s_form.addEventListener('submit', function (e) {
  e.preventDefault()
  add_image()
})

function add_image() {
  let data = new FormData()
  data.append('picture', carousel_picture_inp.files[0])
  data.append('add_image', '')

  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/carausel_crud.php', true)

  xhr.onload = function () {
    var myModal = document.getElementById('carousel-s')
    var modal = bootstrap.Modal.getInstance(myModal)
    modal.hide()
    if (this.responseText == 'inv_img') {
      alert('error', 'Hanya JPG dan PNG yang di perbolehkan.')
    } else if (this.responseText == 'inv_size') {
      alert('error', 'Image harus kecil dari 2MB.')
    } else if (this.responseText == 'upd_failed') {
      alert('error', 'Mengupload image gagal.')
    } else {
      alert('success', 'Foto baru telah di tambahkan!')
      carousel_picture_inp.value = ''
      get_carousel()
    }
  }

  xhr.send(data)
}

function get_carousel() {
  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/carausel_crud.php', true)
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  xhr.onload = function () {
    document.getElementById('carousel-data').innerHTML = this.responseText
  }

  xhr.send('get_carousel')
}

function rem_member(val) {
  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/carausel_crud.php', true)
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

  xhr.onload = function () {
    if (this.responseText == 1) {
      alert('success', 'Member telah dihapus!')
      get_carousel()
    } else {
      alert('error', 'Server mati!')
    }
  }

  xhr.send('rem_member=' + val)
}

window.onload = function () {
  get_carousel()
}

function alert(type, msg, position = 'body') {
  let bs_class = type == 'success' ? 'alert-success' : 'alert-danger'
  let element = document.createElement('div')
  element.innerHTML = `
      <div class="alert ${bs_class} alert-dismissible fade show z-3" role="alert">
        <strong class="me-3">${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `

  if (position == 'body') {
    document.body.append(element)
    element.classList.add('custom-alert')
  } else {
    document.getElementById(position).appendChild(element)
  }

  setTimeout(remAlert, 2000)
}

function remAlert() {
  document.getElementsByClassName('alert')[0].remove()
}

function setActive() {
  let navbar = document.getElementById('nav-bar')
  let a_tags = navbar.getElementsByTagName('a')

  for (let i = 0; i < a_tags.length; i++) {
    let file = a_tags[i].href.split('/').pop()
    let file_name = file.split('.')[0]

    if (document.location.href.indexOf(file_name) >= 0) {
      a_tags[i].classList.add('active')
    }
  }
}

let register_form = document.getElementById('register-form')

register_form.addEventListener('submit', (e) => {
  e.preventDefault()
  let data = new FormData()

  data.append('name', register_form.elements['name'].value)
  data.append('email', register_form.elements['email'].value)
  data.append('phonenum', register_form.elements['phonenum'].value)
  data.append('address', register_form.elements['address'].value)
  data.append('pincode', register_form.elements['pincode'].value)
  data.append('dob', register_form.elements['dob'].value)
  data.append('pass', register_form.elements['pass'].value)
  data.append('cpass', register_form.elements['cpass'].value)
  data.append('profile', register_form.elements['profile'].files[0])
  data.append('register', '')

  var myModal = document.getElementById('registerModal')
  var modal = bootstrap.Modal.getInstance(myModal)
  modal.hide()

  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/login_register.php', true)

  xhr.onload = function () {
    if (this.responseText == 'pass_mismatch') {
      alert('error', 'Password tidak sama!')
    } else if (this.responseText == 'email_already') {
      alert('error', 'Email telah di register!')
    } else if (this.responseText == 'phone_already') {
      alert('error', 'Nomor handpone telah di register!')
    } else if (this.responseText == 'inv_img') {
      alert('error', 'Image tidak falid!')
    } else if (this.responseText == 'upd_failed') {
      alert('error', 'Image gagal di upload!')
    } else if (this.responseText == 'mail_failed') {
      alert('error', 'Email tidak terkonfirmasi')
    } else if (this.responseText == 'ins_failed') {
      alert('error', 'Register gagal, Server down!')
    } else {
      alert('success', 'Register sukses! Konfirmasi link')
      register_form.reset()
    }
  }

  xhr.send(data)
})

let login_form = document.getElementById('login_form')

login_form.addEventListener('submit', (e) => {
  e.preventDefault()
  let data = new FormData()

  data.append('email_mob', login_form.elements['email_mob'].value)
  data.append('pass', login_form.elements['pass'].value)
  data.append('register', '')

  var myModal = document.getElementById('loginModal')
  var modal = bootstrap.Modal.getInstance(myModal)
  modal.hide()

  let xhr = new XMLHttpRequest()
  xhr.open('POST', 'ajax/login_register.php', true)

  xhr.onload = function () {
    if (this.responseText == 'inv_email_mob') {
      alert('error', 'Email atau No hp tidak valid!')
    } else if (this.responseText == 'not_verified') {
      alert('error', 'Email tidak terkonfirmasi')
    } else if (this.responseText == 'inactive') {
      alert('error', 'Akun tersuspen! tolong kontak admin!')
    } else if (this.responseText == 'invalid_pass') {
      alert('error', 'Password salah')
    } else {
      window.location = window.location.pathname
    }
  }

  xhr.send(data)
})

setActive()
