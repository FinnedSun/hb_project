<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Kami Hotal - Confirm Booking</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <?php require ("inc/links.php") ?>
  <link rel="stylesheet" href="css/common.css" />
</head>

<body>
  <?php require ("inc/header.php") ?>

  <?php

  if (!isset($_GET['id']) || $settings_r['shutdown'] == true) {
    redirect('ruangan.php');
  } else if (!(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
    redirect('ruangan.php');

  }

  // filter and get room and user data 
  
  $data = filteration($_GET);

  $room_res = select("SELECT * FROM `rooms`  WHERE `id`=? AND `status`=? AND `removed`=? ", [$data['id'], 1, 0], 'iii');
  $payment = select("SELECT * FROM `payment`  WHERE `id`=? AND `status`=? ", [$data['id'], 1], 'ii');

  if (mysqli_num_rows($room_res) == 0) {
    redirect('ruangan.php');
  }

  $room_data = mysqli_fetch_assoc($room_res);
  $payment_data = mysqli_fetch_assoc($payment);

  $_SESSION['room'] = [
    "id" => $room_data['id'],
    "name" => $room_data['name'],
    "price" => $room_data['price'],
    // "payment" => null,
    // "available" => false,
  ];

  $user_res = select("SELECT * FROM `registered_users` WHERE `username`=? LIMIT 1", [$_SESSION['username']], "s");
  $user_data = mysqli_fetch_assoc($user_res);

  ?>


  <div class="container">
    <div class="row">

      <div class="col-12 my-5 mb-4 px-4">
        <h2 class="fw-bold text-capitalize">
          Confirm Booking
        </h2>
        <div style="font-size: 14px;" class="text-uppercase">
          <a href="index.php" class="text-secondary text-decoration-none">Home</a>
          <span class="text-secondary"> > </span>
          <a href="ruangan.php" class="text-secondary text-decoration-none">Kamar</a>
          <span class="text-secondary"> > </span>
          <a href="ruangan.php" class="text-secondary text-decoration-none">Confirm</a>
        </div>
      </div>

      <div class="col-lg-7 col-md-12 px-4">

        <?php

        $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
        $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
                WHERE `room_id`='$room_data[id]'
                AND `thumb`='1'");

        if (mysqli_num_rows($thumb_q) > 0) {
          $thumb_res = mysqli_fetch_assoc($thumb_q);
          $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
        }

        echo <<<data
                <div class='card p-3 shadow-sm rounded'>
                  <img src="$room_thumb" class="img-fluid rounded mb-3">
                  <h5 class="text-capitalize">$room_data[name]</h5>
                  <h6>PR $room_data[price].000</h6>
                </div>
              data;

        ?>
      </div>

      <div class="col-xl-5 col-md-12 px-4">
        <div class="card mb-4 border-0 shadow rounded-3">
          <div class="card-body">
            <form id="payment">
              <h6 class="mb-3">Product Ditails</h6>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label mb-1">Nama</label>
                  <h3></h3>
                  <input type="text" name="nama" value="<?php echo $user_data['username'] ?>" class="form-control"
                    required readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label mb-1">Email</label>
                  <input type="text" name="email" value="<?php echo $user_data['email'] ?>" class="form-control"
                    required readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label mb-1">Phone Number</label>
                  <input type="number" name="no_hp" value="<?php echo $user_data['phonenum'] ?>" class="form-control"
                    required readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label mb-1">Nama Product</label>
                  <input type="text" name="nama_product" value="<?php echo $room_data['name'] ?>" class="form-control"
                    required readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label mb-1">Harga</label>
                  <input type="number" name="harga_product" value="<?php echo $room_data['price'] ?>000"
                    class="form-control" required readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label mb-1">Bukti Pembayaran</label>
                  <input type="file" accept=".png, .webp, .jpeg" name="image" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label mb-1">Jumlah Product</label>
                  <input class="form-control" type="number" name="stok" value="1"></input>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="form-label mb-1">Alamat</label>
                  <textarea class="form-control" rows="1" name="alamat"><?php echo $user_data['alamat'] ?></textarea>
                </div>



                <div class="col-md-12 mb-3">
                  <label class="form-label mb-1">Catatan Product</label>
                  <textarea class="form-control" rows="3" name="catatan_product"></textarea>
                </div>


                <div class="col-12">
                  <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>

                  <!-- <h6 class="text-danger" id="pay_info">Berikan Tanggal Chack-in dan Chack-out!</h6> -->

                  <button type="submit" class="btn w-100 text-white costom-bg mb-1" name="buy_ship"
                    onclick="payment_fuc(<?php $payment_data['id'] ?>)"> bayar sekarang
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require ("inc/footer.php") ?>

  <script>
    let add_room_form = document.getElementById('payment')

    const payment_fuc = (room_id) => {
      window.location.href = 'payment.php?id=' + 37;
    }

    add_room_form.addEventListener('submit', function (e) {
      e.preventDefault()
      buy_ship()
    })

    function buy_ship() {
      let data = new FormData()
      data.append('buy_ship', '')
      data.append('nama', add_room_form.elements['nama'].value)
      data.append('email', add_room_form.elements['email'].value)
      data.append('no_hp', add_room_form.elements['no_hp'].value)
      data.append('alamat', add_room_form.elements['alamat'].value)
      data.append('nama_product', add_room_form.elements['nama_product'].value)
      data.append('harga_product', add_room_form.elements['harga_product'].value)
      data.append('catatan_product', add_room_form.elements['catatan_product'].value)
      data.append('stok', add_room_form.elements['stok'].value)
      data.append('image', add_room_form.elements['image'].files[0])

      let xhr = new XMLHttpRequest()
      xhr.open('POST', 'ajax/confirm_booking.php', true)


      xhr.send(data)
    }
  </script>
</body>

</html>