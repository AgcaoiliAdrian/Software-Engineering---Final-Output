<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$uid=$_SESSION['USER_ID'];

$res=mysqli_query($con,"select product.name,product.image,product.price,product.id as pid,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid'");
?>
<!-- cart-main-area start -->
<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">               
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">name of products</th>
                                    <th class="product-name">Remove</th>
                                    <th class="product-name"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($row=mysqli_fetch_assoc($res)){
                                ?>
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img src="<?php echo "./product/".$row['image']?>"  /></a></td>
                                        <td class="product-name"><a href="#"><?php echo $row['name']?></a>
                                            <ul  class="pro__prize">
                                            <span>&#8369</span>
                                                <li><?php echo $row['price']?></li>
                                            </ul>
                                        </td>
                                        
                                        <td class="product-remove"><a href="wishlist.php?wishlist_id=<?php echo $row['id']?>"><i class="icon-trash icons"></i></a></td>
                                        <td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $row['pid']?>','add')">Add to Cart</a></td>
                                    </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="<?php echo SITE_PATH?>">Continue Shopping</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    <a href="<?php echo SITE_PATH?>checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
        
<input type="hidden" id="qty" value="1"/>
<script src="js/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap framework js -->
<script src="js/bootstrap.min.js"></script>
<!-- All js plugins included in this file. -->
<script src="js/plugins.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<!-- Waypoints.min.js. -->
<script src="js/waypoints.min.js"></script>
<!-- Main js file that contents all jQuery plugins activation. -->
<script src="js/main.js"></script>
<script src="js/custom.js"></script>					     