<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Kami Hotal - Kontak</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"
    />
    <?php require("inc/links.php") ?>
    <link rel="stylesheet" href="css/common.css" />
  </head>
  <body>
    <?php require("inc/header.php") ?>

    <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">Kontak Kami</h2>
      <hr>
      <p class="text-center mt-3">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod quae
        reiciendis maiores officiis? Commodi magnam harum modi. <br />
        Rerum, laboriosam omnis architecto dolorem est non.
      </p>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 mb-5 px-4">
          <div
            class="bg-white rounded shadow p-4 "
          >
            <iframe
              src="<?php echo $contact_r['iframe'] ?>"
              height="320px"
              loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"
              class="w-100 rounded shadow mb-4"
            ></iframe>
            <h5>Alamat</h5>
            <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
              <i class="bi bi-geo-alt-fill"></i> <?php echo $contact_r['address'] ?>
            </a>
            <h5 class="mt-4">Call Us</h5>
            <a
              href="tel: +<?php echo $contact_r['pn1'] ?>"
              class="d-inline-block mb-2 text-decoration-none text-dark"
            >
              <i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn1'] ?>
            </a>
            <br />
            <?php
              if($contact_r['pn2']!= ''){
                echo <<<data
                  <a
                    href="tel: $contact_r[pn2]"
                    class="d-inline-block text-decoration-none text-dark"
                  >
                    <i class="bi bi-telephone-fill"></i>+$contact_r[pn2]
                  </a>
                data;
              }
            ?>
            
            <h5 class="mt-4">
              Email
            </h5>
            <a href="mailto: <?php echo $contact_r['emai'] ?>"
              class="d-inline-block text-decoration-none text-dark">
              <i class="bi bi-envelope-fill"></i> <?php echo $contact_r['email'] ?>
            </a>
            <h5 class="mt-4">Follow Us</h5>
            <?php
              if($contact_r['tw']!= ''){
                echo <<<data
                  <a href="<?php echo $contact_r[tw] ?>" target="_blank" class="d-inline-block text-dark fs-5 me-2">
                    <i class="bi bi-twitter-x me-1"></i>
                  </a>
                data;
              }
            ?>
            <a href="<?php echo $contact_r['ig'] ?>" target="_blank" class="d-inline-block text-dark fs-5 me-2">
              <i class="bi bi-instagram me-1"></i>
            </a>
            <a href="<?php echo $contact_r['fb'] ?>" target="_blank" class="d-inline-block text-dark fs-5">
              <i class="bi bi-facebook me-1"></i>
            </a>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 px-4">
          <div
            class="bg-white rounded shadow p-4"
          >
            <form method="POST">
              <h5>Mengirim Pesanan</h5>
                <div class="mt-3">
                  <label class="form-label" style="font-weight: 500:">Name</label>
                  <input name="name" require type="text" class="form-control shadow-none" />
                </div>
                <div class="mt-3">
                  <label class="form-label" style="font-weight: 500:">Email</label>
                  <input name="email" require type="email" class="form-control shadow-none" />
                </div>
                <div class="mt-3">
                  <label class="form-label" style="font-weight: 500:">Subject</label>
                  <input name="subject" require type="text" class="form-control shadow-none" />
                </div>
                <div class="mt-3">
                  <label class="form-label" style="font-weight: 500:">Pesanan</label>
                  <textarea name="message" require class="form-control shadow-none" rows="4"></textarea>
                </div>
                <button type="submit" name="send" class="btn text-white costom-bg mt-3">Kirim</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php
      if(isset($_POST['send'])){
        $frm_data = filteration($_POST);

        $q = "INSERT INTO `user_queries`(`nama`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message'],];

        $res = insert($q,$values,'ssss');
        if($res == 1){
          alert("success","Pesan telah terkirim!");
        }
        else{
          alert("error","Server mati! Coba lagi nanti.");
        }
      }
    ?>

    <?php require("inc/footer.php") ?>
  </body>
</html>
