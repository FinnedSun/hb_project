<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Kami Hotel - Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <?php require ("inc/links.php") ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="css/common.css" />
  <style>
    .availabelity-form {
      margin-top: -50px;
      z-index: 2;
      position: relative;
    }

    @media screen and (max-width: 640px) {
      .availabelity-form {
        margin-top: 25px;
        padding: 0 35px;
      }
    }
  </style>
</head>

<body class="bg-light">
  <?php require ("inc/header.php"); ?>

  <!-- carousel -->
  <div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="images/carousel/Fth-Crousel 1.png" class="w-100 d-block" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="images/carousel/fth-Crousel 2.png" class="w-100 d-block" alt="" />
        </div>
        <div class="swiper-slide">
          <img src="images/carousel/fth-Crousel 3.png" class="w-100 d-block" alt="" />
        </div>
      </div>
    </div>
  </div>

  <!-- Check availebelity from -->
  <div class="container availabelity-form">
    <div class="row">
      <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="mb-4">Check Booking availabelity</h5>
        <form>
          <div class="row align-items-end">
            <div class="col-lg-2 mb-3">
              <label class="form-label" style="font-weight: 500">Check-in</label>
              <input type="date" class="form-control" />
            </div>
            <div class="col-lg-2 mb-3">
              <label class="form-label" style="font-weight: 500">Check-out</label>
              <input type="date" class="form-control" />
            </div>
            <div class="col-lg-3 mb-3">
              <div class="form-floating">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                  <option value="1">satu</option>
                  <option value="2">Dua</option>
                  <option value="3">Tiga</option>
                </select>
                <label for="floatingSelect">Dewasa</label>
              </div>
            </div>
            <div class="col-lg-3 mb-3">
              <div class="form-floating">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                  <option value="1">satu</option>
                  <option value="2">Dua</option>
                  <option value="3">Tiga</option>
                </select>
                <label for="floatingSelect">Anak-anak</label>
              </div>
            </div>
            <div class="col-lg-1 mb-lg-4 mt-2">
              <button type="submit" class="btn text-white shadow-none costom-bg">
                Submit
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Our Product -->

  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Product</h2>

  <div class="container">
    <div class="row">

      <?php
      $room_res = select("SELECT * FROM `rooms`  WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 6", [1, 0], 'ii');

      while ($room_data = mysqli_fetch_assoc($room_res)) {
        //get fatures of room
      
        $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                WHERE rfea.room_id = '$room_data[id]'");

        $features_data = "";
        while ($fea_row = mysqli_fetch_assoc($fea_q)) {
          $features_data .= "<span class='badge rounded-pill text-bg-light text-wrap me-1 mb-1''>
                  $fea_row[name]
                </span>";
        }

        //get facilities of room
      
        $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
                INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                WHERE rfac.room_id = '$room_data[id]'");

        $facilities_data = "";
        while ($fac_row = mysqli_fetch_assoc($fac_q)) {
          $facilities_data .= "<span class='badge rounded-pill text-bg-light text-wrap me-1 mb-1''>
                  $fac_row[name]
                </span>";
        }

        // gat thumbnail of image
      
        $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
        $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
                WHERE `room_id`='$room_data[id]'
                AND `thumb`='1'");

        if (mysqli_num_rows($thumb_q) > 0) {
          $thumb_res = mysqli_fetch_assoc($thumb_q);
          $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
        }

        $book_btn = "";

        if (!$settings_r['shutdown']) {
          $login = 0;
          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            $login = 1;
          }

          $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-sm text-white costom-bg shadow-none'>Buy Now</button>";
        }


        // room card
        echo <<<data
                <div class="col-lg-4 col-md-6 my-3">
                  <div
                    class="card border-0 shadow"
                    style="max-width: 350px; margin: auto"
                  >
                    <img src="$room_thumb" class="card-img-top" alt="Room1" />
                    <div class="card-body">
                    <h5>$room_data[name]</h5>
                      <h6 class="mt-4">Harga</h6>
                      <h6 class="mb-4">IDR : $room_data[price].000</h6>
                      <div class="facilities mb-4">
                        <h6 class="mb-1">Description</h6>
                        <h6 class="mb-4">$room_data[description]</h6>
                        
                      </div>
                      <div class="rating mb-4">
                        <h6 class="mb-1">Rating</h6>
                        <span class="badge rounded-pill bg-light">
                          <i class="bi bi-star-fill text-warning"></i>
                          <i class="bi bi-star-fill text-warning"></i>
                          <i class="bi bi-star-fill text-warning"></i>
                          <i class="bi bi-star-fill text-warning"></i>
                          <i class="bi bi-star-half text-warning"></i>
                        </span>
                      </div>
                      <div class="d-flex justify-content-evenly mb-2">
                        $book_btn
                        <a href="detail_ruangan.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none"
                          >More ditails</a
                        >
                      </div>
                    </div>
                  </div>
                </div>

              data;
      }
      ?>
      <div class="col-lg-12 text-center mt-5">
        <a href="ruangan.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Product >>></a>
      </div>
    </div>
  </div>


  <!-- Testimonials -->

  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Testimonials</h2>

  <div class="container mt-5">
    <div class="swiper swaper-test">
      <div class="swiper-wrapper rounded-md mb-5">
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/about/staff.svg" width="30px" />
            <h6 class="m-0 ms-2">Finned Sundew</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
            exercitationem deserunt provident aperiam facilis culpa quas! Nisi
            molestias modi.
          </p>
          <div class="reting">
            <span class="badge rounded-pill bg-light">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-half text-warning"></i>
            </span>
          </div>
        </div>
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/about/staff.svg" width="30px" />
            <h6 class="m-0 ms-2">Finned Sundew</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
            exercitationem deserunt provident aperiam facilis culpa quas! Nisi
            molestias modi.
          </p>
          <div class="reting">
            <span class="badge rounded-pill bg-light">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-half text-warning"></i>
            </span>
          </div>
        </div>
        <div class="swiper-slide bg-white p-4">
          <div class="profile d-flex align-items-center mb-3">
            <img src="images/about/staff.svg" width="30px" />
            <h6 class="m-0 ms-2">Finned Sundew</h6>
          </div>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
            exercitationem deserunt provident aperiam facilis culpa quas! Nisi
            molestias modi.
          </p>
          <div class="reting">
            <span class="badge rounded-pill bg-light">
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
    <div class="col-lg-12 text-center mt-5">
      <a href="kontak.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Knows >>></a>
    </div>
  </div>

  <!-- REACH US -->



  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Reach Us</h2>

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white">
        <iframe src="<?php echo $contact_r['iframe']; ?>" height="320px" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade" class="w-100 rounded"></iframe>
      </div>
      <div class="col-lg-4 col-md-4">
        <div class="bg-white p-4 rounded mb-4">
          <h5>Follow Us</h5>
          <?php
          if ($contact_r['tw'] != '') {
            echo <<<data
                  <a href="$contact_r[tw]" class="d-inline-block mb-3" target="_blank">
                    <span class="badge bg-light text-dark fs-6 p-2">
                      <i class="bi bi-twitter-x me-1"></i> Twitter
                    </span>
                  </a>
                  <br />
                data;
          }
          ?>

          <a href="<?php echo $contact_r['ig']; ?>" class="d-inline-block mb-3" target="_blank">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-instagram me-1"></i> Instagram
            </span>
          </a>
          <br />
          <a href="<?php echo $contact_r['fb']; ?>" class="d-inline-block mb-3" target="_blank">
            <span class="badge bg-light text-dark fs-6 p-2">
              <i class="bi bi-facebook me-1"></i> Facebook
            </span>
          </a>
          <br />
        </div>
        <div class="bg-white p-4 rounded mb-4">
          <h5>Call Us</h5>
          <a href="tel: +<?php echo $contact_r['pn1']; ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn1']; ?>
          </a>
          <br />
          <?php
          if ($contact_r['pn2'] != ' ') {
            echo <<<data
                  <a
                    href="tel: +$contact_r[pn2] ; ?>"
                    class="d-inline-block text-decoration-none text-dark"
                  >
                    <i class="bi bi-telephone-fill"></i>+$contact_r[pn2]
                  </a>
                data;
          }
          ?>

        </div>
      </div>
    </div>
  </div>

  <?php require ("inc/footer.php") ?>

  <!--  JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>

  <script>
    var swiper = new Swiper('.swiper-container', {
      spaceBetween: 30,
      centeredSlides: true,
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    })

    var swiper = new Swiper('.swaper-test', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      slidesPerView: '1',
      grabCursor: true,
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: '.swiper-pagination',
      },
      breakpoints: {
        320: {
          slidesPerView: '2',
        },
        640: {
          slidesPerView: '2',
        },
        768: {
          slidesPerView: '2',
        },
        1024: {
          slidesPerView: '3',
        },
      },
    })
  </script>
</body>

</html>