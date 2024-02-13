<div class="container-fluid bg-white mt-5">
  <div class="row">
    <?php
      $res = selectAll('settings');

      while($row = mysqli_fetch_assoc($res))
      {
        echo <<<data
          <div class="col-lg-4 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2">$row[site_title]</h3>
            <p>
              $row[site_about]
            </p>
          </div>
        data;
      }

    ?>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Links</h5>
      <a
        href="index.php"
        class="d-inline-block mb-2 text-dark text-decoration-none"
      >
        Home </a
      ><br />
      <a
        href="ruangan.php"
        class="d-inline-block mb-2 text-dark text-decoration-none"
      >
        Ruangan </a
      ><br />
      <a
        href="fasilitas.php"
        class="d-inline-block mb-2 text-dark text-decoration-none"
      >
        Fasilitas </a
      ><br />
      <a
        href="kontak.php"
        class="d-inline-block mb-2 text-dark text-decoration-none"
      >
        Kontak kami </a
      ><br />
      <a
        href="about.php"
        class="d-inline-block mb-2 text-dark text-decoration-none"
      >
        Tentang
      </a>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Follow Us</h5>
      <?php
        if($contact_r['tw']!= ''){
          echo <<<data
            <a
              href="$contact_r[tw]"
              class="d-inline-block mb-3 text-decoration-none text-dark mb-2"
            >
              <i class="bi bi-twitter-x me-1"> Twitter</i> </a
            ><br />
          data;
        }
      ?>
      
      <a
        href="<?php echo $contact_r['fb'] ?>"
        class="d-inline-block mb-3 text-decoration-none text-dark mb-2"
      >
        <i class="bi bi-facebook me-1"> Facebook</i> </a
      ><br />
      <a
        href="<?php echo $contact_r['ig'] ?>"
        class="d-inline-block mb-3 text-decoration-none text-dark"
      >
        <i class="bi bi-instagram me-1"> instagram</i> </a
      ><br />
    </div>
  </div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0">
  Disigned and Developed by Rayhan A.M
</h6>

<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
  crossorigin="anonymous"
></script>

<script 
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
  crossorigin="anonymous">
</script>

<!-- <script >
  

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

</script> -->

<script>
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

      if (document.location.href.indexOf(file) >= 0) {
        a_tags[i].classList.add('active')
        a_tags[i].classList.add('fw-bold')
      }
    }
  }


  function checkLoginToBook(status,room_id){
    if(status){
      window.location.href='confirm_booking.php?id='+room_id;
    }
    else{
      alert('error','login sebelum memboking kamar')
    }
  }
  setActive()
</script>