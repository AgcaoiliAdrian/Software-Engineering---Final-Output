<?php
ob_start();
require('top.inc.php');
isAdmin();
$categories='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from categories where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories=$row['categories'];
	}else{
		header('location:categories.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories=get_safe_value($con,$_POST['categories']);
	$res=mysqli_query($con,"select * from categories where categories='$categories'");
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
			mysqli_query($con,"update categories set categories='$categories' where id='$id'");
		}else{
			mysqli_query($con,"insert into categories(categories,status) values('$categories','1')");
		}
		header('location:categories.php');
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
					<div class="card-header"><a href="categories.php"><i class="fas fa-arrow-alt-circle-left" style="color:#fff"></i></a><strong> Add Category</strong></div>
					<form method="post">
						<div class="card-body card-block">
						<div class="card border-primary mb-3" style="border-color: blue">
						</div>
						
						<div class="form-group">
								<label for="categories" class=" form-control-label">Categories<a class="text-danger">*</a></label>
								<input type="text" name="categories" placeholder="Enter categories name" class="form-control" required value="<?php echo $categories?>" maxlength="20">
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