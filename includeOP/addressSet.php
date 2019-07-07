<?php


$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['ID']) && isset($_POST['name']) && isset($_POST['mobile'])
        && isset($_POST['country']) && isset($_POST['city']) && isset($_POST['address']) ){
        
        require_once ('../includeDB/Constant.php');
        
        $id = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['ID']))));
        $mobile = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['mobile']))));
        $name = mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['name'])));
        $country = mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['country'])));
        $city = mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['city'])));
        $address = mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['address'])));
        
        $myData = array();
        $stmt= $mm_handle->prepare("SELECT uID FROM `user_address` WHERE uID = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc() ){
            $myData[] = $row;
        }
        if(sizeof($myData) > 0){
            $stmt= $mm_handle->prepare("UPDATE `users_address` SET `u_add_name`=?,`u_add_country`=?,
            `u_add_city`=?,`u_add_address`=?,`u_add_mob`=? WHERE `user_id` = ?");
            $stmt->bind_param("ssssii",$name,$country,$city,$address,$mobile,$id);
            $stmt->execute();
            if($stmt){
                $response['error'] = false;
                $stmt= $mm_handle->prepare("SELECT * FROM `user_address` WHERE uID = ?");
                $stmt->bind_param("i",$id);
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc() ){
                    $response['uName'] = $row['uName'];
                    $response['uMobile'] = $row['uMobile'];
                    $response['uCountry'] = $row['uCountry'];
                    $response['uCity'] = $row['uCity'];
                    $response['uAddress'] = $row['uAddress'];
                }
            }else{
                $response['error'] = true;
                $response['msg'] = 'Not update';
            }
            
        }else {
            // insert
            /*
             INSERT INTO `users_address` (`user_id`, `u_add_name`, `u_add_country`, `u_add_city`, `u_add_address`, `u_add_mob`) VALUES ('', '', '', '', '', '')
             */
            $stmt= $mm_handle->prepare("INSERT INTO `users_address` (`user_id`, `u_add_name`, `u_add_country`,
                                       `u_add_city`, `u_add_address`, `u_add_mob`) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssi",$id,$name,$country,$city,$address,$mobile);
            $stmt->execute();
            if($stmt){
                $response['error'] = false;
                $response['msg'] = 'insert';
            }else{
                $response['error'] = true;
                $response['msg'] = 'Not insert';
            }
        }
        
        mm_db_close();
    }else{
        $response['error'] = true;
        $response['msg'] = 'All filed required';
    }
}else{
    $response['error'] = true;
    $response['msg'] = 'Cannot connect to server';
}

echo json_encode($response);

?>