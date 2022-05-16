<?php
require('top.inc.php');
isAdmin();

$sql="select * from delivery";
$res=mysqli_query($con,$sql);
?>
<div class="content pb-0">
	<div class="orders">
	   <div class="container">
			 <div class="card">
				<div class="card-header">
					<nav class="navbar-light">
						<div class="container-xl" style="color:#fff";>
							<!-- <a class="navbar-brand" href="#">Products</a> -->Delivery Fee
						</div>
					</nav>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>Delivery Fee</th>
							   <th></th>
							</tr>
						 </thead>
						 <tbody id="myTable">
							<?php 
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $row['id']?></td>
							   <td><span>&#8369 </span><?php echo $row['delivery']?></td>
							   <td>
								<?php
								echo "<span class='badge badge-edit'><a href='manage_fee.php?id=".$row['id']."'>Edit</a></span>&nbsp;";
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