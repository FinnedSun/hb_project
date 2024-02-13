<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Kami Hotal - Confirm Booking</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"
    />
    <?php require("inc/links.php") ?>
    <link rel="stylesheet" href="css/common.css" />
  </head>
  <body>
    <?php require("inc/header.php") ?>

    <?php




      if(!isset($_GET['id']) || $settings_r['shutdown']==true){
        redirect('ruangan.php');
      }
      else if(!(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)){
        redirect('ruangan.php');

      }

      // filter and get room and user data 

      $data = filteration($_GET);

      $room_res = select("SELECT * FROM `rooms`  WHERE `id`=? AND `status`=? AND `removed`=? ", [$data['id'],1,0], 'iii');

      if(mysqli_num_rows($room_res)==0){
        redirect('ruangan.php');
      }

      $room_data = mysqli_fetch_assoc($room_res);

      $_SESSION['room'] = [
        "id" => $room_data['id'],
        "name" => $room_data['name'],
        "price" => $room_data['price'],
        "payment" => null,
        "available" => false,
      ];

      $user_res = select("SELECT * FROM `registered_users` WHERE `username`=? LIMIT 1",[$_SESSION['username']],"s");
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

            $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
              $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
                WHERE `room_id`='$room_data[id]'
                AND `thumb`='1'");

              if(mysqli_num_rows($thumb_q)>0){
                $thumb_res = mysqli_fetch_assoc($thumb_q);
                $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
              }

              echo <<<data
                <div class='card p-3 shadow-sm rounded'>
                  <img src="$room_thumb" class="img-fluid rounded mb-3">
                  <h5 class="text-capitalize">$room_data[name]</h5>
                  <h6">PR $room_data[price].000 per malam</h6>
                </div>
              data;
          
          ?>


        </div>

        <div class="col-xl-5 col-md-12 px-4">
          <div class="card mb-4 border-0 shadow rounded-3">
            <div class="card-body">
              <form id="booking_form">
                <h6 class="mb-3">Booking Ditails</h6>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label mb-1">Nama</label>
                    <input type="text" name="name" value="<?php echo $user_data['username']?>" class="form-control" required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label mb-1">Phone Number</label>
                    <input type="number" name="phonenum" value="<?php echo $user_data['phonenum']?>" class="form-control" required>
                  </div>
                  <div class="col-md-12 mb-3">
                    <label class="form-label mb-1">Alamat</label>
                    <textarea class="form-control" rows="1" name="address"><?php echo $user_data['alamat']?></textarea>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label mb-1">Chack-in</label>
                    <input type="date" onchange="check_availability()" name="checkin" class="form-control" required>
                  </div>
                  <div class="col-md-6 mb-4">
                    <label class="form-label mb-1">Chack-out</label>
                    <input type="date" onchange="check_availability()" name="checkout" class="form-control" required>
                  </div>
                  <div class="col-12">
                    <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>

                    <h6 class="text-danger" id="pay_info">Berikan Tanggal Chack-in dan Chack-out!</h6>
                    
                    <button name="pay_now" class="btn w-100 text-white costom-bg mb-1" >Bayar Sekarang</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>


      </div>
    </div>

    <?php require("inc/footer.php") ?>

    <script>
      let booking_form = document.getElementById('booking_form')
      let info_loader = document.getElementById('info_loader')
      let pay_info = document.getElementById('pay_info')

      function check_availability() {
        let cheackin_val = booking_form.elements['checkin'].value
        let cheackout_val = booking_form.elements['checkout'].value

        booking_form.elements['pay_now'].setAttribute('disabled', true)

        if (cheackin_val != '' && cheackout_val != '') {
          pay_info.classList.add('d-none')
          pay_info.classList.replace('text-dark', 'text-danger')
          info_loader.classList.remove('d-none')

          let data = new FormData()

          data.append('check_availability', '')
          data.append('check_in', cheackin_val)
          data.append('check_out', cheackout_val)

          let xhr = new XMLHttpRequest()
          // xhr.open('POST', 'ajax/confirm_booking.php', true)

          xhr.onload = function () {
            let data = JESON.parse(this.responseText)

            if (data.status == 'check_in_out_equel') {
              pay_info.innerText = 'Anda tidak bisa check-out di hari yang sama!'
            } else if (data.status == 'check_out_earlier') {
              pay_info.innerText = 'Tanggal check-out lebih awal dari check-in'
            } else if (data.status == 'check_in_earlier') {
              pay_info.innerText = 'Tanggal check-in lebih awal dari hari ini'
            } else if (data.status == 'unavailable') {
              pay_info.innerText = 'Tanggal check-in lebih awal dari hari ini'
            } else {
              pay_info.innerText =
                'No. of Days: ' +
                data.days +
                '<br>Total Amount to Pay: RP ' +
                data.payment
              pay_info.classList.replace('text-danger', 'text-dark')
              booking_form.elements['pay_now'].removeAttribute('disabled')
            }

            pay_info.classList.remove('d-none')
            info_loader.classList.add('d-none')
          }

          xhr.send(data)
        }
      }
      

    </script>
  </body>
</html>
