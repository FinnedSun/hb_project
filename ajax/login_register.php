

<?php
    require("../admin/inc/assentials.php");
    require("../admin/inc/db_config.php");
    session_start();

    // function alert($email,$name,$token)
    // {
    //     echo 
    //     "<script type='text/javascript'>
    //         alert(`Email : ${$email}, Name : ${$name}`)
    //     </script>
    //     <a href='".SITE_URL."email_confirm.php?email=$email&token=$token"."'>Clik me</a>
    //     ";

    // }

    // if(isset($_POST['register']))
    // {
    //     $data = filteration($_POST);

    //     // samakan pass dan confim pass

    //     if($data['pass'] != $data['cpass'])
    //     {
    //         echo "pass_mismatch";
    //         exit;
    //     }

    //     // cek user ada atau tidak

    //     $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
    //         [$data['email'],$data['phonenum']], 'ss');

    //     if(mysqli_num_rows($u_exist)!=0){
    //         $u_exist_fetch = mysqli_fetch_assoc($u_exist);
    //         echo ($u_exist_fetch['email'] == $data['email']) ? "email_already" : "phone_already";
    //         exit;
    //     }

    //     //upload user image to server

    //     $img = uploadUserImage($_FILES['profile']);

    //     if($img == 'inv_img'){
    //         echo 'inv_img';
    //         exit;
    //     }
    //     else if ($img == 'upd_failed'){
    //         echo "upd_failed";
    //         exit;
    //     }

    //     // link konfirmasi ke email users

    //     $token = bin2hex(random_bytes(16));
    //     if(!alert($data['email'],$data['name'],$token)){
    //         echo 'mail_failed';
    //         exit;
    //     }

    //     $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);

    //     $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`, 
    //         `profile`, `password`, `token`) VALUES (?,?,?,?,?,?,?,?,?)";
        
    //     $values = [$data['name'],$data['email'],$data['address'],$data['phonenum'],$data['pincode'],$data['dob'],
    //         $img,$enc_pass,$token];
        
    //     if(insert($query,$values,'sssssssss')){
    //         echo 1;
    //     }
    //     else{
    //         echo 'ins_failed';
    //     }

    // }

    // if(isset($_POST['login']))
    // {
    //     $data = filteration($_POST);

    //     $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
    //         [$data['email_mob'],$data['email_mob']], "ss");

    //         if(mysqli_num_rows($u_exist)==0){
    //             echo 'inv_email_mob';
    //         }
    //         else{
    //             $u_fetch = mysqli_fetch_assoc($u_exist);
    //             if($u_fetch['is_varified']==0){
    //                 echo 'not_verified';
    //             }
    //             else if($u_fetch['status']==0){
    //                 echo 'inactive';
    //             }
    //             else{
    //                 if(!password_verify($data['pass'],$u_fetch['password'])){
    //                     echo 'invalid_pass';
    //                 }
    //                 else{
    //                     session_start();
    //                     $_SESSION['login'] = true;
    //                     $_SESSION['uId'] = $u_fetch['id'];
    //                     $_SESSION['uName'] = $u_fetch['name'];
    //                     $_SESSION['uPhone'] = $u_fetch['phonenum'];
    //                     echo 1;
    //                 }
    //             }

    //         }



    // }

    #for Login
    if(isset($_POST['login'])){
        $query = "SELECT * FROM `registered_users` WHERE `email`='$_POST[email_username]' OR `username`='$_POST[email_username]'";

        $result = mysqli_query($con, $query);
        if($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $result_fetch = mysqli_fetch_assoc($result);
                if(password_verify($_POST['password'],$result_fetch['password']))
                {
                    $_SESSION['logged_in']=true;
                    $_SESSION['username']=$result_fetch['username'];
                    $_SESSION['pictue']=$result_fetch['profile'];
                    $_SESSION['phonenum']=$result_fetch['phonenum'];
                    $_SESSION['address']=$result_fetch['address'];
                    header("location: http://localhost/hb_project");
                }
                else
                {
                    #if incorrect password
                    echo"
                        <script>
                            alert('Password tidak benar');
                            window.location.href = 'http://localhost/hb_project/index.php';
                        </script>
                    ";
                }
            }
            else
            {
                echo"
                    <script>
                        alert('Email dan Username tidak terregistrasi');
                        window.location.href = 'http://localhost/hb_project/index.php';
                    </script>
                ";
            }
        }
        else
        {
            echo"
                <script>
                    alert('Tidak bisa Run Query');
                    window.location.href = 'http://localhost/hb_project/index.php';
                </script>
            ";
        }
    }

    #for Register
    if(isset($_POST['register']))
    {
        $user_exist_query = "SELECT * FROM `registered_users` WHERE `username`='$_POST[username]' OR `email`='$_POST[email]'";
        $result = mysqli_query($con,$user_exist_query);

        if($result){
            if(mysqli_num_rows($result)>0) #it will be executed if username or email already taken
            {
                $result_fetch = mysqli_fetch_assoc($result);
                if($result_fetch['username']==$_POST['username'])
                {
                    #error for username already registed
                    echo
                    "
                        <script>
                            alert('$result_fetch[username] - Username telah dipakai');
                            window.location.href = 'http://localhost/hb_project/';
                        </script>
                    ";
                }
                else
                {
                    #error for email already registed
                    echo 
                    "
                        <script>
                            alert('$result_fetch[email] - Email telah dipakai');
                            window.location.href = 'http://localhost/hb_project/';
                        </script>
                    ";
                }
            }
            else #it will be execute if no one has taken user username or email beafor
            {
                $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
                $img = uploadUserImage($_FILES['profile']);
                $query = "INSERT INTO `registered_users`(`username`, `email`, `phonenum`, `profile`, `alamat`, `pincode`, `password`) 
                    VALUES ('$_POST[username]','$_POST[email]','$_POST[phonenum]','$img','$_POST[address]','$_POST[pincode]','$password')";

                if (mysqli_query($con, $query))
                {
                    #if data insered successfully
                    echo
                    "
                        <script>
                            alert('Registration Successfull');
                            location.href = 'http://localhost/hb_project/';
                        </script>
                    ";
                }
                else
                {
                    #if data cennot be inserted
                    echo "
                    <script>
                        alert('Tidak bisad Run Query');
                        window.location.href = 'http://localhost/hb_project/';
                    </script>";
                }
            }
        }else {
            echo 
            "
                <script>
                    alert('Tidak bisa Run Query');
                    window.location.href = 'http://localhost/hb_project/';
                </script>
            ";
        }
    }
?>

