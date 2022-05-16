<?php
require('top.inc.php');
isAdmin();
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
		$update_status_sql="update coupon_master set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from coupon_master where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select * from coupon_master order by id desc";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="container">
			 <div class="card">
				<div class="card-header">
					<nav class="navbar-light">
						<div class="container-xl" style="color:#fff";>
							<!-- <a class="navbar-brand" href="#">Products</a> -->Coupons
							<input id="myInput" type="text" placeholder="Search..">
							<a type="button" class="btn btn-primary float-right" href="manage_coupon_master.php">Add Coupon</a>
						</div>
					</nav>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th width="15%">Coupon Code</th>
							   <th width="15%">Coupon Value</th>
							   <th width="15%">Coupon Type</th>
							   <th width="15%">Min Value</th>
							   <th>Status</th>
							   <th width="26%"></th>
							</tr>
						 </thead>
						 <tbody id="myTable">
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i++?></td>
							   <td><?php echo $row['coupon_code']?></td>
							   <td><?php echo $row['coupon_value']?></td>
							   <td><?php echo $row['coupon_type']?></td>
							   <td><?php echo $row['cart_min_value']?></td>
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
								echo "<span class='badge badge-edit'><a href='manage_coupon_master.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a <a onClick=\"javascript: return confirm('Are you sure you want to delete this data?');\" href='?type=delete&id=".$row['id']."'>Delete</a></span>";
								
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
</div><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
