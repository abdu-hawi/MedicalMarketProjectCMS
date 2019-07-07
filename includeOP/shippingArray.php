<?php

$response = array();

if( $_SERVER['REQUEST_METHOD'] == "POST" ){
    if( isset($_POST['UID'])){
        require_once ('../includeDB/Constant.php');
        
        $ui = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['UID']))));
        
        $stmt = $mm_handle->prepare("DELETE FROM `is_ship` WHERE `u_id` = ?  ");
        $stmt->bind_param("i",$ui);
        $stmt->execute();
        $stmt->close();
        mm_db_close();

    }// else for isset
    else{
        $response['error'] = true;
        $response['msg'] = "not good post";
        die(json_encode($response));
    }// End else for isset
    
}else{ // else for server
    $response['error'] = true;
    $response['msg'] = "invaild request";
    die(json_encode($response));
} // end else for server



?>