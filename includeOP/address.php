<?php


$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['delta']) ){
        
        require_once ('../includeDB/Constant.php');
        
        $id = intval($_POST['delta']);
        $myData = array();
        $stmt= $mm_handle->prepare("SELECT * FROM `user_address` WHERE uID = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc() ){
            $myData[] = $row;
        }
        mm_db_close();
        die (json_encode($myData, JSON_UNESCAPED_UNICODE));
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