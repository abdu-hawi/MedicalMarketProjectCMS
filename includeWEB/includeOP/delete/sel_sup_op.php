<?php


if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    if( isset($_POST['id']) ){
        
        require_once '../../includeDB/SupplaierAPI.php';
        
        $id = strip_tags(trim($_POST['id']));
        
        $db = selAllSupply();
        if($db){
            echo $db;
        }else{
            echo 'No found data';
        } // end add Supplier
        
    }// else for isset
    else{
        echo 'you have some error';
    }// End else for isset
    
}else{ // else for server
    echo 'invaild request';
} // end else for server

//echo 'okInsert';

?>