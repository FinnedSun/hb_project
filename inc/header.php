<?php 
  require('admin/inc/db_config.php');
  require('admin/inc/assentials.php');
  session_start();
  date_default_timezone_set("Asia/Jakarta");

  $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
  $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";

  $values = [1];

  $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
  $settings_r = mysqli_fetch_assoc(select($settings_q,$values,'i'));

  if($settings_r['shutdown'])
  {
    echo <<<alertbar
        <div class='bg-danger text-center p-2 fw-bold'>
          <i class="bi bi-exclamation-triangle-fill"></i>
          Booking are temporarily closed!
        </div>
    alertbar;
  }
?>

<nav
    id="nav-bar"
    class="navbar navbar-expand-lg bg-body-tertiary px-lg-3 py-lg-3 shadow-sm sticky-top">
    <div class="container-fluid">
      <?php
        $res = selectAll('settings');

        while($row = mysqli_fetch_assoc($res))
        {
          echo <<<data
            <a class="navbar-brand me-2 fw-bold fs-3 h-font" href="index.php">
              $row[site_title]
            </a>
          data;
        }
      ?>
    <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link me-2" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="ruangan.php">Kamar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="fasilitas.php">Fasilitas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="kontak.php">Kontak kami</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="about.php">Tentang</a>
        </li>
        </ul>
        <div class="d-flex" role="search">
          <?php
            if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
            {
              echo<<<data
                <div class="dropdown">
                  <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                      Hello $_SESSION[username]
                  </button>
                  <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="bookings">Bookings</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                  </ul>
                </div>
              data;
            }
            else
            {
              echo"
                <button
                    type='button'
                    class='btn btn-outline-dark shadow-none me-lg-3 me-2'
                    data-bs-toggle='modal'
                    data-bs-target='#LoginModal'
                >
                    Login
                </button>
                <button
                    type='button'
                    class='btn btn-outline-dark shadow-none'
                    data-bs-toggle='modal'
                    data-bs-target='#RegisterModal'
                >
                    Register
                </button>

              ";
            }
          ?>
        </div>
    </div>
    </div>
</nav>

<div
      class="modal fade"
      id="LoginModal"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <form method="POST" action="ajax/login_register.php">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 d-flex align-items-center">
                <i class="bi bi-person-circle fs-3 me-2"></i> User Log in
              </h1>
              <button
                type="reset"
                class="btn-close shadow-none"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Email or Nama User</label>
                <input type="text" class="form-control" placeholder="Email or Username" name="email_username"/>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Password" name="password"/>
              </div>
              <div
                class="d-flex align-items-center justify-content-between mb-2"
              >
                <button type="submit" class="btn btn-dark" name="login">Login</button>
                <a
                  href="javascript: void(0)"
                  class="text-secondary text-decoration-none"
                  >Lupa Password?</a
                >
              </div>
            </div>
            <div class="modal-footer"></div>
          </div>
        </form>
      </div>
</div>

<div
      class="modal fade"
      id="RegisterModal"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <form method="POST" action="ajax/login_register.php">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 d-flex align-items-center">
                <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                User Registeration
              </h1>
              <button
                type="reset"
                class="btn-close shadow-none"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <span
                class="badge rounded-pill text-bg-light mb-3 text-wrap lh-base"
              >
                Catatan: Data kamu harus sama dengan ID kamu (KTP, Passport,
                SIM, dsb.) akan diperlukan saat check-in.
              </span>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" placeholder="Name" name="username">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Email" name="email">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">No Hp</label>
                    <input type="text" class="form-control" placeholder="No handpone" name="phonenum">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Profile</label>
                    <input type="file" class="form-control" accept=".jpg, .jpeg, .png, .webp" placeholder="Profile" name="profile">
                  </div>
                  <div class="col-md-12 ps-0 mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" rows="1" name="address"></textarea>
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Pincode</label>
                    <input type="text" class="form-control"  placeholder="Pincode" name="pincode">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                  </div>
                </div>
              </div>
              <div class="text-center my-1">
                <button type="submit" class="btn btn-dark" name="register">Register</button>
              </div>
            </div>
            <div class="modal-footer"></div>
          </div>
        </form>
      </div>
</div>


<script src="js/main.js"></script>
