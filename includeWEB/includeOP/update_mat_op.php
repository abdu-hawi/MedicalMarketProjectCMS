<?php
if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    if( isset($_POST['companyID']) and isset($_POST['matName']) and isset($_POST['matDesc']) and isset($_POST['pruchPri']) 
	and isset($_POST['selPri']) and isset($_POST['amtStk']) and isset($_POST['unitMat']) and isset($_POST['prodDate']) 
	and isset($_POST['expDate']) and isset($_POST['matCode']) ){
		
require_once '../../includeDB/SupplaierAPI.php';

$response = array();
        
        $s_code ;
        $code = strip_tags(trim($_POST['companyID']));
        $db = checkSupplier($code);
        if($db != NULL){
            $array = json_decode(json_encode($db), true);
            $s_code = implode(" ",$array);
        }else{
            mm_db_close();
            $response['error'] = true;
            $response['msg'] = 'Take sure from copmany code';
            die();
        } // end check Supplier
        $matName = strip_tags(trim($_POST['matName']));
        $matDesc = strip_tags(trim($_POST['matDesc']));
        $pruchPri = strip_tags(trim($_POST['pruchPri']));
        $selPri = strip_tags(trim($_POST['selPri']));
        $amtStk = strip_tags(trim($_POST['amtStk']));
        $unitMat = strip_tags(trim($_POST['unitMat']));
        $prodDate = strip_tags(trim($_POST['prodDate']));
        $expDate = strip_tags(trim($_POST['expDate']));
        $matCode = strip_tags(trim($_POST['matCode']));
        
        require_once '../../includeDB/ItemsAPI.php';
        
        $db = addItems($s_code,$matName,$matDesc,$pruchPri,$selPri,$amtStk,$unitMat,$prodDate,$expDate,$matCode);
        if($db){
            $respone['error'] = false;
            $response['msg'] = 'ok';
            $respone['error'] = false;
            $response['id'] = $db;
        }else{
            $respone['error'] = true;
            $response['msg'] = 'Not insert data, Please Try agine!';
        } // end add Item
	}else{
		$respone['error'] = true;
        $response['msg'] = 'Not insert data, Please Try agine!';
	}
}else{
	$respone['error'] = true;
    $response['msg'] = 'Not insert data, Please Try agine!';
}
echo json_encode($response);
?>