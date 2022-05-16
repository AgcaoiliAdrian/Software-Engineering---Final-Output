<?php
require('top.inc.php');

$condition='';
$condition1='';

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';		
		}
		$update_status_sql="update product set status='$status' $condition1 where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from product where id='$id' $condition1";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select product.*,categories.categories from product,categories where product.categories_id=categories.id $condition order by product.id desc";
$res=mysqli_query($con,$sql);
?>

<div class="content pb-0">
	<div class="orders">
	   <div class="container">
			 <div class="card">
				<div class="card-header">
					<nav class="navbar-light">
						<div class="container-xl" style="color:#fff";>
							Products
							<a type="button" class="btn btn-primary float-right" href="manage_product.php">Add Product</a>
							<input id="myInput" type="text" placeholder="Search..">
						</div>
					</nav>
				</div>

				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table " id="">
						 <thead>
							<tr>
							   <th class="serial">ID</th>
							   <th>Categories</th>
							   <th>Name</th>
							   <th>Image</th>
							   <th>Price</th>
							   <th>Status</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody id="myTable">
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $row['id']?></td>
							   <td><?php echo $row['categories']?></td>
							   <td><?php echo $row['name']?></td>
							   <td><img src="<?php echo "../product/".$row['image']?>"/></td>
							   <td><?php echo $row['price']?></td>
							   <td><?php 
							   if($row['status']==1){
								echo 'Active';
							   }else{
								echo 'Inactive';
								}
							   ?></td>
							   
							   <td>
								<?php
								if($row['status']==1){
									echo "<span class='badge badge-complete'><a <a onClick=\"javascript: return confirm('Do you want to proceed?');\" href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
								}else{
									echo "<span class='badge badge-pending'><a <a onClick=\"javascript: return confirm('Do you want to proceed?');\" href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
								}
								echo "<span class='badge badge-edit'><a href='manage_product.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a onClick=\"javascript: return confirm('Are you sure you want to delete this data?');\" href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
								?>
							   </td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
	   </div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>