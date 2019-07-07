<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>إضافة مورد</title>
<link rel="stylesheet" type="text/css" href="include/css/bootstrap.min.css">
<script src="include/js/jquery-3.2.1.min.js"></script>
</head>

<body>
<h2>Add Supply</h2>
<div id="show" align="center"></div>
  <form class="form-horizontal med_sup" id="add_sup" method="post">
  
    <div class="form-group">
      <label class="control-label col-sm-2" for="company">Copmany Name:</label>
      <div class="col-sm-10 col-lg-6">
        <input type="text" class="form-control" id="com_name" placeholder="Write Company Name" name="company" 
        	oninput="nameFunction()">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="sales">Sales Name:</label>
      <div class="col-sm-10 col-lg-5">
        <input type="text" class="form-control" id="sal_name" placeholder="Write Sales Name" name="sales"
        	oninput="salFunction()">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="mobile">Mobile Number:</label>
      <div class="col-sm-10 col-lg-4">
        <input  type="tel" class="form-control" id="com_mob" placeholder="05X XXX XXXX" name="mobile"
        	oninput="mobFunction()">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="phone">Phone Number:</label>
      <div class="col-sm-10 col-lg-4">
        <input  type="tel" class="form-control" id="com_phon" placeholder="01X XXX XXXX" name="phone">
      </div>
      <label class="control-label col-sm-2" for="ext">Ext Number:</label>
      <div class="col-sm-10 col-lg-4">
        <input  type="tel" class="form-control" id="sal_ext" placeholder="Write Extension" name="ext">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10 col-lg-4">
        <input type="email" class="form-control" id="com_email" placeholder="Write Email of Company" name="email"
        	oninput="emailFunction()">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="address">Address:</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="com_address" placeholder="Write Address of Company" name="address"
         	oninput="addressFunction()"></textarea>
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="code">Company Code:</label>
      <div class="col-sm-10 col-lg-3">
        <input  type="text" class="form-control" id="com_code" placeholder="Write Code of Company" name="code"
        	oninput="codeFunction()">
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="button" class="btn btn-success add_supplay" id="add_supplay" name="add_supplay">Add Supplay</button>
      </div>
    </div>
  </form>



</body>
</html>

<script>
//$('#show').html('<div class="alert alert-danger"><b>رقم العميل غير صحيح, نرجو إعادة إدخال رقم العميل </b></div>');
//$('#com_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });

var ch = 0;

function nameFunction() {
    if($.trim($('#com_name').val()).length > 0){ 
		$('#com_name').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		 $('#com_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function salFunction() {
    if($.trim($('#sal_name').val()).length > 0){ 
		$('#sal_name').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		 $('#sal_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function addressFunction() {
    if($.trim($('#com_address').val()).length > 0){ 
		$('#com_address').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		 $('#com_address').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function mobFunction() {
    if($.trim($('#com_mob').val()).length > 0){ 
		$('#com_mob').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		 $('#com_mob').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function emailFunction() {
    if($.trim($('#com_email').val()).length > 0){ 
		$('#com_email').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		 $('#com_email').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

function codeFunction() {
    if($.trim($('#com_code').val()).length > 0){ 
		$('#com_code').css({'background':'#D6FFD4', 'border':'1px solid #417849' });
	 }else{
		 $('#com_code').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	 }
}

$('#add_supplay').click(function(){
	
	var com_name = $.trim($('#com_name').val()).length;
	var sales_name = $.trim($('#sal_name').val()).length;
	var com_mob = $.trim($('#com_mob').val()).length;
	var com_email = $.trim($('#com_email').val()).length;
	var com_add = $.trim($('#com_address').val()).length;
	var com_code = $.trim($('#com_code').val()).length;
	
	
	if(com_name == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(sales_name == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(com_mob == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(com_email == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(com_add == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	if(com_code == 0){ ch = ch + 0; }else{ ch = ch + 1;}
	
	if (ch == 0) {
		$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		$('#com_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#sal_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#com_mob').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#com_email').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#com_address').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#com_code').css({'background':'#ffdede', 'border':'1px solid #d30000' });
	}else{
		$('#show').html('');
		checkInput();
	}
	
}); // end on click add

function checkInput(){
	if($.trim($('#com_name').val()).length == 0){ 
		$('#com_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		return;
	}
	
	if($.trim($('#sal_name').val()).length == 0){ 
		$('#sal_name').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		return;
	}
	
	if($.trim($('#com_mob').val()).length == 0){ 
		$('#com_mob').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		return;
	}
	
	if($.trim($('#com_email').val()).length == 0){ 
		$('#com_email').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		return;
	}
	
	if($.trim($('#com_address').val()).length == 0){ 
		$('#com_address').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		return;
	}
	
	if($.trim($('#com_code').val()).length == 0){ 
		$('#com_code').css({'background':'#ffdede', 'border':'1px solid #d30000' });
		$('#show').html('<div class="alert alert-danger"><b>الرجاء إدخال الحقول المطلوبة</b></div>');
		return;
	}
	
	if($.trim($('#com_phon').val()).length == 0){ 
		$('#com_phon').val(0);
	}
  
	if($.trim($('#sal_ext').val()).length == 0){ 
		$('#sal_ext').val(0);
	}
	 addSupplier();
}// End func checkInput()

function addSupplier(){
	var da_form = $('#add_sup').serialize();
	$.post('add_sup_op.php',da_form,function(data){
		//okInsert value is coming from post.add.php if is true insert to db
		if(data == 'okInsert'){
			$('#show').html('<div class="alert alert-info"><b>تمت إضافة الموزع بنجاح</b></div>');
			
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
			// this for hide image wating load
			//$('#waitingL').hide(1000);
		}else{
			$('#show').html('<div class="alert alert-danger"><b> لم يتم إضافة المورد <br/> نرجو المحاولة</b></div>');
		}
	});
}

</script>
