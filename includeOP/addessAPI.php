<?php

require_once ('../includeDB/Constant.php');

function updateAddress($id,$name,$country,$city,$address,$mobile){
    global $mm_handle;
    $stmt= $mm_handle->prepare("UPDATE `users_address` SET `u_add_name`=?,`u_add_country`=?,
    `u_add_city`=?,`u_add_address`=?,`u_add_mob`=? WHERE `user_id` = ?");
    $stmt->bind_param("ssssii",$name,$country,$city,$address,$mobile,$id);
    $stmt->execute();
    if($stmt){
        return 1;
    }else{
        return 0;
    }
    mysqli_free_result($stmt);
}

function checkAddress($id){
    global $mm_handle;
    $stmt= $mm_handle->prepare("SELECT uID FROM `user_address` WHERE uID = ?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc() ){
        return $row;
    }
    mysqli_free_result($stmt);
}

function selectAddress($id){
    global $mm_handle;
    $stmt= $mm_handle->prepare("SELECT * FROM `user_address` WHERE uID = ?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc() ){
        return $row;
    }
    mysqli_free_result($stmt);
}
function insertAddress($id,$name,$country,$city,$address,$mobile){
    global $mm_handle;
    $stmt= $mm_handle->prepare("INSERT INTO `users_address` (`user_id`, `u_add_name`, `u_add_country`,
                            `u_add_city`, `u_add_address`, `u_add_mob`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi",$id,$name,$country,$city,$address,$mobile);
    $stmt->execute();
    if($stmt){
        return 1;
    }else{
        return 0;
    }
    mysqli_free_result($stmt);
}
?>