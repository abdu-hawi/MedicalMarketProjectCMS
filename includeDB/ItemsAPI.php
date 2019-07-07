<?php

	require_once('Constant.php');
function selAllItems($id){
	$mm_handle = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Could not connect...');
	$mm_handle->set_charset("utf8");
	$stmt ="";
	$iId = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($id))));
	$stmt= $mm_handle->prepare("SELECT * FROM `items_list` WHERE `s_id` = ?");
	$stmt->bind_param("i",$iId);
    $stmt->execute();
    $result = $stmt->get_result();
	$myData = array();
    while($row = $result->fetch_assoc() ){
        $myData[] = $row;
    }
	mysqli_close($mm_handle);
    return json_encode($myData, JSON_UNESCAPED_UNICODE);
    mysqli_free_result($stmt);
}

function selItem($id){
	$mm_handle = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Could not connect...');
	$mm_handle->set_charset("utf8");
	$stmt ="";
	$iId = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($id))));
	$stmt= $mm_handle->prepare("SELECT * FROM `items_list` WHERE `id` = ?");
	$stmt->bind_param("i",$iId);
    $stmt->execute();
    $result = $stmt->get_result();
	$myData = array();
    while($row = $result->fetch_assoc() ){
        $myData[] = $row;
    }
	mysqli_close($mm_handle);
    return json_encode($myData, JSON_UNESCAPED_UNICODE);
    mysqli_free_result($stmt);
}
function selItemDetail($id){
	$mm_handle = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Could not connect...');
	$mm_handle->set_charset("utf8");
	$stmt ="";
	$iId = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($id))));
	$stmt= $mm_handle->prepare("SELECT `itemDescription` FROM `description` WHERE `itemID` = ?");
	$stmt->bind_param("i",$iId);
    $stmt->execute();
    $result = $stmt->get_result();
	$myData = array();
    while($row = $result->fetch_assoc() ){
        $myData[] = $row;
    }
	mysqli_close($mm_handle);
    return json_encode($myData, JSON_UNESCAPED_UNICODE);
    mysqli_free_result($stmt);
}

function addItems($sI,$mN,$mD,$pP,$sP,$aS,$uM,$pD,$eD,$mC){
	
$mm_handle = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Could not connect...');
$mm_handle->set_charset("utf8");
//$mm_handle->query("SET CHARACTER SET utf8");
//$mm_handle->query("SET SESSION collation_connection = 'utf8_general_ci'");

	$qry = "INSERT INTO `items` (`i_id`, `s_id`, `i_name`, `i_desc`, `i_prush_pri`, `i_sel_pri`, `i_amt_stk`, `i_unit`, `i_prod_date`, `i_prod_exp`, `i_code`) VALUES (NULL, '$sI', '$mN', '$mD', '$pP', '$sP', '$aS', '$uM', '$pD', '$eD', '$mC');";
	$stmt = mysqli_query($mm_handle,$qry);
	if($stmt){
		return mysqli_insert_id($mm_handle);
	mysqli_free_result($stmt);
	mysqli_close($mm_handle);
	}else{
		return false;
	mysqli_free_result($stmt);
	mysqli_close($mm_handle);
	}
}

function insertImgItems($iID,$iImg){
	
$mm_handle = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Could not connect...');
$mm_handle->set_charset("utf8");

	$stmt = $mm_handle->prepare("INSERT INTO `img_items` (`i_id`, `i_img_name`) VALUES ('?', '?')");
	$stmt->bind_param("is",$iId,$iImg);
    $stmt->execute();
	if($stmt){
		return true;
	mysqli_free_result($stmt);
	mysqli_close($mm_handle);
	}else{
		return false;
	mysqli_free_result($stmt);
	mysqli_close($mm_handle);
	}
}

function updateItems($iID,$iImg){
	
$mm_handle = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Could not connect...');
$mm_handle->set_charset("utf8");
//$mm_handle->query("SET CHARACTER SET utf8");
//$mm_handle->query("SET SESSION collation_connection = 'utf8_general_ci'");
	$qry = "INSERT INTO `img_items` (`i_id`, `i_img_name`) VALUES ('$iID', '$iImg')
		 )";
	$stmt = mysqli_query($mm_handle,$qry);
	//mm_db_close();
	if($stmt){
		return true;
	mysqli_free_result($stmt);
	mysqli_close($mm_handle);
	}else{
		return false;
	mysqli_free_result($stmt);
	mysqli_close($mm_handle);
	}
}

?>