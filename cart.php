<?php 
require('top.php');
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
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($_SESSION['cart'])){
                                    foreach($_SESSION['cart'] as $key=>$val){
                                    $productArr=get_product($con,'','',$key);
                                    $pname=$productArr[0]['name'];											
                                    $price=$productArr[0]['price'];
                                    $image=$productArr[0]['image'];
                                    $qty=$val['qty'];
                                    ?>
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img src="<?php echo "./product/".$image?>"  /></a></td>
                                        <td class="product-name"><a href="#"><?php echo $pname?></a>
                                            <ul  class="pro__prize">
                                            </ul>
                                        </td>
                                        <td class="product-price"><span class="amount" id="price"><p>&#8369</p> <?php echo $price?></span></td>
                                        <td class="product-quantity"><input type="number" min="0" id="<?php echo $key?>qty" value="<?php echo $qty?>" />
                                        <br/><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')">update</a>
                                        </td>
                                        <td class="product-subtotal"><span class="amount"><p>&#8369</p> <?php echo $qty*$price?></td>
                                        <td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="icon-trash icons"></i></a></td>
                                    </tr>
                                    <?php } } ?>
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
                                    <a href="checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>     
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