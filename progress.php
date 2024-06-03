<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Kami Hotal - Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <?php require ("inc/links.php") ?>
  <link rel="stylesheet" href="css/common.css" />
</head>

<body>
  <?php require ("inc/header.php") ?>

  <?php
  if (!isset($_GET['id'])) {
    redirect('ruangan.php');
  }

  $data = filteration($_GET);

  $room_res = select("SELECT * FROM `registered_users`  WHERE `username`=? AND `status`=?", [$data['id'], 1,], 'si');

  if (mysqli_num_rows($room_res) == 1) {
    redirect('ruangan.php');
  }

  $room_data = mysqli_fetch_assoc($room_res);


  ?>



  <div class="container">

    <?php
    if ($room_data["status_p"] == 0) {
      $progress_p = 30;
      alert('success', 'Product telah di proses');
    } else {
      $progress_p = 0;
    }
    if ($room_data["status_k"] == 0) {
      $progress_k = 40;
      alert('success', 'Product telah di kirim');
    } else {
      $progress_k = 0;
    }
    if ($room_data["status_s"] == 0) {
      $progress_s = 30;
      alert('success', 'Product telah di sampai');
    } else {
      $progress_s = 0;
    }


    echo <<<progress
      <div style="width: 1300px" >
        <div style="height: 570px; display: flex" class="align-items-center justify-content-center">
            <div class="progress-stacked w-100">
              <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="30" aria-valuemin="0"
                aria-valuemax="100" style="width: $progress_p%">
                <div class="progress-bar">
                  <div>Product telah di proses</div>
                </div>
              </div>
              <div class="progress" role="progressbar" aria-label="Segment two" aria-valuenow="40" aria-valuemin="0"
                aria-valuemax="100" style="width: $progress_k%">
                <div class="progress-bar bg-success">
                  <div>Product telah di kirim</div>
                </div>
              </div>
              <div class="progress" role="progressbar" aria-label="Segment three" aria-valuenow="20" aria-valuemin="0"
                aria-valuemax="30" style="width: $progress_s%">
                <div class="progress-bar bg-info">
                  <div>Product telah di sampai</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        
      progress;
    ?>


    <?php require ("inc/footer.php") ?>

</body>

</html>