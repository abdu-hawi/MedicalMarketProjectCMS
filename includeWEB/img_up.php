<?php

$img_id;

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(isset($_GET['id'])){
		$img_id = $_GET['id'];
	}else{ // else of if $_get
		die('Please retry insert item');
	}// end else of if $_get
}else{ // else of if $_server
	die('Please retry insert item');
}// end else of if $_server
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>إضافة صور المادة</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
<script src="bootstrap/jquery.min.js"></script>
</head>

<body>
<h1>Image Upload</h1>
<hr><br/>
<form id="uploadimage" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
	<div id="message">
    </div>
    <div id="selectImage" class="form-group">
        <label class="control-label col-sm-2">Select Your Image</label>
        <div class="col-sm-10 col-lg-3">
            <input type="file" class="form-control" name="file" id="file" required />
            <div id="image_preview">
            	<img id="previewing" src="noimage.png" />
            </div>
        </div>
    </div>
    <input type="text" value="<?php echo $img_id; ?>" id="itemId" name="itemID" hidden />
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
      	<input type="submit" value="Upload" class="submit btn btn-success " />
      </div>
    </div>
    
</form>
</body>
</html>
<script>
$(document).ready(function (e) {
	$('#image_preview').hide();
	$("#uploadimage").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
			url: "includeOP/up_img_file.php", // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds okUpdate
			{
				data = $.parseJSON( data );
				if(data.msg == 'ok'){
					$('#message').html('<div class="alert alert-success"><b>Item is Adding</b></div>');
				}else if(data.msg == 'okUpdate'){
					$('#message').html('<div class="alert alert-success"><b>Item is Updating</b></div>');
				}else{
					$('#message').html('<div class="alert alert-danger"><b>'+data.msg+'</b></div>');
				}
			}
		});
	}));
	
	// func to upload to server
	function upImg(){
		
	}
	
	// Function to preview image after validation
	$(function() {
		$("#file").change(function() {
			//// Firest work: when img choise
			$("#message").empty(); // To remove the previous error message
			var file = this.files[0];
			var imagefile = file.type;
			var match= ["image/jpeg","image/png","image/jpg"];
			
			//Second work: to check if image or not
			
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
			{
				$('#image_preview').show();
				//$('#previewing').attr('src','noimage.png');
				$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
				return false;
			}
			else
			{
				var reader = new FileReader();
				reader.onload = imageIsLoaded;
				reader.readAsDataURL(this.files[0]);
			}
		});
	});
	function imageIsLoaded(e) {
		// Third work: to load img in page
		$("#file").css("color","green");
		$('#image_preview').css("display", "block");
		$('#previewing').attr('src', e.target.result);
		$('#previewing').attr('width', '250px');
		$('#previewing').attr('height', '230px');
	};
});

</script>
