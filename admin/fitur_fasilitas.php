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
  <title>Admin Panel - Fitur & Fasilitas</title>
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

        <!-- Feature section -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body shadow-sm">
            <div class="d-flex align-items-center justify-content-between my-3 mx-4 text-center">
              <h4 class="card-title m-0">Fitur</h4>
              <button type="button" class="btn btn-dark btn-sm shadow" data-bs-toggle="modal"
                data-bs-target="#feature-s">
                <i class="bi bi-plus-circle"></i> Tambah
              </button>
            </div>

            <div class="table-responsive-md rounded shadow-lg mb-3" style="height: 450px; overflow-y:scroll; ">
              <table class="table align-middle table-hover text-center table-bordered">
                <thead>
                  <tr class="table-dark">
                    <th class="col" width="2%">No</th>
                    <th class="col">Name</th>
                    <th class="col" width="15%">Action</th>
                  </tr>
                </thead>
                <tbody id="features-data">
                </tbody>
              </table>
            </div>

          </div>
        </div>

        <!-- Facilities section -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body shadow-sm">
            <div class="d-flex align-items-center justify-content-between my-3 mx-4 text-center">
              <h4 class="card-title m-0">Fasilitas</h4>
              <button type="button" class="btn btn-dark btn-sm shadow" data-bs-toggle="modal"
                data-bs-target="#facility-s">
                <i class="bi bi-plus-circle"></i> Tambah
              </button>
            </div>

            <div class="table-responsive-md rounded shadow-lg mb-3" style="height: 450px; overflow-y:scroll; ">
              <table class="table align-middle table-hover text-center table-bordered">
                <thead class="sticky-top">
                  <tr class="table-dark">
                    <th class="col" width="2%">No</th>
                    <th class="col" width="8%">Icon</th>
                    <th class="col">Name</th>
                    <th class="col text-start">Description</th>
                    <th class="col" width="10%">Action</th>
                  </tr>
                </thead>
                <tbody id="facilities-data">
                </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Feature Modal -->
  <div class="modal fade" id="feature-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="feature_s_form">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Tambahkan Feature</h1>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-bold">Nama</label>
              <input type="text" name="feature_name" class="form-control" required />
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn text-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn costom-bg text-white shadow-none">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>


  <!-- Facilities Modal -->
  <div class="modal fade" id="facility-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="facility_s_form">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Tambahkan Fasilitas</h1>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-bold">Nama</label>
              <input type="text" name="facility_name" class="form-control" required />
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Icon</label>
              <input type="file" name="facility_icon" accept=".svg" class="form-control" required />
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold">Description</label>
              <textarea name="facility_desc" class="form-control" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn text-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn costom-bg text-white shadow-none">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php require ("inc/scripts.php"); ?>
  <script src="js/fitur_fasilitas.js"></script>
</body>

</html>