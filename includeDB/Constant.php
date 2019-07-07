<?php

define('DB_NAME','med_market');
define('DB_USER','root');
define('DB_HOST','localhost');
define('DB_PASSWORD','');

$mm_handle = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Could not connect...');

 //to used ARABIC langauge

mysqli_query($mm_handle,"SET NAMES 'utf8'");
mysqli_query($mm_handle,"SET CHARACTER SET utf8");  
mysqli_query($mm_handle,"SET SESSION collation_connection = 'utf8_general_ci'"); 

function mm_db_close(){
    global $mm_handle;
    mysqli_close($mm_handle);
}

?>