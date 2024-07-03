<?php
require ("inc/assentials.php");
require ("inc/db_config.php");
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel - Settings</title>
  <?php require ("inc/links.php"); ?>
  <style>
    html,
    body,
    * {
      padding: 0;
      margin: 0;
    }
  </style>
</head>

<body class="bg-light">

  <?php require ("inc/header.php"); ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <h3 class="mb-4">SETTINGS</h3>

        <!-- General Settings Section -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="card-title m-0">General Settings</h5>
              <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                <i class="bi bi-pencil-square"></i> Edit
              </button>
            </div>
            <h6 class="card-subtitle mb-q fw-bold">Site Title</h6>
            <p class="card-text" id="site_title"></p>
            <h6 class="card-subtitle mb-q fw-bold">Tentang kami</h6>
            <p class="card-text" id="site_about"></p>
          </div>
        </div>

        <!-- General Settings Modal -->
        <div class="modal fade" id="general-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="general_s_form">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5">General Settings</h1>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Site Title</label>
                    <input type="text" name="site_title" id="site_title_inp" class="form-control" required />
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Tentang Kami</label>
                    <textarea class="form-control" name="site_about" id="site_about_inp" rows="6" required></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button"
                    onclick="site_title.value = general_data.site_title, site_about.value = general_data.site_about"
                    class="btn text-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn costom-bg text-white">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Shutdown Section -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="card-title m-0">Shutdown Website</h5>
              <div class="form-check form-switch">
                <form>
                  <input onclick="upd_shutdown(this.value)" class="form-check-input" type="checkbox" role="switch"
                    id="shutdown-toggle">
                </form>
              </div>
            </div>
            <p class="card-text">Tidak ada pelanggan yang diperbolehkan memesan kamar hotel, ketika shutdown diaktifkan.
            </p>
          </div>
        </div>

        <!-- Contact Details Section -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="card-title m-0">Contact Settings</h5>
              <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#contacts-s">
                <i class="bi bi-pencil-square"></i> Edit
              </button>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-4">
                  <h6 class="card-subtitle mb-q fw-bold">Alamat</h6>
                  <p class="card-text" id="address"></p>
                </div>
                <div class="mb-4">
                  <h6 class="card-subtitle mb-q fw-bold">Google Map</h6>
                  <p class="card-text" id="gmap"></p>
                </div>
                <div class="mb-4">
                  <h6 class="card-subtitle mb-q fw-bold">Nomor handphone</h6>
                  <p class="card-text mb-1">
                    <i class="bi bi-telephone-fill"></i>
                    <span id="pn1"></span>
                  </p>
                  <p class="card-text">
                    <i class="bi bi-telephone-fill"></i>
                    <span id="pn2"></span>
                  </p>
                </div>
                <div class="mb-4">
                  <h6 class="card-subtitle mb-q fw-bold">E-mail</h6>
                  <p class="card-text" id="email"></p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-4">
                  <h6 class="card-subtitle mb-q fw-bold">Social Links</h6>
                  <p class="card-text mb-1">
                    <i class="bi bi-instagram me-1"></i>
                    <span id="ig"></span>
                  </p>
                  <p class="card-text mb-1">
                    <i class="bi bi-facebook me-1"></i>
                    <span id="fb"></span>
                  </p>
                  <p class="card-text">
                    <i class="bi bi-twitter-x me-1"></i>
                    <span id="tw"></span>
                  </p>
                </div>
                <div class="mb-4">
                  <h6 class="card-subtitle mb-q fw-bold">iFrame</h6>
                  <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Details Modal -->
        <div class="modal fade" id="contacts-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <form id="contacts_s_form">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5">Contact Settings</h1>
                </div>
                <div class="modal-body">
                  <div class="container-fluid p-0">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label fw-bold">Address</label>
                          <input type="text" name="address" id="address_inp" class="form-control" required />
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-bold">Goggle Map Link</label>
                          <input type="text" name="gmap" id="gmap_inp" class="form-control" required />
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-bold">Nomor Handpone (dengan code negara)</label>
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="bi bi-telephone-fill"></i>
                            </span>
                            <input type="number" name="pn1" id="pn1_inp" class="form-control" required>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="bi bi-telephone-fill"></i>
                            </span>
                            <input type="number" name="pn2" id="pn2_inp" class="form-control" required>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-bold">Email</label>
                          <input type="email" name="email" id="email_inp" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label fw-bold">Social Links</label>
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="bi bi-facebook"></i>
                            </span>
                            <input type="text" name="fb" id="fb_inp" class="form-control" required>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="bi bi-instagram"></i>
                            </span>
                            <input type="text" name="ig" id="ig_inp" class="form-control" required>
                          </div>
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="bi bi-twitter-x"></i>
                            </span>
                            <input type="text" name="tw" id="tw_inp" class="form-control" required>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-bold">iFrame SRC</label>
                          <input type="text" name="iframe" id="iframe_inp" class="form-control" required />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" onclick="contacts_inp(contacts_data)" class="btn text-secondary"
                    data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn costom-bg text-white">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <!-- Menagement Team section -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              <h5 class="card-title m-0">Tim Menajement</h5>
              <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#team-s">
                <i class="bi bi-plus-circle"></i> Tambah
              </button>
            </div>

            <div class="row" id="team-data">
            </div>

          </div>
        </div>

        <!-- Menagement Team Modal -->
        <div class="modal fade" id="team-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form id="team_s_form">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5">Tambahkan Member Team</h1>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" name="member_name" id="member_name_inp" class="form-control" required />
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Foto</label>
                    <input type="file" name="member_picture" id="member_picture_inp" accept=".jpg, .png, .webp, .jpeg"
                      class="form-control" required />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" onclick="member_name_inp.value = '', member_picture_inp.value = ''"
                    class="btn text-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn costom-bg text-white shadow-none">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>


      </div>
    </div>
  </div>

  <?php require ("inc/scripts.php"); ?>
  <script src="js/settings.js"></script>
</body>

</html>