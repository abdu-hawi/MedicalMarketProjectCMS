<?php
if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    if( isset($_POST['idItem']) ){
        
        require_once '../../includeDB/ItemsAPI.php';
        
		$iId = intval(mysqli_real_escape_string($mm_handle,strip_tags(trim($_POST['idItem']))));
        
        $db = selItem($iId);
        if($db){
            $json = json_decode($db,true);
			foreach($json as $items) {
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
        	<div style="margin: 0 50px;">
            	<div class="pull-right">
                    <input type="button" class="btn btn-block btn-primary btn_update" value="UPDATE" id="<?php echo $items['id']; ?>" />
                </div>
                <div class="pull-left">
                    <input type="button" class="btn btn-block btn-danger btn_delete" value="DELETE" id="<?php echo $items['id']; ?>" />
                </div>
            </div><br/><br/>
            <div class="text-center">
                <img src="http://localhost/medMar/upload/<?php echo $items['img']; ?>" title="<?php echo $items['img']; ?>" width="200" height="200" />
            </div>
            <br/>
        <tr>
        <td>
            <div class="col-lg-6 text-left">
            	<b>Product Name: </b><span><?php echo $items['name']; ?></span>
            </div>
            <div class="col-lg-6 text-left">
            	<b>Purchasing Price: </b><span><?php echo $items['price_prush']; ?></span>
            </div>
		</td>
        </tr>
        <tr>
        <td>
            <div class="col-lg-6 text-left">
            	<b>Product Code: </b><span><?php echo $items['code']; ?></span>
            </div>
            <div class="col-lg-6 text-left">
            	<b>Selling Price: </b><span><?php echo $items['price_sell']; ?></span>
            </div>
        </td>
		</tr>
        <tr>
        <td>
            <div class="col-lg-6 text-left">
            	<b>Quantity in Stock: </b><span><?php echo $items['stock']; ?></span>
            </div>
            <div class="col-lg-6 text-left">
            	<b>Product Date: </b><span><?php echo $items['product_date']; ?></span>
            </div>
        </td>
		</tr>
        <tr>
        <td>
            <div class="col-lg-6 text-left">
            	<b>Unit: </b><span><?php echo $items['unit']; ?></span>
            </div>
            <div class="col-lg-6 text-left">
            	<b>Expire Date: </b><span><?php echo $items['expire_date']; ?></span>
            </div>
        </td>
		</tr>	
      
      <?php
	  $db = selItemDetail($iId);
        if($db){
            $json = json_decode($db,true);
			foreach($json as $detail) {
	  ?>
      <td>
      <table id="fav-table" class="table">
      	<tr>
          <td>
          		<b>Details:</b>
          </td>
          <td>
          		<?php echo $detail['itemDescription']; ?>
          </td>
          </tr>
          </table>
          </td>
	  </tr>

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
</table>
        </td>
    </tr>
    
    <!-- END TR -->
</table>
	
<script>
    
// This code for open invoice detail on click row
$(document).on('click','.btn_update',function(){
    var id_ord = $(this).attr("id");
    $.ajax({
        url:'update_mat.php',
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
