<?php
require_once ('userAPI.php');

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['phone']) ){
        $result = get_user_by_phone($_POST['phone']);
        
        if($result == 1){
            $response['error'] = true;
            $response['msg'] = 1;//The phone number is exists
        }elseif($result == 0){
            $response['error'] = false;
            $response['msg'] = 0;//phone is not used
        }else{
            $response['error'] = true;
            $response['msg'] = 'some mistake';
        }
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