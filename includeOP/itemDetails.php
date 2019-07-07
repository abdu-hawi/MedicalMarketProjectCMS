<?php

$response = array();

if( $_SERVER['REQUEST_METHOD'] == "POST" ){
    if( isset($_POST['ID'])){
        require_once ('../includeDB/Constant.php');
        $id = intval($_POST['ID']);
        $myData = array();
        $stmt = $mm_handle->prepare( "SELECT `itemDescription` FROM `description` WHERE `itemID` = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc() ){
            $myData[] = $row;
        }
        mm_db_close();
        echo json_encode($myData, JSON_UNESCAPED_UNICODE);

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