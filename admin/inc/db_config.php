<?php

    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'hbwebsite';

    $con = mysqli_connect($hname,$uname,$pass,$db);

    if(!$con){
        die("Tidak bisa terconeksi ke Database ".mysqli_connect_error());
    }

    function filteration($data){
        foreach($data as $key => $value){
            $value = trim($value);
            $value = stripcslashes($value);
            $value = htmlspecialchars($value);
            $value = strip_tags($value);

            $data[$key] = $value;
        }
        return $data;
    }

    function selectAll($table){
        $con = $GLOBALS['con'];
        $res = mysqli_query($con, "SELECT * FROM $table ORDER BY `sr_no` DESC");
        return $res;
    }
    function selectAllId($table){
        $con = $GLOBALS['con'];
        $res = mysqli_query($con, "SELECT * FROM $table ORDER BY `id` DESC");
        return $res;
    }

    function select($sql,$values,$datatypes){
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);

            if(mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }else{
                die("Query tidak bisa di eksekusi - Select");
            }
        }else{
            die("Query tidak bisa di lakukan - Select");
        }
    }

    function update($sql,$values,$datatypes){
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);

            if(mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }else{
                die("Query tidak bisa di eksekusi - Update");
            }
        }else{
            die("Query tidak bisa di lakukan - Update");
        }
    }

    function insert($sql,$values,$datatypes){
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);

            if(mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }else{
                die("Query tidak bisa di eksekusi - Insert");
            }
        }else{
            die("Query tidak bisa di lakukan - Insert");
        }
    }

    function delete($sql,$values,$datatypes){
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt,$datatypes,...$values);

            if(mysqli_stmt_execute($stmt)) {
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }else{
                die("Query tidak bisa di eksekusi - Delete");
            }
        }else{
            die("Query tidak bisa di lakukan - Delete");
        }
    }

?>