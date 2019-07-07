<?php
require_once ('../includeDB/Constant.php');

function create_user($name,$pass,$phone){
    Global $mm_handle;
    if(get_user_by_phone($phone)){
        return 1;
    }else{
        $password = md5($pass);
        //u_id	u_name	u_mobile	u_pass
        $stmt= $mm_handle->prepare("INSERT INTO `users` (`u_id`, `u_name`, `u_pass`, `u_mobile`)
                             VALUES (NULL, ?, ?, ?);");
        $stmt->bind_param("sss",$name,$password,$phone);
        $stmt->execute();
        if($stmt){
            return 2;
        }else{
            return 3;
        }
    }
    close_db();
}

function get_user_by_phone($phone){
    Global $mm_handle;
    $stmt = mysqli_query($mm_handle,"SELECT * FROM `users` WHERE `u_mobile` = '$phone'");
    $result = mysqli_fetch_row($stmt);
    if($result) return 1;
    else return 0;
}

function userLogin($phone,$pass){
    Global $mm_handle;
    $password = md5($pass);
    $stmt = mysqli_query($mm_handle,"SELECT `u_id` FROM `users` WHERE `u_mobile` = '$phone' AND `u_pass` = '$password'");
    return mysqli_fetch_row($stmt) > 0 ;
}
function get_name_by_phone($phone){
    Global $mm_handle;
    $stmt = mysqli_query($mm_handle,"SELECT * FROM `users` WHERE `u_mobile` = '$phone'");
    return $result = mysqli_fetch_assoc($stmt);
}
?>