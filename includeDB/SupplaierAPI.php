<?php

require_once('Constant.php');

function selAllSupply(){
	$myData = array();
	global $mm_handle;
	$stmt= $mm_handle->prepare("SELECT * FROM `supplay`");
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc() ){
        $myData[] = $row;
    }
	mm_db_close();
    return json_encode($myData, JSON_UNESCAPED_UNICODE);
    mysqli_free_result($stmt);
}

function selAllSupplyDetail($id){
	global $mm_handle;
	$iId = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($id))));
	$stmt= $mm_handle->prepare("SELECT * FROM `supplay_list` WHERE `c_id` = ?");
	$stmt->bind_param("i",$iId);
    $stmt->execute();
    $result = $stmt->get_result();
	$myData = array();
    while($row = $result->fetch_assoc() ){
        $myData[] = $row;
    }
	mm_db_close();
    return json_encode($myData, JSON_UNESCAPED_UNICODE);
    mysqli_free_result($stmt);
}

function addSupplier($coN,$saN,$coM,$coP,$saE,$coMail,$coA,$coC){
	
	global $mm_handle;
	
	$mCoN = mysqli_real_escape_string($mm_handle,strip_tags(trim($coN)));
	$mSaN = mysqli_real_escape_string($mm_handle,strip_tags(trim($saN)));
	$mCoM = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($coM))));
	$mCoP = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($coP))));
	$mSaE = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($saE))));
	$mCoMail = mysqli_real_escape_string($mm_handle,strip_tags(trim($coMail)));
	$mCoA = mysqli_real_escape_string($mm_handle,strip_tags(trim($coA)));
	$mCoC = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($coC))));
	
	$stmt = $mm_handle->prepare("INSERT INTO `supplier` ( `s_com_name`, `s_sal_name`, `s_com_mob`, `s_com_phone`,
						 `s_sal_ext`, `s_com_email`, `s_com_address`, `s_com_code`)
						 VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssiiissi",$mCoN,$mSaN,$mCoM,$mCoP,$mSaE,$mCoMail,$mCoA,$mCoC);
    $stmt->execute();
	mm_db_close();
	if($stmt){
		return true;
	}else{
		return false;
	}
}

function checkSupplier($coC){
	
	global $mm_handle;
	
	$comC = mysqli_real_escape_string($mm_handle,strip_tags($coC));
	
	$qry = "SELECT c_id FROM `supplay` WHERE `c_code` = '$comC' ";
	$stmt = mysqli_query($mm_handle,$qry);
	mm_db_close();
	$result = $stmt->fetch_object();
	if($result != NULL){
		$name = $result;
	}else{
		$name = NULL;
	}
	return $name;
}

?>