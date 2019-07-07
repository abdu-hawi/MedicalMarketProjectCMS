<?php

require_once '../includeDB/SupplaierAPI.php';

$db = selAllSupply();
$json = json_decode($db,true);

?>
<style>
  .back-inv{
		font-weight:bold;
	}
	.dataTables_filter, .dataTables_info { display: none; }
</style>
<table id="fav-table" class="table table-hover">
<thead>
    <tr>
        <th style="text-align:-webkit-left;">Company Name</th>
        <th style="text-align:-webkit-center;">Sales Name</th>
        <th style="text-align:-webkit-center;">Sales Mobile</th>
        <th style="text-align:-webkit-center;">Sales Email</th>
        <th style="text-align:-webkit-center;">Code</th>
    </tr>
</thead>
  
<?php 

foreach($json as $item) {

?>
  <tr>
    <td class="col-lg-3 parent" id="<?php echo $item['c_id']; ?>">
    	<?php echo $item['c_name']; ?>
    </td>
    <td class="col-lg-3 parent" id="<?php echo $item['c_id']; ?>" style="text-align:-webkit-center;">
    	<?php echo $item['s_name']; ?>
    </td>
    <td class="col-lg-2 parent" id="<?php echo $item['c_id']; ?>" style="text-align:-webkit-center;">
        <?php echo "(+966) ".$item['s_mobile']; ?>
    </td>
    <td  class="col-lg-1 parent" id="<?php echo $item['c_id']; ?>" style="text-align:-webkit-center;">
       <?php echo $item['c_email']; ?>
    </td>
    <td class="col-lg-1 parent" id="<?php echo $item['c_id']; ?>" style="text-align:-webkit-center;">
      	<?php echo $item['c_code']; ?>
    </td>
  </tr>
<?php
}
?>
</table>
	
<script>


  var table = $('#fav-table').dataTable({
			"pageLength":12
			//,searching: false
		});
		
		$('#searchBox').keyup(function() {
		   table.fnFilter(this.value);
		});
    
// This code for open invoice detail on click row
$(document).on('click','.parent',function(){
    var id_ord = $(this).attr("id");
    $.ajax({
        url:'includeOP/supplay_items_list.php',
        type:'POST',
        data:'id='+id_ord,
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
// End invice Detail

	
</script>
