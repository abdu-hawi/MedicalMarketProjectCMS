<?php

$response = array();

if( $_SERVER['REQUEST_METHOD'] == "POST" ){
    if( isset($_POST['delta'])){
        
        require_once('includeDB/Constant.php');
        global $mm_handle;

        $myData = array();
        $stmt = $mm_handle->prepare( "SELECT * FROM `item` ORDER BY `ID` DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc() ){
            $myData[] = $row;
        }
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