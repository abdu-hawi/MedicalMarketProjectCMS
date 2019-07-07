<?php
/*
require_once('../include_db/session.php');
require_once('../include_db/db.php');
if(!isset($_POST['id']) && ($_SESSION['userinfo'] == false || $_SESSION['cominfo'] == false ) ) return false;
$order_no = intval($_POST['id']);
$tf_handle->query("UPDATE `tbl_order_system` SET `isRead` = 0 WHERE `order_id` = '$order_no'");
$stmt = $tf_handle->query("SELECT * FROM `invoice` WHERE `order_id` = '$order_no'");
if(!$stmt){
	header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
	die;
}
while($row = mysqli_fetch_assoc($stmt)){
*/	
?>
<br/>

<table class="table table-bordered">
	<tr>             
        <td colspan="2" align="center">
            <h2 style="margin-top:5.5px">
                Company Name
            </h2>
            <h2 style="margin-top:30.5px">
                Branch Name
            </h2>
            <h3 style="margin-top:10.5px">
                Date Invoice
            </h3>
        </td>
    </tr>
    <!-- START TR -->
    
    <tr>
        <td colspan="2" align="center">
        
            <div>
                <b>رقم الشركة/العميل: </b><span> 0101010</span>
             </div>
			<?php
			/*
				$user_cus = $row["user_id"];
				$stmt_cus = $tf_handle->query("SELECT `user_name` FROM `users` WHERE `user_id` = '$user_cus'");
				$user = mysqli_fetch_assoc($stmt_cus);
				*/
			?>
			
            <div>
                <b>إسم الشركة/العميل: </b><span>User Name</span>
                
            </div>
                
            
        <table id="invoice-item-table" class="table table-bordered" style="margin-top:5px;">
            <tr>
                <th class="text-center">تسلسل</th>
                <th class="col-lg-7 text-right">إسم المنتج</th>
                <th class="col-lg-1 text-center">الكمية</th>
                <th class="col-lg-2 text-center">السعر</th>
                <th class="col-lg-2 text-center">الاجمالي</th>
            </tr>
            <tr>
				<?php
				/*
				$stmt_ord = $tf_handle->query("SELECT * FROM `tbl_order_system_item` WHERE `order_id` = '$order_no'");
				$sr_no = 0;
				if(!$stmt_ord) die('done');
				while($row_item = mysqli_fetch_assoc($stmt_ord) ){
					$sr_no = $sr_no +1 ;
					*/
				?>
                <td id="sr_no" class="text-center">01</td>
                <td>
                	prod name
                </td>
                <td class="text-center">
                	qty
                </td>
                <td class="text-center">
                	price
                </td>
                <td class="text-center">
                	total
                </td>
            </tr>
				
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


