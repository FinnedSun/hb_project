<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Kami Hotal - Fasilitas</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"
    />
    <?php require("inc/links.php") ?>
    <link rel="stylesheet" href="css/common.css" />
    <style>
      .pop:hover {
        border-top-color: #2ec1ac !important;
        transform: scale(1.03);
        transition: all 0.3;
      }
    </style>
  </head>
  <body>
    <?php require("inc/header.php") ?>

    <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">Fasilitas</h2>
      <hr>
      <p class="text-center mt-3">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod quae
        reiciendis maiores officiis? Commodi magnam harum modi. <br />
        Rerum, laboriosam omnis architecto dolorem est non.
      </p>
    </div>

    <div class="container">
      <div class="row">
        <?php
          $res = selectAllId('facilities');
          $path = FACILITIES_IMG_PATH;

          while($row = mysqli_fetch_assoc($res))
          {
            echo <<<data
              <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                  <div class="d-flex align-text-center">
                    <img src="$path$row[icon]" width="40px" />
                    <h5 class="m-0 ms-3">$row[name]</h5>
                  </div>
                  <p>
                    $row[description]
                  </p>
                </div>
              </div>
            data;
          }
        ?>

      </div>
    </div>

    <?php require("inc/footer.php") ?>

  </body>
</html>
