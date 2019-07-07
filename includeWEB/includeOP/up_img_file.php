<?php

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_FILES["file"]["type"]) && isset($_POST['itemID']) ){
		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
		
		if (( ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
				) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
				&& in_array($file_extension, $validextensions)) {
			if ($_FILES["file"]["error"] > 0) {
			echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
			} else { // end if of file error
				if (file_exists("../../upload/" . $_FILES["file"]["name"])) {
					$response['error'] = true;
					$response['msg'] = $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
					die(json_encode($response));
				}else{
					$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
					$targetPath = "../../upload/".$_FILES['file']['name']; // Target path where file is to be stored
					move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
					
					$i_id = intval($_POST['itemID']);
					$i_img_name = $_FILES["file"]["name"] ;
					
					//require_once "../../includeDB/ItemsAPI.php";
					//$stmt = insertImgItems($i_id,$i_img_name);
					$mm_handle = @mysqli_connect('localhost','id3090117_abdu','word6666','id3090117_med_market') or die('Could not connect...');
					
					$qry = "SELECT `i_img_name` AS `img` FROM `img_items` WHERE `i_id` = '$i_id' ";
					$stmt = mysqli_query($mm_handle,$qry);
					$row = mysqli_fetch_assoc($stmt);
					if($row){
					    
					    mysqli_query($mm_handle,"BEGIN TRANSACTION");
					    $qry_del = mysqli_query($mm_handle,"DELETE FROM `img_items` WHERE `i_id`= '$i_id'");
					    if($qry_del){
					        $ins = "INSERT INTO `img_items` (`i_id`, `i_img_name`) VALUES ('$i_id', '$i_img_name') ";
					        $qry_ins = mysqli_query($mm_handle,$ins);
					        if($qry_ins){
					            $qry_ins = mysqli_query($mm_handle,"COMMIT");
					            $response['error'] = false;
    							$response['msg'] = 'okUpdate';
    							unlink("../../upload/".$row['img']);
    							mysqli_close($mm_handle);
					        }else{
					            $qry_ins = mysqli_query($mm_handle,"ROLLBACK");
    					        $response['error'] = true;
    							$response['msg'] = 'Not update items';
    							mysqli_close($mm_handle);
					        }
					    }else{
					        $qry_ins = mysqli_query($mm_handle,"ROLLBACK");
					        $response['error'] = true;
							$response['msg'] = 'Not update';
							mysqli_close($mm_handle);
					    }
					    /*
						$qry_update = "UPDATE `img_items` SET `i_img_name`='$i_img_name' WHERE `i_img_name`=".$row['img'];
						$stmt_update = mysqli_query($mm_handle,$qry);
						if($stmt_update){
							$response['error'] = false;
							$response['msg'] = 'okUpdate';
							$response['msi'] = $row['img'];
							mysqli_close($mm_handle);
						}else{
							$response['error'] = true;
							$response['msg'] = 'Not update items';
							mysqli_close($mm_handle);
						}
						*/
					}else{
						$qry = "INSERT INTO `img_items` (`i_id`, `i_img_name`) VALUES ('$i_id', '$i_img_name') ";
						$stmt = mysqli_query($mm_handle,$qry);
						if($stmt ){
							$response['error'] = false;
							$response['msg'] = 'ok';
							mysqli_close($mm_handle);
						}else{
							$qry_delete = "DELETE FROM `items` WHERE `i_id`= '$i_id'";
							$stmt = mysqli_query($mm_handle,$qry_delete);
							$response['error'] = true;
							$response['msg'] = 'Not insert items';
							mysqli_close($mm_handle);
						}
					}
				}
			} // end else of file error
		}else{ // end if of type & img size
			$response['error'] = true;
			$response['msg'] = "<b><span id='invalid'>***Invalid file Size or Type***<span></b>";
		} // end else of type & img size
	}else{// end if isset
		$response['error'] = true;
		$response['msg'] = 'Request faild, please try agin';
	}// end else of if iseet
}else{// end if request
	$response['error'] = true;
	$response['msg'] = 'Request faild, please try agin';
} // end else of if request


echo json_encode($response);

?>