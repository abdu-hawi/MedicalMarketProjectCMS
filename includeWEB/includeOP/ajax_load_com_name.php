<?php

	if(!isset($_POST['id']))
		return false;
	$connect = mysqli_connect('localhost','root','','med_market');
	$id_post = $_POST['id'];
	$out_put = '';
	
	$sql = mysqli_query($connect,"SELECT * FROM `supplier` WHERE `s_com_code` = '$id_post' ");
	
	while($rows = mysqli_fetch_assoc($sql) ){
		$name = $rows['s_com_name'];
		$out_put .= '<input type="text" class="form-control" id="com_name" value="'.$name.'" name="company" onChange="comNameFunction()" readonly>';
	}
	mysqli_close($connect);
	
	echo $out_put;
?>