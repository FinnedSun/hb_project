<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Kami Hotal - Ditail Ruangan</title>
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

  $room_res = select("SELECT * FROM `rooms`  WHERE `id`=? AND `status`=? AND `removed`=? ", [$data['id'], 1, 0], 'iii');

  if (mysqli_num_rows($room_res) == 0) {
    redirect('ruangan.php');
  }

  $room_data = mysqli_fetch_assoc($room_res);

  ?>


  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold text-capitalize">
          <?php
          echo $room_data['name'];
          ?>
        </h2>
        <div style="font-size: 14px;" class="text-uppercase">
          <a href="index.php" class="text-secondary text-decoration-none">Home</a>
          <span class="text-secondary"> > </span>
          <a href="ruangan.php" class="text-secondary text-decoration-none">Product</a>
        </div>
      </div>

      <div class="col-lg-7 col-md-12 px-4">
        <div id="roomCarousel" class="carousel slide">
          <div class="carousel-inner shadow">
            <?php
            $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
            $img_q = mysqli_query($con, "SELECT * FROM `room_images` 
                  WHERE `room_id`='$room_data[id]'");

            if (mysqli_num_rows($img_q) > 0) {
              $active_class = 'active';

              while ($img_res = mysqli_fetch_assoc($img_q)) {
                echo "
                      <div class='carousel-item $active_class'>
                        <img src='" . ROOMS_IMG_PATH . $img_res['image'] . "' class='d-block w-100 rounded'>
                      </div>
                    ";
                $active_class = '';
              }
            } else {
              echo "<div class='carousel-item active'>
                    <img src='$room_img' class='d-block w-100 rounded'>
                  </div>";
            }
            ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      <div class="col-xl-5 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow rounded-3">
          <div class="card-body">
            <?php
            echo <<<price
                  <h4>IDR : $room_data[price].000</h4>
                price;

            echo <<<rating
                  <div class="mb-3">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-half text-warning"></i>
                  </div>
                rating;

            $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                  INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                  WHERE rfea.room_id = '$room_data[id]'");

            $features_data = "";
            while ($fea_row = mysqli_fetch_assoc($fea_q)) {
              $features_data .= "<span class='badge rounded-pill text-bg-light text-wrap me-1 mb-1'>
                    $fea_row[name]
                  </span>";
            }

            $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
                 INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                 WHERE rfac.room_id = '$room_data[id]'");

            $facilities_data = "";
            while ($fac_row = mysqli_fetch_assoc($fac_q)) {
              $facilities_data .= "<span class='badge rounded-pill text-bg-light text-wrap me-1 mb-1'>
                  $fac_row[name]
                  </span>";
            }
            $book_btn = "";

            if (!$settings_r['shutdown']) {
              $login = 0;
              if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                $login = 1;
              }

              $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white costom-bg shadow-none w-100 '>Book Now</button>";
            }

            echo <<<feature
                  <div class="mb-3">
                    <h6 class="mb-1">Fitur</h6>
                    $features_data
                  </div>
                feature;

            echo <<<facilities
                <div class="mb-3">
                <h6 class="mb-1">Facilities</h6>
                $facilities_data
                </div>
                facilities;

            echo <<<tamu
                    <div class="tamu mb-3">
                      <h6 class="mb-1">Size</h6>
                      <span
                        class="badge rounded-pill text-bg-light text-wrap lh-base"
                      >
                        $room_data[adult] Dewasa
                      </span>
                      <span
                        class="badge rounded-pill text-bg-light text-wrap lh-base"
                      >
                        $room_data[children] Anak-anak
                      </span>
                    </div>
                  tamu;

            echo <<<area
                  <div class="mb-3">
                    <h6 class="mb-1">Luas</h6>
                    <span class='badge rounded-pill text-bg-light text-wrap me-1 mb-1'>
                     $room_data[area]0 G
                    </span>
                  </div>
                area;

            echo <<<book
                  $book_btn
                book;

            ?>
          </div>
        </div>
      </div>

      <div class="col-12 mt-4 px-4">
        <div class="mb-5">
          <h5>Description</h5>
          <p>
            <?php echo $room_data['description'] ?>
          </p>
        </div>

        <div>
          <h5 class="mb-3">Reviews & Ratings</h5>
          <div>
            <div class="d-flex align-items-center mb-2">
              <img src="images/about/staff.svg" width="30px" />
              <h6 class="m-0 ms-2">Finned Sundew</h6>
            </div>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
              exercitationem deserunt provident aperiam facilis culpa quas! Nisi
              molestias modi.
            </p>
            <div class="reting">
              <span class="badge rounded-pill bg-wite">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-half text-warning"></i>
              </span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php require ("inc/footer.php") ?>
</body>

</html>