<?php
require('top.inc.php');
isAdmin();
$order_id=get_safe_value($con,$_GET['id']);
$coupon_details=mysqli_fetch_assoc(mysqli_query($con,"select coupon_value,coupon_code from `order` where id='$order_id'"));
$coupon_value=$coupon_details['coupon_value'];
$coupon_code=$coupon_details['coupon_code'];
if(isset($_POST['update_order_status'])){
	$update_order_status=$_POST['update_order_status'];
	
	$update_sql='';
	
	if($update_order_status==5){
		mysqli_query($con,"update `order` set order_status='$update_order_status',payment_status='Success' where id='$order_id'");
	}else{
		mysqli_query($con,"update `order` set order_status='$update_order_status' $update_sql where id='$order_id'");
	}
	
	if($update_order_status==3){
		mysqli_query($con,"update `order` set order_status='$update_order_status' $update_sql where id='$order_id'");
	}
	
}

?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><a href="order_main.php"><i class="fas fa-arrow-alt-circle-left" style="color:#fff"></i></a><strong style="color:#fff"> Update Order</strong></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">

				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table">
								<thead>
									<tr>
										<th class="product-thumbnail">Product Name</th>
										<th class="product-thumbnail">Product Image</th>
										<th class="product-name">Quantity</th>
										<th class="product-price">Price</th>
										<th class="product-price">Total Price</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$res=mysqli_query($con,"select distinct(order_detail.id) ,order_detail.*,product.name,product.image,`order`.address,`order`.city,`order`.pincode from order_detail,product ,`order` where order_detail.order_id='$order_id' and  order_detail.product_id=product.id GROUP by order_detail.id");
									$total_price=0;
									while($row=mysqli_fetch_assoc($res)){
									$delivery=$row['fee'];
									$userInfo=mysqli_fetch_assoc(mysqli_query($con,"select * from `order` where id='$order_id'"));
									$address=$userInfo['address'];
									$city=$userInfo['city'];
									$pincode=$userInfo['pincode'];
									$shipping=50;
									$total_price=$total_price+($row['qty']*$row['price']);
									$total_pay=$total_price+$row['fee'];
									?>
									<tr>
										<td class="product-name"><?php echo $row['name']?></td>
										<td class="product-name"> <img src="<?php echo "../product/".$row['image']?>"></td>
										<td class="product-name"><?php echo $row['qty']?></td>
										<td class="product-name"><span>&#8369 </span><?php echo $row['price']?></td>
										<td class="product-name"><span>&#8369 </span><?php echo $row['qty']*$row['price']?></td>
										
									</tr>
									<?php } 
									if($coupon_value!=''){
									?>
									<!-- <tr>
										<td colspan="3"></td>
										<td class="product-name">Shipping Fee</td>
										<td class="product-name">
										<?php 
										echo $shipping;
										?></td>
										
									</tr> -->
									<?php } ?>
									<tr>
										<td colspan="3"></td>
										<td class="product-name">Delivery Fee</td>
										<td class="product-name"><span>&#8369 </span><?php 
												echo $delivery
												?></td>
										
									</tr>
									<tr>
										<td colspan="3"></td>
										<td class="product-name">Total Payment</td>
										<td class="product-name"><span>&#8369 </span><?php 
												echo $total_pay
												?></td>
										
									</tr>
								</tbody>
							
						</table>
						<div id="address_details">
							<strong>Address</strong>
							<?php echo $address?>, <?php echo $city?>, <?php echo $pincode?><br/><br/>
							<strong>Order Status</strong>
							<?php 
							$order_status_arr=mysqli_fetch_assoc(mysqli_query($con,"select order_status.name,order_status.id as order_status from order_status,`order` where `order`.id='$order_id' and `order`.order_status=order_status.id"));
							echo $order_status_arr['name'];
							?>
							
							<div>
								<form method="post">
									<select class="form-control" name="update_order_status" id="update_order_status" required onchange="select_status()">
										<option value="">Select Status</option>
										<?php
										$res=mysqli_query($con,"select * from order_status");
										while($row=mysqli_fetch_assoc($res)){
											echo "<option value=".$row['id'].">".$row['name']."</option>";
										}
										?>
									</select>
									<input type="submit" id="sub" class="form-control" style="background-color: #17a2b8">
								</form>
							</div>
						</div>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<script>
function select_status(){
	var update_order_status=jQuery('#update_order_status').val();
	if(update_order_status==3){
		jQuery('#shipped_box').show();
	}
}
</script>