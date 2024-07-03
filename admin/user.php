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
  <title>Admin Panel - Dashboard</title>
  <?php require ("inc/links.php"); ?>
  <style>
    html,
    body,
    * {
      padding: 0;
      margin: 0;
    }

    @media print {
      #form-input {
        display: none;
      }

      .signature {
        margin-top: 50px;
        text-align: right;
      }

      .signature p {
        margin: 0;
        padding: 0;
      }

      .signature p+p {
        margin-top: 10px;
      }

      .title-trans {
        size: 50px;
      }

    }
  </style>
  <script>
    function printReport() {
      window.print();
    }
  </script>
</head>

<body class="">

  <?php require ("inc/header.php"); ?>

  <div class="">
    <div class="row">
      <div class="col-lg-10 ms-auto overflow-hidden">

        <!-- Feature section -->
        <div class="card border-0 ">
          <h1>Laporan Transaksi Harian</h1>

          <div class="card-body">
            <form method="get" id="form-input">
              <div class="col-md-3 mb-3">
                <label class="form-label mb-1">Nama Pimpinan</label>
                <input class="form-control" type="text" id="pimpinan" name="pimpinan"
                  value="<?php echo isset($_GET['pimpinan']) ? $_GET['pimpinan'] : ''; ?>"></input>
              </div>
              <button type="submit" class="btn btn-secondary">Tampilkan</button>
              <button onclick="printReport()" class="btn">Cetak Laporan</button>
            </form>
            <div class=" d-flex align-items-center justify-content-between my-3 mx-4 text-center">
              <h4 class="card-title m-0">Product</h4>
            </div>

            <?php
            $tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
            $pimpinan = isset($_GET['pimpinan']) ? $_GET['pimpinan'] : '';

            // $res = "SELECT `tanggal` FROM `payment` WHERE `tanggal` = '$tanggal'";
            
            ?>

            <div class="table-responsive-lg rounded mb-3 p-3">
              <h4 class='title-trans'>Transaksi pada <?php echo $tanggal ?></h4>
              <table class="table align-middle table-hover text-center table-bordered">
                <thead>
                  <tr class="table-dark">
                    <th class="col">No</th>
                    <th class="col">Name</th>
                    <th class="col">Jumlah</th>
                    <th class="col">Total</th>
                    <th class="col">Tanggal</th>
                  </tr>
                </thead>
                <tbody id="room-data">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Tambah Modal -->
  <div class="modal fade" id="add-room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="add_room_form" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Tambah Kamar</h1>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nama</label>
                <input type="text" name="name" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Berat</label>
                <input type="number" min="1" name="area" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Harga</label>
                <input type="number" min="1" name="price" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Quantity</label>
                <input type="number" min="1" name="quantity" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Dewasa (Max.)</label>
                <input type="number" min="1" name="adult" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Anak-anak (Max.)</label>
                <input type="number" min="1" name="children" class="form-control" required />
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold">Fitur</label>
                <div class="row">
                  <?php
                  $res = selectAllId('features');

                  while ($opt = mysqli_fetch_assoc($res)) {
                    echo "
                          <div class='col-md-3 mb-1'>
                            <label>
                              <input type='checkbox' name='features' value='$opt[id]' class='form-check-input'>
                              $opt[name]
                            </label>
                          </div>
                        ";
                  }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold">Fasilitas</label>
                <div class="row">
                  <?php
                  $res = selectAllId('facilities');

                  while ($opt = mysqli_fetch_assoc($res)) {
                    echo "
                          <div class='col-md-3 mb-1'>
                            <label>
                              <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input'>
                              $opt[name]
                            </label>
                          </div>
                        ";
                  }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea name="desc" rows="4" class="form-control" required></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn text-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn costom-bg text-white shadow-none">Simpan</button>
          </div>
        </div>
    </div>
    </form>
  </div>


  <!-- Edit Modal -->

  <div class="modal fade" id="edit-room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="edit_room_form" autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Edit Kamar</h1>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nama</label>
                <input type="text" name="name" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Area</label>
                <input type="number" min="1" name="area" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Harga</label>
                <input type="number" min="1" name="price" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Quantity</label>
                <input type="number" min="1" name="quantity" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Dewasa (Max.)</label>
                <input type="number" min="1" name="adult" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Anak-anak (Max.)</label>
                <input type="number" min="1" name="children" class="form-control" required />
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold">Fitur</label>
                <div class="row">
                  <?php
                  $res = selectAllId('features');

                  while ($opt = mysqli_fetch_assoc($res)) {
                    echo "
                          <div class='col-md-3 mb-1'>
                            <label>
                              <input type='checkbox' name='features' value='$opt[id]' class='form-check-input'>
                              $opt[name]
                            </label>
                          </div>
                        ";
                  }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold">Fasilitas</label>
                <div class="row">
                  <?php
                  $res = selectAllId('facilities');

                  while ($opt = mysqli_fetch_assoc($res)) {
                    echo "
                          <div class='col-md-3 mb-1'>
                            <label>
                              <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input'>
                              $opt[name]
                            </label>
                          </div>
                        ";
                  }
                  ?>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea name="desc" rows="4" class="form-control" required></textarea>
              </div>
              <input type="hidden" name="room_id">
            </div>
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn text-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn costom-bg text-white shadow-none">Simpan</button>
          </div>
        </div>
    </div>
    </form>

  </div>

  <!-- Images Modal -->
  <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Room Name</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="image-alert">

          </div>
          <div class="border-bottom border-3 pb-3 mb-3">
            <form id="add_image_form">
              <label class="form-label fw-bold">Tambah Foto</label>
              <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control mb-3" required />
              <button class="btn costom-bg text-white shadow-none">Tambah</button>
              <input type="hidden" name="room_id">
            </form>
          </div>
          <div class="table-responsive-lg rounded shadow-lg mb-3" style="height: 65vh; overflow-y:scroll; ">
            <table class="table align-middle table-hover text-center table-bordered">
              <thead>
                <tr class="table-dark sticky-top">
                  <th class="col" width="60%">Image</th>
                  <th class="col">Thumb</th>
                  <th class="col">Hapus</th>
                </tr>
              </thead>
              <tbody id="room-image-data">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require ("inc/scripts.php"); ?>
  <script src="js/dashboard.js"></script>


  <?php


  if ($pimpinan) {
    echo "<div class='signature'>";
    echo "<h3>Disetujui oleh:</h3>";
    echo "<p><strong>$pimpinan</strong></p>";
    echo "<br><br>";
    echo "<p>_______________________</p>";
    echo "<p>Tanda Tangan</p>";
    echo "</div>";
  }
  ?>
</body>

</html>