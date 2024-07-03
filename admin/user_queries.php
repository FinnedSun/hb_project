<?php
require ("inc/assentials.php");
require ("inc/db_config.php");
adminLogin();

if (isset($_GET['seen'])) {
  $frm_data = filteration($_GET);

  if ($frm_data['seen'] == 'all') {
    $q = "UPDATE `user_queries` SET `seen`=?";
    $values = [1];
    if (update($q, $values, 'i')) {
      alert("success", "Semua pertanyaan sudah dibaca!");
    } else {
      alert("error", "Operasi gagal.");
    }
  } else {
    $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
    $values = [1, $frm_data['seen']];
    if (update($q, $values, 'ii')) {
      alert("success", "Pertanyaan sudah dibaca!");
    } else {
      alert("error", "Operasi gagal.");
    }
  }
}
if (isset($_GET['del'])) {
  $frm_data = filteration($_GET);

  if ($frm_data['del'] == 'all') {
    $q = "DELETE FROM `user_queries`";
    if (mysqli_query($con, $q)) {
      alert("success", "Semua pertanyaan sudah dihapus!");
    } else {
      alert("error", "Operasi gagal.");
    }
  } else {
    $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
    $values = [$frm_data['del']];
    if (update($q, $values, 'i')) {
      alert("success", "Pertanyaan ini sudah dihapus!");
    } else {
      alert("error", "Operasi gagal.");
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Panel - User Queries</title>
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

        <!-- Carausel section -->
        <div class="card border-0 shadow-sm mb-4" style="margin-top: 100px;">
          <div class="card-body shadow-sm">
            <div class="d-flex align-items-center justify-content-between mb-3 text-center">
              <h4 class="card-title m-0">Pertanyaan</h4>
            </div>

            <div class="table-responsive-md rounded shadow-lg mb-3" style="height: 450px; overflow-y:scroll; ">
              <table class="table align-middle table-hover table-bordered">
                <thead class="sticky-top">
                  <tr class="table-dark text-center">
                    <th class="col">No</th>
                    <th class="col">Name</th>
                    <th class="col">Email</th>
                    <th class="col" width="15%">Subject</th>
                    <th class="col" width="30%">Pertanyaan</th>
                    <th class="col">Tanggal</th>
                    <th class="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
                  $data = mysqli_query($con, $q);

                  $i = 1;
                  while ($row = mysqli_fetch_assoc($data)) {
                    $seen = '';
                    if ($row['seen'] != 1) {
                      $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-primary mb-1'>Dibaca</a> </br>";
                    }
                    $seen .= "<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger'>Hapus</a>";
                    echo <<<query
                                  <tr>
                                      <th class='text-center'>$i</th>
                                      <td class='text-center'>$row[nama]</td>
                                      <td class='text-center'>$row[email]</td>
                                      <td class='text-center'>$row[subject]</td>
                                      <td class='text-center'>$row[message]</td>
                                      <td class='text-center'>$row[date]</td>
                                      <td>$seen</td>
                                  </tr>
                              query;
                    $i++;
                  }
                  ?>
                </tbody>
              </table>
            </div>

            <div class="d-flex mb-3 justify-content-between">
              <a href="?seen=all" class="btn btn-dark rounded-pill shadow btn-sm"><i class="bi bi-bookmarks-fill"></i>
                Baca semua</a>
              <a href="?del=all" class="btn btn-danger rounded-pill shadow btn-sm"><i class="bi bi-trash3-fill"></i>
                Hapus semua</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require ("inc/scripts.php"); ?>
  <script src="js/carousel.js"></script>
</body>

</html>