
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
<br/>

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
			
                
            
        <table id="item-table" class="table table-bordered" style="margin-top:5px;">
        	<thead>
                <tr>
                    <th class="text-center">Sr.</th>
                    <th class="col-lg-1 text-center">Img</th>
                    <th class="col-lg-2 text-left">Product Name</th>
                    <th class="col-lg-1 text-center">Quantity Stock</th>
                    <th class="col-lg-1 text-center">Unit</th>
                    <th class="col-lg-2 text-center">Purchasing price</th>
                    <th class="col-lg-2 text-center">Selling price</th>
                    <th class="col-lg-1 text-center">Producet date</th>
                    <th class="col-lg-1 text-center">Expire date</th>
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
                <!--'.$items['img'].'
                `i_prush_pri` AS `price_prush`, `i_sel_pri` AS `price_sell`, `i_amt_stk` AS `stock`, `i_unit` AS `unit`, `i_prod_date` AS `product_date`, `i_prod_exp` AS `expire_date`, `i_code` AS `code` 
                -->
                 
			<tr>
				<td id="sr_no" class="text-center"><?php echo $sr_no; ?> </td>
                <td>
                	<img src="http://localhost/medMar/upload/<?php echo $items['img']; ?>" title="<?php echo $items['img']; ?>" width="150" />
                </td>
                <td class="text-left" id="abd">
                	<?php echo $items['name']; ?>
                </td>
                <td class="text-center">
                	<?php echo $items['stock']; ?>
                </td>
                <td class="text-center">
                	<?php echo $items['unit']; ?>
                </td>
                <td class="text-center">
                	<?php echo $items['price_prush']; ?>
                </td>
                <td class="text-center">
                	<?php echo $items['price_sell']; ?>
                </td>
                <td class="text-center">
                	<?php echo $items['product_date']; ?>
                </td>
                <td class="text-center">
                	<?php echo $items['expire_date']; ?>
                </td>
                <td class="text-center">
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
    
    <tr>
		
        <td align="right" class="col-lg-10"><b class="pull-left">الإجمالي الصافي</b></td>
        <td align="center" class="col-lg-2" style="background:#f5f5f5;">
        	<b>12000000000</b>
        </td>
    </tr>
    
    <tr>
        <td colspan="2" align="center">
            <b>رقم الفاتورة: </b><br /><span>2323</span>
            <br />
            <b>الشروط والأحكام: </b><br /><span>lblblblblblblblblblblblblblblblblb</span>
        </td>
    </tr>
</table>


<script>
$(document).ready(function(e) {
	var table = $('#item-table').dataTable({
		"pageLength":12
		//,searching: false
	});
	
	$('#searchBox').keyup(function() {
		table.fnFilter(this.value);
	});  
	
	$(document).on('click','#item-table',function(){
		alert('dd');	
	});  
});

</script>
