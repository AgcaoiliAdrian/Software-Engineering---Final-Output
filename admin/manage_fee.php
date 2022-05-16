<?php
ob_start();
require('top.inc.php');
isAdmin();
$delivery='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from delivery where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$delivery=$row['delivery'];
	}else{
		header('location:fee.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$delivery=get_safe_value($con,$_POST['delivery']);
	$res=mysqli_query($con,"select * from delivery where delivery='$delivery'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Categories already exist";
			}
		}else{
			$msg="Categories already exist";
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($con,"update delivery set delivery='$delivery' where id='$id'");
		}else{
			mysqli_query($con,"insert into delivery(delivery) values('$delivery')");
		}
		header('location:fee.php');
		die();
	}
}
ob_end_flush();
?>
<div class="content pb-0">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header"><a href="categories.php"><i class="fas fa-arrow-alt-circle-left" style="color:#fff"></i></a><strong style="color: #fff"> Update Delivery Fee</strong></div>
					<form method="post">
						<div class="card-body card-block">
						<div class="card border-primary mb-3" style="border-color: blue">
						</div>
						
						<div class="form-group">
								<label for="categories" class=" form-control-label">Delivery Fee<a class="text-danger">*</a></label>
								<input type="text" name="delivery" placeholder="Enter categories name" class="form-control" required value="<?php echo $delivery?>" maxlength="20">
							</div>
						<button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
						<span id="payment-button-amount">Submit</span>
						</button>
						<div class="field_error"><?php echo $msg?></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>