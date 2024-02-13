function popup(popup_name) {
  get_popup = document.getElementById(popup_name)
  if (get_popup.style.display == 'flex') {
    get_popup.style.display = 'none'
  } else {
    get_popup.style.display = 'flex'
  }
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
