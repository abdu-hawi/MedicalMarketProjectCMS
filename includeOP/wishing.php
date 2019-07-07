<?php

$response = array();

if( $_SERVER['REQUEST_METHOD'] == "POST" ){
    if( isset($_POST['UID']) && isset($_POST['IID']) && isset($_POST['WISH'])){
        $con=mysqli_connect("localhost","root","","med_market");
        // Check connection
        if (mysqli_connect_errno())
          {
          die ("Failed to connect to MySQL: " . mysqli_connect_error());
          }
        $con->set_charset("utf8");

        $ii = intval($_POST['IID']);
        $ui = intval($_POST['UID']);
        $fav = intval($_POST['WISH']);
        
        if($fav == 1){
            $stmt = $con->prepare("INSERT INTO `is_wish` (`u_id`, `i_id`, `is_Fav`) VALUES ('$ui', '$ii', '$fav')");
            //$stmt = $con->prepare("INSERT INTO `is_wish` (`u_id`, `i_id`, `is_Fav`) VALUES ('?', '?', '?')");
            //$stmt->bind_param("iii",$ui,$ii,$fav);
            $stmt->execute();
        }elseif($fav == 0){
            $stmt = $con->prepare("DELETE FROM `is_wish` WHERE `u_id` = '$ui' AND `i_id` ='$ii' ");
            //$stmt = $con->prepare("INSERT INTO `is_wish` (`u_id`, `i_id`, `is_Fav`) VALUES ('?', '?', '?')");
            //$stmt->bind_param("iii",$ui,$ii,$fav);
            $stmt->execute();
        }
        $stmt->close();
        $con->close();

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