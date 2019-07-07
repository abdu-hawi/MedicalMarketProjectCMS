<?php
if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    if( isset($_POST['id']) ){
        
        require_once '../../includeDB/SupplaierAPI.php';
        
		$iId = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['id']))));
        
        $db = selAllSupplyDetail($iId);
        if($db){
            $json = json_decode($db,true);
			foreach($json as $supplay) {
?>
<style>
  .back-inv{
		font-weight:bold;
	}
	.dataTables_filter, .dataTables_info { display: none; }
</style>
<table class="table table-bordered">
	
    <!-- START TR -->
    
    <tr>
        <td colspan="2" align="center">
        
            <div>
                <b>Company Name: </b><span> <?php echo $supplay['c_name']; ?></span>
             </div>
             <div>
                <b>Sales Name: </b><span> <?php echo $supplay['s_name']; ?></span>
             </div>
             <div>
                <b>Sales Mobile: </b><span> <?php echo $supplay['s_mobile']; ?></span>
             </div>
             <div>
                <b>Company Phone: </b><span> <?php echo $supplay['c_phone']; ?> </span>
                <b>Ext.: </b><span> <?php echo $supplay['s_ext']; ?> </span>
             </div>
             <div>
                <b>Sales Email: </b><span> <?php echo $supplay['s_email']; ?></span>
             </div>
             <div>
                <b>Company Address: </b><span> <?php echo $supplay['c_address']; ?></span>
             </div>
             <div>
                <b>Company Code: </b><span> <?php echo $supplay['c_code']; ?></span>
             </div>
		</td>	
      <tr>
        <td colspan="2" align="center">      
<table id="fav-table" class="table table-hover table-bordered">
<thead>
    <tr>
        <th class="text-center">Sr.</th>
        <th class="col-lg-1 text-center">Img</th>
        <th class="col-lg-2 text-left">Product Name</th>
        <th class="col-lg-1 text-center">Quantity Stock</th>
        <th class="col-lg-1 text-center">Unit</th>
        <th class="col-lg-1 text-center">Purchasing price</th>
        <th class="col-lg-1 text-center">Selling price</th>
        <th class="col-lg-2 text-center">Producet date</th>
        <th class="col-lg-2 text-center">Expire date</th>
        <th class="col-lg-1 text-center">Code</th>
    </tr>
</thead>
  
<?php 

$sr_no = 0;
require_once '../../includeDB/ItemsAPI.php';
$db_items = selAllItems($iId);
if($db_items){
	$json = json_decode($db_items, true);
	foreach($json as $items) {
	$sr_no = $sr_no +1 ;

?>
  <tr>
				<td id="sr_no" class="text-center parent"><?php echo $sr_no; ?> </td>
                <td>
                	<img src="http://localhost/medMar/upload/<?php echo $items['img']; ?>" title="<?php echo $items['img']; ?>" width="100" height="100" />
                </td>
                <td class="text-left parent" id="abd">
                	<?php echo $items['name']; ?>
                </td>
                <td class="text-center parent">
                	<?php echo $items['stock']; ?>
                </td>
                <td class="text-center parent">
                	<?php echo $items['unit']; ?>
                </td>
                <td class="text-center parent">
                	<?php echo $items['price_prush']; ?>
                </td>
                <td class="text-center parent">
                	<?php echo $items['price_sell']; ?>
                </td>
                <td class="text-center parent">
                	<?php echo $items['product_date']; ?>
                </td>
                <td class="text-center parent">
                	<?php echo $items['expire_date']; ?>
                </td>
                <td class="text-center parent">
                	<?php echo $items['code']; ?>
                </td>
            </tr>
<?php

				} // END foreach $items
				} // END if statment select
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
</table>
        </td>
    </tr>
    
    <!-- END TR -->
</table>
	
<script>


  var table = $('#fav-table').dataTable({
			//"pageLength":12
			//,searching: false
		});
		
		$('#searchBox').keyup(function() {
		   table.fnFilter(this.value);
		});
    
// This code for open invoice detail on click row
$(document).on('click','.parent',function(){
    var id_ord = $(this).attr("id");
    $.ajax({
        url:'includeDetail/list_detail.php',
        type:'POST',
        data:'id='+id_ord,
        success:function(data){
            if(data != ''){
                $(".nav-in li.active").removeClass("active");
                $('.tab-content').children().remove();
                 $('.tab-content').append( "<div id='aja_content'></div>" );
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
