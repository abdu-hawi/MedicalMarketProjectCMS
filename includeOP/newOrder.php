<?php
$response = array();
    
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['user_id']) && isset($_POST['rec_name']) && isset($_POST['rec_mob'])
        && isset($_POST['rec_con']) && isset($_POST['rec_city']) && isset($_POST['rec_address'])
        && isset($_POST['isSave']) && isset($_POST['final_total_amt']) && isset($_POST['json_items'])){
        
        require_once ('../includeDB/Constant.php');
        
        $id = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['user_id']))));
        $mobile = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['rec_mob']))));
        $name = mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['rec_name'])));
        $country = mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['rec_con'])));
        $city = mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['rec_city'])));
        $address = mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['rec_address'])));
        $isSave = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['isSave']))));
        $final_total_amt = mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['final_total_amt'])));
        $json_items = mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['json_items'])));
        
        $date = date("Y-m-d H:i:s" ) ;
        if($isSave == 0){
            $mm_handle -> query("Begain Transaction");
            $stmt= $mm_handle->prepare("INSERT INTO `tbl_order` (`user_id`, `u_add_name`, `u_add_country`,
                                       `u_add_city`, `u_add_address`, `u_add_mob`,`u_add_amt`,`oreder_date`)
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssids",$id,$name,$country,$city,$address,$mobile,$final_total_amt,$date);
            $stmt->execute();
            if($stmt){
                $lastID = mysqli_insert_id($mm_handle);
                $js = json_decode($_POST['json_items']);
                for($count=0 ; $count< count($js->recent) ; $count++){
                    $item_id = trim($js->recent[$count]->IID);
                    $item_qty = trim($js->recent[$count]->QTY);
                    
                    $qry_item= $mm_handle->prepare("INSERT INTO `tbl_order_item` (`order_id`, `i_id`, `qty`)
                                                   VALUES (?, ?, ?)");
                    $qry_item->bind_param("iii",$lastID,$item_id,$item_qty);
                    $qry_item->execute();
                    if($qry_item){
						$unicID = $lastID+3729;
						$qry_unic= $mm_handle->prepare("INSERT INTO `tbl_order_id` (`order_id`, `unicID`)
                                                   VALUES (?, ?)");
						$qry_unic->bind_param("ii",$lastID,$unicID);
						$qry_unic->execute();
						if($qry_unic){
							$mm_handle->query("DELETE FROM `user_address` WHERE `uID` = ".$id);
							$mm_handle->query("Commit");
							$response['error'] = false;
							$response['msg'] = $unicID;
						}else{
							//$mm_handle->query("DELETE FROM `tbl_order` WHERE `order_id` = ".$lastID);
							$mm_handle->query("Rollback Transaction");
							$response['error'] = true;
							$response['msg'] = 'Do not insert items';
						}
                    }else{
                        //$mm_handle->query("DELETE FROM `tbl_order` WHERE `order_id` = ".$lastID);
                        $mm_handle->query("Rollback Transaction");
                        $response['error'] = true;
                        $response['msg'] = 'Do not insert items';
                    }
                    
                } // end for loop
            }else{ // end if stmt insert to order_address
                $response['error'] = true;
                $response['msg'] = 'Not insert';
            }// end else stmt insert to order_address
        }// end else isSave
        elseif($isSave ==1){
            $mm_handle -> query("Begain Transaction");
            $stmt= $mm_handle->prepare("INSERT INTO `tbl_order` (`user_id`, `u_add_name`, `u_add_country`,
                                       `u_add_city`, `u_add_address`, `u_add_mob`,`u_add_amt`,`oreder_date`)
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssids",$id,$name,$country,$city,$address,$mobile,$final_total_amt,$date);
            $stmt->execute();
            if($stmt){
                $lastID = mysqli_insert_id($mm_handle);
                $js = json_decode($_POST['json_items']);
                for($count=0 ; $count< count($js->recent) ; $count++){
                    $item_id = trim($js->recent[$count]->IID);
                    $item_qty = trim($js->recent[$count]->QTY);
                    
                    $qry_item= $mm_handle->prepare("INSERT INTO `tbl_order_item` (`order_id`, `i_id`, `qty`)
                                                   VALUES (?, ?, ?)");
                    $qry_item->bind_param("iii",$lastID,$item_id,$item_qty);
                    $qry_item->execute();
                    if($qry_item){
						$unicID = $lastID+3729;
						$qry_unic= $mm_handle->prepare("INSERT INTO `tbl_order_id` (`order_id`, `unicID`)
                                                   VALUES (?, ?)");
						$qry_unic->bind_param("ii",$lastID,$unicID);
						$qry_unic->execute();
						if($qry_unic){
							$mm_handle->query("Commit");
							$response['error'] = false;
							$response['msg'] = $unicID;
						}else{
							//$mm_handle->query("DELETE FROM `tbl_order` WHERE `order_id` = ".$lastID);
							$mm_handle->query("Rollback Transaction");
							$response['error'] = true;
							$response['msg'] = 'Do not insert items';
						}
                    }else{
                        //$mm_handle->query("DELETE FROM `tbl_order` WHERE `order_id` = ".$lastID);
                        $mm_handle->query("Rollback Transaction");
                        $response['error'] = true;
                        $response['msg'] = 'Do not insert items';
                    }
                    
                } // end for loop
            }else{ // end if stmt insert to order_address
                $response['error'] = true;
                $response['msg'] = 'Not insert';
            }// end else stmt insert to order_address
        }
        mm_db_close();
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