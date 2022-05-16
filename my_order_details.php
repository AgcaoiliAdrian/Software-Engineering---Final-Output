<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$order_id=get_safe_value($con,$_GET['id']);

// $coupon_details=mysqli_fetch_assoc(mysqli_query($con,"select coupon_value from `order` where id='$order_id'"));
// $coupon_value=$coupon_details['coupon_value'];

$sql="select * from delivery";
$res=mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($res)){
$delivery=$row['delivery'];
}
?>
        <!-- cart-main-area start -->
        <div class="wishlist-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Product Name</th>
												<th class="product-thumbnail">Product Image</th>
                                                <th class="product-name">Qty</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-price">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$uid=$_SESSION['USER_ID'];
											$res=mysqli_query($con,"select distinct(order_detail.id) ,order_detail.*,product.name,product.image from order_detail,product ,`order` where order_detail.order_id='$order_id' and `order`.user_id='$uid' and order_detail.product_id=product.id");
                                            $shipping=50;
                                            $total_pay=0;
											$total_price=0;
											while($row=mysqli_fetch_assoc($res)){
											$total_price=$total_price+($row['qty']*$row['price']);
                                            $total_pay=$total_price+$row['fee'];
											?>
                                            <tr>
												<td class="product-name"><?php echo $row['name']?></td>
                                                <td class="product-name"> <img src="<?php echo "./product/".$row['image']?>"></td>
												<td class="product-name"><?php echo $row['qty']?></td>
												<td class="product-name"><span>&#8369 </span><?php echo $row['price']?></td>
												<td class="product-name"><span>&#8369 </span><?php echo $row['qty']*$row['price']?></td>
                                            </tr>
                                            <?php } 									
											?>
                                            <tr>
												<td colspan="3"></td>
												<td class="product-name">Delivery Fee</td>
												<td class="product-name"><span>&#8369 </span><?php echo $delivery ?></td>         
                                            </tr>
											<tr>
												<td colspan="3"></td>
												<td class="product-name">Total Payment</td>
												<td class="product-name"><span>&#8369 </span><?php echo $total_pay ?></td>         
                                            </tr>
                                        </tbody>
                                        
                                    </table>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>