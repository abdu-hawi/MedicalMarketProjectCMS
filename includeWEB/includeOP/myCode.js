$(document).ready(function(e) {
	$.ajax({
	 url:'add_supply.php',
	 type:'POST',
	 success:function(data){
		 if(data != ''){
			 $('#mm_content').children().remove();
			 $('#mm_content').append( "<div id='aja_content'></div>" );
			 $('#aja_content').html(data);
		 }else{
			 $('.tab-content').load('href');
		 }
	   }
	 });
	/*	 
	function hideSearch(){
		$('#searchDiv').hide();	
	}
	function showSearch(){
		$('#searchDiv').show();
	}
	*/
	$('#add_supply').on('click',function(){
		$('.nav li.active').removeClass('active');
		$(this).addClass('active');
		$.ajax({
		 url:'add_supply.php',
		 type:'POST',
		 success:function(data){
			 if(data != ''){
				 $('#mm_content').children().remove();
				 $('#mm_content').append( "<div id='aja_content'></div>" );
				 $('#aja_content').html(data);
			 }else{
				 $('.tab-content').load('href');
			 }
		   }
		 });
		 return false;
	});
	
    $('#add_item').on('click',function(){
		$('.nav li.active').removeClass('active');
		$(this).addClass('active');
		$.ajax({
		 url:'add_mat.php',
		 type:'POST',
		 success:function(data){
			 if(data != ''){
				 $('#mm_content').children().remove();
				 $('#mm_content').append( "<div id='aja_content'></div>" );
				 $('#aja_content').html(data);
			 }else{
				 $('.tab-content').load('href');
			 }
		   }
		 });
		 return false;
	});
	
	$('#supply_list').on('click',function(){
		$('.nav li.active').removeClass('active');
		$(this).addClass('active');
		$.ajax({
		 url:'supply_list.php',
		 type:'POST',
		 success:function(data){
			 if(data != ''){
				 $('#mm_content').children().remove();
				 $('#mm_content').append( "<div id='aja_content'></div>" );
				 $('#aja_content').html(data);
			 }else{
				 $('.tab-content').load('href');
			 }
		   }
		 });
		 return false;
	});
	$('#item').on('click',function(){
		$('.nav li.active').removeClass('active');
		$(this).addClass('active');
		$('#content').html("<div id='aja_content'>menu3</div>");
	});
});