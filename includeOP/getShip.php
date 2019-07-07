<?php


$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['delta']) ){
        
        require_once ('../includeDB/Constant.php');
        
        Global $mm_handle;
        
        $ui = intval($_POST['delta']);
        $myData = array();
        $stmt = $mm_handle->prepare( "SELECT `IID` FROM `shipping` WHERE `UID` = ".$ui);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc() ){
            $myData[] = $row;
        }
        echo json_encode($myData, JSON_UNESCAPED_UNICODE);
    }else{
        $response['error'] = true;
        $response['msg'] = 'Some Mistake';
        echo json_encode($response);
        die();
    }
}else{
    $response['error'] = true;
    $response['msg'] = 'Cannot connect to server';
    echo json_encode($response);
    die();
}



?>