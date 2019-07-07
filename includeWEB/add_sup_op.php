<?php


if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    if( isset($_POST['company']) and
       isset($_POST['sales']) and
       isset($_POST['mobile']) and
       isset($_POST['email']) and
       isset($_POST['address']) and
       isset($_POST['code'])  ){
        
        require_once '../includeDB/SupplaierAPI.php';
        
        $company = strip_tags(trim($_POST['company']));
        $sales = strip_tags(trim($_POST['sales']));
        $mobile = strip_tags(trim($_POST['mobile']));
        $email = strip_tags(trim($_POST['email']));
        $address = strip_tags(trim($_POST['address']));
        $code = strip_tags(trim($_POST['code']));
		$phone;
		if($_POST['phone'] == ''){
			$phone = 0;
		}else{
			$phone = strip_tags(trim($_POST['phone']));
		}
        $ext;
		if($_POST['ext'] == ''){
			$ext = 0;
		}else{
			$ext = strip_tags(trim($_POST['ext']));
		}
        $db = addSupplier($company,$sales,$mobile,$phone,$ext,$email,$address,$code);
        if($db){
            echo 'okInsert';
        }else{
            echo 'not insert data';
        } // end add Supplier
        
    }// else for isset
    else{
        echo 'data isset not good';
    }// End else for isset
    
}else{ // else for server
    echo 'invaild request';
} // end else for server

//echo 'okInsert';

?>