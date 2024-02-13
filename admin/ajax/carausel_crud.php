<?php
    require("../inc/assentials.php");
    require("../inc/db_config.php");
    adminLogin();

    if(isset($_POST["add_image"])){

        $img_r = uploadImage($_FILES['picture'],CAROUSEL_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
        }
        else if($img_r == 'upd_failed'){
            echo $img_r;
        }
        else{
            $q = "INSERT INTO `carousel`(`image`) VALUES (?)";
            $values = [,$img_r];
            $res = insert($q,$values,'i');
            echo $res;
        }
    }

    if(isset($_POST["get_carousel"])){
        $res = selectAll('carousel');

        while($row = mysqli_fetch_assoc($res))
        {
            $path = CAROUSEL_IMG_PATH;
            echo <<<data
                <div class="col-md-2 mb-3">
                  <div class="card text-bg-dark">
                    <img src="$path$row[image]" class="card-img"  >
                    <div class="card-img-overlay text-end">
                      <button type="button" onclick="rem_member($row[sr_no])" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash3-fill"></i> Hapus
                      </button>
                    </div>
                  </div>
                </div>
            data;
        }
    }

    if(isset($_POST["rem_member"])){
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_member']];

        $pre_q = "SELECT * FROM `team_details` WHERE `sr_no`=?";
        $res = select($pre_q,$values,'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['picture'],ABOUT_FOLDER)){
            $q = "DELETE FROM `team_details` WHERE `sr_no`=?";
            $res = insert($q,$values,'i');
            echo $res;
        }
        else{
            echo 0;
        }
    }

?>