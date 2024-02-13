<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Kami Hotal - Tentang kami</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"
    />
    <?php require("inc/links.php") ?>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="css/common.css" />
    <style>
      .box {
        border-top-color: #2ec1ac !important;
      }
    </style>
  </head>
  <body>
    <?php require("inc/header.php") ?>

    <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">About</h2>
      <hr />
      <p class="text-center mt-3">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod quae
        reiciendis maiores officiis? Commodi magnam harum modi. <br />
        Rerum, laboriosam omnis architecto dolorem est non.
      </p>
    </div>

    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-2">
          <h3 class="mb-3">Lorem ipsum dolor sit.</h3>
          <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi
            illo tenetur voluptates velit quibusdam amet quis? Alias debitis,
            cupiditate dolores explicabo voluptates itaque autem consequuntur
            illum impedit nemo quod laudantium? Maxime, soluta?
          </p>
        </div>
        <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-1">
          <img src="images/about/about.jpg" class="w-100 rounded" />
        </div>
      </div>
    </div>

    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div
            class="bg-white shadow rounded p-4 border-top border-4 text-center box"
          >
            <img src="images/about/hotel.svg" width="70px" />
            <h4 class="mt-3">100+ Ruangan</h4>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div
            class="bg-white shadow rounded p-4 border-top border-4 text-center box"
          >
            <img src="images/about/customers.svg" width="70px" />
            <h4 class="mt-3">200+ Costomer</h4>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div
            class="bg-white shadow rounded p-4 border-top border-4 text-center box"
          >
            <img src="images/about/rating.svg" width="70px" />
            <h4 class="mt-3">1000+ Review</h4>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div
            class="bg-white shadow rounded p-4 border-top border-4 text-center box"
          >
            <img src="images/about/staff.svg" width="70px" />
            <h4 class="mt-3">50+ Staff</h4>
          </div>
        </div>
      </div>
    </div>

    <h3 class="my-5 fw-bold text-center">Tim Menagement</h3>
    <hr />

    <div class="container px-4">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper mb-5">

          <?php

            $about_r = selectAll('team_details');
            $path = ABOUT_IMG_PATH;

            while($row = mysqli_fetch_assoc($about_r)){
              echo <<<data
                <div
                  class="swiper-slide bg-white text-center overflow-hidden img-thumbnail"
                >
                  <img src="$path$row[picture]" class="w-100 rounded p-2" />
                  <h5 class="mt-2">$row[name]</h5>
                </div>
              data;
            }


          ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <?php require("inc/footer.php") ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
      var swiper = new Swiper('.mySwiper', {
        slidesPerView: 4,
        spaceBetween: 40,
        pagination: {
          el: '.swiper-pagination',
        },
        breakPoints: {
          320: {
            slidesPerView: 1,
          },
          640: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 3,
          },
          1024: {
            slidesPerView: 3,
          },
        },
      })
    </script>
  </body>
</html>
