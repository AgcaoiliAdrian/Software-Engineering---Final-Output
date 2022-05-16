<?php
require('connection.inc.php');
require('functions.inc.php');
// $order_id=['id'];
mysqli_query($con,"update `order` set order_status='4'");	

?>
<script>
	window.location.href='my_order.php';
</script>