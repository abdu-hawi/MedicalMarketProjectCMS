<?php
if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    if( isset($_POST['id']) ){
        //<a href="../includeDB/ItemsAPI.php"></a>
        require_once '../includeDB/ItemsAPI.php';
        
		$iId = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['id']))));
        
        $db = selItem($iId);
        if($db){
            $json = json_decode($db,true);
			foreach($json as $items) {
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update Item</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/jquery.min.js"></script>
</head>

<body>

<h2>Update Material</h2>
<div id="show" align="center"></div>
  <form class="form-horizontal med_mat" id="add_mat" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="companyID">Copmany ID:</label>
      <div class="col-sm-10 col-lg-3">
        <input type="text" class="form-control" id="com_id" value="<?php //echo $items['code']; ?>" name="companyID" 
        	oninput="comFunction()">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="company">Copmany Name:</label>
      <div class="col-sm-10 col-lg-6" id="com_name_test">
        <input type="text" class="form-control" id="com_name" value="<?php //echo $items['name']; ?>" name="company" readonly>
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="mat_name">Name of Material:</label>
      <div class="col-sm-10 col-lg-5">
        <input type="text" class="form-control" id="mat_name" value="<?php echo $items['name']; ?>" name="matName"
        	oninput="nameFunction()">
      </div>
    </div>
    
    <?php
	  $db = selItemDetail($iId);
        if($db){
            $json = json_decode($db,true);
			foreach($json as $detail) {
	  ?>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="matDesc">Details of Material:</label>
      <div class="col-sm-10 col-lg-8">
        <textarea class="form-control" id="mat_desc" name="matDesc"
         	oninput="matFunction()" rows="8"><?php echo $detail['itemDescription']; ?></textarea>
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="pruchPri">Purchasing Price:</label>
      <div class="col-sm-10 col-lg-3">
        <input  type="text" class="form-control" id="pruch_pri" name="pruchPri" value="<?php echo $items['price_prush']; ?>"
        	oninput="pruchFunction()">
      </div>
      <label class="control-label col-sm-2" for="selPri">Selling Price:</label>
      <div class="col-sm-10 col-lg-3">
        <input  type="text" class="form-control" id="sel_pri" value="<?php echo $items['price_sell']; ?>" name="selPri"
        	oninput="selFunction()">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="amtStk">Amount of Stock:</label>
      <div class="col-sm-10 col-lg-3">
        <input type="text" class="form-control" id="amt_stk" value="<?php echo $items['stock']; ?>" name="amtStk"
         	oninput="amtStkFunction()"/>
      </div>
      <label class="control-label col-sm-2" for="unitMat">Unit of Material:</label>
      <div class="col-sm-10 col-lg-3">
        <input  type="text" class="form-control" id="unit_mat" value="<?php echo $items['unit']; ?>" name="unitMat"
        	oninput="unitMatFunction()">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="prodDate">Product Date:</label>
      <div class="col-sm-10 col-lg-3">
        <input  type="date" class="form-control" id="prod_date" value="<?php echo $items['product_date']; ?>" name="prodDate"
        	oninput="prodDateFunction()">
      </div>
      <label class="control-label col-sm-2" for="expDate">Expire Date:</label>
      <div class="col-sm-10 col-lg-3">
        <input  type="date" class="form-control" id="exp_date" value="<?php echo $items['expire_date']; ?>" name="expDate"
        	oninput="expDateFunction()">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="matCode">Code Of Material:</label>
      <div class="col-sm-10 col-lg-3">
        <input type="text" class="form-control" id="mat_code" value="<?php echo $items['code']; ?>" name="matCode"
        	oninput="matCodeFunction()">
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <Button type="button" class="btn btn-success add_supplay" id="add_supplay" name="add_supplay">Click To Continue Update Material</button>
      </div>
    </div>
  </form>


</body>
</html>

<?php

			}// end foreach detail
		}// end if $db
				} // END foreach $supplay
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

<script>

// this var to count all input is empty or not
var ch = 0;

$(document).ready(function(e) {
    countInput();
}); // end function ready

// this function to declare at all time when write in input 
function countInput(){
	if(ch == 0){
		$('#show').html('<div class="alert alert-warning col-sm-12 "><b>الرجاء ملء جميع الحقول</b></div>');
	}else{
		$('#show').html('');
	}
}

function getComName(idCom){
	$.ajax({
	  url:'includeOP/ajax_load_com_name.php',
	  type:'POST',
	  data:'id='+idCom,
	  success: function(data){
		if(data != ''){
		$('#com_id').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
		  $('#com_name_test').html(data);
		  $('#com_name').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
		  $('#show').html('<div class="alert alert-warning "><b>الرجاء ملء جميع الحقول</b></div>');
		}else{
			$('#com_name').val('');
			$('#com_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		  $('#show').html('<div class="alert alert-danger"><b>رقم العميل غير صحيح, نرجو إعادة إدخال رقم العميل </b></div>');
		}
	  },
	  complate:function(){
		$('#show').remove();
	  }
	});
}

function comFunction() {
	$('#com_id').css({'background':'#ffdede', 'border':'1px solid #d30000' });
    if($.trim($('#com_id').val()).length > 0){ 
		var id = $.trim($('#com_id').val());
		getComName(id);
	 }else{
		$('#com_id').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function nameFunction() {
    if($.trim($('#mat_name').val()).length > 0){ 
		$('#mat_name').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		$('#mat_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function matFunction() {
    if($.trim($('#mat_desc').val()).length > 0){ 
		$('#mat_desc').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		$('#mat_desc').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function pruchFunction() {
    if($.trim($('#pruch_pri').val()).length > 0){ 
		$('#pruch_pri').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		$('#pruch_pri').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function selFunction() {
    if($.trim($('#sel_pri').val()).length > 0){ 
		$('#sel_pri').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		$('#sel_pri').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function amtStkFunction() {
    if($.trim($('#amt_stk').val()).length > 0){ 
		$('#amt_stk').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		$('#amt_stk').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function unitMatFunction() {
    if($.trim($('#unit_mat').val()).length > 0){ 
		$('#unit_mat').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		$('#unit_mat').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function prodDateFunction() {
    if($.trim($('#prod_date').val()).length > 0){ 
		$('#prod_date').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		$('#prod_date').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function expDateFunction() {
    if($.trim($('#exp_date').val()).length > 0){ 
		$('#exp_date').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		$('#exp_date').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function matCodeFunction() {
    if($.trim($('#mat_code').val()).length > 0){ 
		$('#mat_code').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		$('#mat_code').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

/*
function matImgFunction() {
	$('#show_img').html('<img src="" height="70" width="70" alt="Image preview...">');
  	var preview = document.querySelector('img');
  	var file    = document.querySelector('input[type=file]').files[0];
  	var reader  = new FileReader();


  	reader.onloadend = function () {
    	preview.src = reader.result;
  	}

  	if (file) {
    	reader.readAsDataURL(file);
		// check if image or no
		var fileName = $("#mat_img").val();
		if(fileName.lastIndexOf("jpg")===fileName.length-3){
			$('#mat_img').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
		}else if(fileName.lastIndexOf("png")===fileName.length-3){
			$('#mat_img').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
		}else{
			$('#mat_img').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show_img').html('<div class="alert alert-danger col-sm-6"><b>الملف الذي تم اختياره ليس صورة</b></div>');
		}
  	} else {
    	preview.src = "";
  	}
}
*/

$('#add_supplay').click(function(){
	
	var com_id = $.trim($('#com_id').val()).length;
	var com_name = $.trim($('#com_name').val()).length;
	var mat_name = $.trim($('#mat_name').val()).length;
	var mat_desc = $.trim($('#mat_desc').val()).length;
	var pruch_pri = $.trim($('#pruch_pri').val()).length;
	var sel_pri = $.trim($('#sel_pri').val()).length;
	var amt_stk = $.trim($('#amt_stk').val()).length;
	var unit_mat = $.trim($('#unit_mat').val()).length;
	var prod_date = $.trim($('#prod_date').val()).length;
	var exp_date = $.trim($('#exp_date').val()).length;
	var mat_code = $.trim($('#mat_code').val()).length;
	var mat_img = $.trim($('#mat_img').val()).length;
	
	if(com_id == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(com_name == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(mat_name == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(mat_desc == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(pruch_pri == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(sel_pri == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(amt_stk == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(unit_mat == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(prod_date == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(exp_date == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(mat_code == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(mat_img == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	
	if (ch == 0) {
		$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		$('#com_id').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#com_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#mat_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#mat_desc').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#pruch_pri').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#sel_pri').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#amt_stk').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#unit_mat').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#prod_date').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#exp_date').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#mat_code').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		//$('#mat_img').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	}else{
		$('#show').html('');
		if(com_id == 0){
			$('#com_id').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		if(com_name == 0){
			$('#com_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		if(mat_name == 0){
			$('#mat_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		if(mat_desc == 0){
			$('#mat_desc').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		if(pruch_pri == 0){
			$('#pruch_pri').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		if(sel_pri == 0){
			$('#sel_pri').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		if(amt_stk == 0){
			$('#amt_stk').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		if(unit_mat == 0){
			$('#unit_mat').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		if(prod_date == 0){
			$('#prod_date').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		if(exp_date == 0){
			$('#exp_date').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		if(mat_code == 0){
			$('#mat_code').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		/*
		if(mat_img == 0){
			$('#mat_img').css({'background':'#ffdede', 'border':'1px solid #d30000' });
			$('#show').html('<div class="alert alert-danger container"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		}
		*/
		
		//declare func to add form
		checkFrom();
		
	}
	
}); // end on click add

// func to check form
function checkFrom(){
	
	/*
	var fileName = $("#mat_img").val();
	if(fileName.lastIndexOf("jpg")!==fileName.length-3 && fileName.lastIndexOf("png")!==fileName.length-3){
		alert('الملف الذي تم أختياره ليس بصورة');
		return;
	}
	*/
	
	var comName = $('#com_name').val();
	if(comName === '') {
		alert('الرجاء كتابة رمز الشركة بالشكل الصحيح');	
		return;
	}else{
		addForm();
	}
	
}// end check addForm

// function add form 
function addForm(){
	var da_form = $('#add_mat').serialize();
	$.post('includeOP/update_mat_op.php',da_form,function(data){
		//okInsert value is coming from post.add.php if is true insert to db
		data = $.parseJSON( data );
		if(data.msg == 'ok'){
			var dd = {'id':data.id};
			$.ajax({
			 url:'img_up.php',
			 data:dd,
			 type:'GET',
			 success:function(data){
				 if(data != ''){
					 $('#content').children().remove();
					 $('#content').append( "<div id='aja_content'></div>" );
					 $('#aja_content').html(data);
				 }else{
					 //$('.tab-content').load('href');
					$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
				 }
			   }
			 });
			 return false;
			/*
			$('#show').html('<div class="alert alert-info"><b>'+data.id+'</b></div>');
			
			var elements = document.getElementsByTagName("input");
			for (var ii=0; ii < elements.length; ii++) {
			  elements[ii].value = "";
			}
			var te = document.getElementsByTagName("textarea");
			for (var ii=0; ii < te.length; ii++) {
			  te[ii].value = "";
			}
			$('#com_name').css({'background':'' });
			$('#sal_name').css({'background':'' });
			$('#com_mob').css({'background':'' });
			$('#com_email').css({'background':'' });
			$('#com_address').css({'background':'' });
			$('#com_code').css({'background':'' });
			*/
			
			// this for hide image wating load
			//$('#waitingL').hide(1000);
		}else{
			//$('#show').html('<div class="alert alert-danger"><b> لم يتم إدخال الفاتورة <br/> نرجو تحديث الصفحة وإعادة المحاولة</b></div>');
			$('#show').html('<div class="alert alert-danger"><b>'+data.msg+'</b></div>');
		}
	});
}//end finction add 
/*
	
*/
</script>
