<?php
require ("../admin/inc/assentials.php");
require ("../admin/inc/db_config.php");

if (isset($_POST['buy_ship'])) {
    $frm_data = filteration($_POST);
    $img_r = uploadImage($_FILES['image'], PAYMENT_FOLDER);


    // if ($img_r == 'inv_img') {
    //     echo $img_r;
    // } else if ($img_r == 'inv_size') {
    //     echo $img_r;
    // } else if ($img_r == 'upd_failed') {
    //     echo $img_r;
    // } else {
    // }

    $q1 = "INSERT INTO `payment`(`nama`, `email`, `no_hp`, `alamat`, `nama_product`, `harga_product`, `catatan_product`, `image`) VALUES (?,?,?,?,?,?,?,?)";
    $values = [$frm_data['nama'], $frm_data['email'], $frm_data['no_hp'], $frm_data['alamat'], $frm_data['nama_product'], $frm_data['harga_product'], $frm_data['catatan_product'], $img_r];
    $res = insert($q1, $values, 'sssssiss');

    echo $res;
}
?>