<div class="content pb-0">
	<div class="orders">
	   <div class="container">
			 <div class="card">
				<div class="card-header">
					<nav class="navbar-light">
						<div id="filter" class="container-xl" style="color:#fff";>
							<!-- <a class="navbar-brand" href="#">Products</a> -->Pending Orders
							<input id="myInput" type="text" placeholder="Search..">
								<div class="date-filter">
									<form class="form-inline" id="form-filter" method="POST" action="">
										<label>From:</label>
										<input type="date" class="form-control" placeholder="Start"  name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
										<label>To:</label>
										<input type="date" class="form-control" placeholder="End"  name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>"/>
										<button class="btn btn-primary" id="search_btn" name="search"><i class="fas fa-filter"></i></button><a href="accepted.php" id="refresh_btn" type="button" class="btn btn-success"><i class="fas fa-redo"></i></a>
									</form>
								</div>
						</div>
					</nav>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table">
							<thead>
								<tr>
									<th class="product-name"><span class="nobr">Order Date</span></th>
									<th class="product-name"><span class="nobr">Name</span></th>
									<th class="product-name"><span class="nobr">No</span></th>
									<th class="product-price"><span class="nobr"> Address </span></th>
									<th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
									<th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
									<th class="product-stock-stauts"></th>
									<th class="product-thumbnail"></th>
								</tr>
							</thead>
							<tbody id="myTable">
								<?php
								if(ISSET($_POST['search'])){
									$date1 = date("Y-m-d", strtotime($_POST['date1']));
									$date2 = date("Y-m-d", strtotime($_POST['date2']));
									$query=mysqli_query($con, "SELECT * FROM `order` WHERE date(`added_on`) BETWEEN '$date1' AND '$date2'");
									$row=mysqli_num_rows($query);
									if($row>0){
										while($fetch=mysqli_fetch_array($query)){
									?>
								<tr>
									<td class="product-name"><?php echo $fetch['added_on']?></td>
									<td class="product-name"><?php echo $fetch['user_name']?></td>
									<td class="product-name"><?php echo $fetch['contact']?></td>
									<td class="product-name">
									<?php echo $fetch['address']?><br/>
									<?php echo $fetch['city']?><br/>
									<?php echo $fetch['pincode']?>
									</td>
									<td class="product-name"><?php echo $fetch['payment_type']?></td>
									<td class="product-name"><?php echo $fetch['payment_status']?></td>
									<td class="product-add-to-cart"><a href="order_master_detail.php?id=<?php echo $fetch['id']?>" class="update"><?php $fetch['id']?>Update</a>
									<a href="../order_pdf.php?id=<?php echo $fetch['id']?>" class="pdf">PDF</a></td>
								</tr>
							<?php
										}
									}else{
										echo'
										<tr class=""><td class="p-5 bg-white"> No data available.</td><td></td> <td><td></td></td><td></td><td></td></tr>';
									}
								}else{
									$query=mysqli_query($con, "SELECT * FROM `order` where order_status='3'");
									$row=mysqli_num_rows($query);
									if($row==0){
										echo'
										<tr class=""><td class="p-5 bg-white"> No data available.</td><td></td> <td><td></td></td><td></td><td></td></tr>';
									}else while($fetch=mysqli_fetch_array($query)){
							?>
								<tr>
									<td class="product-name"><?php echo $fetch['added_on']?></td>
									<td class="product-name"><?php echo $fetch['user_name']?></td>
									<td class="product-name"><?php echo $fetch['contact']?></td>
									<td class="product-name">
									<?php echo $fetch['address']?><br/>
									<?php echo $fetch['city']?><br/>
									<?php echo $fetch['pincode']?>
									</td>
									<td class="product-name"><?php echo $fetch['payment_type']?></td>
									<td class="product-name"><?php echo $fetch['payment_status']?></td>
									<td class="product-add-to-cart"><a href="order_master_detail.php?id=<?php echo $fetch['id']?>" class="update"><?php $fetch['id']?>Update</a>
									<a href="../order_pdf.php?id=<?php echo $fetch['id']?>" class="pdf">PDF</a></td>
								</tr>
							<?php
									}
								}
							?>
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