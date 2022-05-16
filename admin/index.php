<?php
require('top.inc.php');
	$get_users = "select * from users";
	$run_users = mysqli_query($con,$get_users);
	$count_users = mysqli_num_rows($run_users);

	$get_product = "select * from product";
	$run_product = mysqli_query($con,$get_product);
	$count_product = mysqli_num_rows($run_product);	

	$get_income = "select * from categories";
	$run_income = mysqli_query($con,$get_income);
	$count_income = mysqli_num_rows($run_income);
//COUNT PENDING//
	$pendings=("select * from `order` where order_status='1'");
	$run_pending = mysqli_query($con,$pendings);
	$count_pending = mysqli_num_rows($run_pending);
//COUNT ACCEPTED//
	$accept=("select * from `order` where order_status='3'");
	$run_accept = mysqli_query($con,$accept);
	$count_accept = mysqli_num_rows($run_accept);
//COUNT ON THE WAY//
	$onway=("select * from `order` where order_status='2'");
	$run_onway = mysqli_query($con,$onway);
	$count_onway = mysqli_num_rows($run_onway);
//COUNT COMPELTED//
	$complete=("select * from `order` where order_status='5'");
	$run_complete = mysqli_query($con,$complete);
	$count_complete = mysqli_num_rows($run_complete);
//COUNT CANCELED//
	$canceled=("select * from `order` where order_status='4'");
	$run_canceled = mysqli_query($con,$canceled);
	$count_canceled = mysqli_num_rows($run_canceled);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<body>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">Dashboard </h4>
				</div>
			</div>
		  </div>
	   </div>
	</div>
</div>
<main>
    <div class="dashboard-cards">
        <div class="card-single users">
		<div>
			<span><i class="fas fa-users"></i></span>
            </div>
            <div>
                <h1><?php echo $count_users; ?> </h1>
                <span>Users</span>
            </div>

        </div>

        <div class="card-single order">
		<div>
		<span><i class="fas fa-coffee"></i></span>
            </div>
            <div>
                <h1><?php echo $count_product; ?></h1>
                <span>Products</span>
            </div>
        </div>
       
        <div class="card-single income">
		<div>
		<span><i class="fas fa-list"></i></span>
            </div>
            <div>
                <h1><?php echo $count_income; ?></h1>
                <span>Categories</span>
            </div>
        </div>

		<div class="card-single sales">
		<div>
		<span><i class="fas fa-list"></i></span>
            </div>
            <div>
                <h1><?php echo $count_complete; ?></h1>
                <span>Sales</span>
            </div>
        </div>
    </div>

	<div class="content-bar">
		<div class="chart">
			<div class="container-chart">
				<p class="">Orders</p>
				<div class="chart1">
					<canvas id="myChart"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
</main>
<!-- Chart -->
<script>
const ctx = document.getElementById('myChart').getContext('2d');
var pending = <?php echo json_encode($count_pending);?>;
var accept = <?php echo json_encode($count_accept);?>;
var onway = <?php echo json_encode($count_onway);?>;
var complete = <?php echo json_encode($count_complete);?>;
var canceled = <?php echo json_encode($count_canceled);?>;
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pending', 'Accepted', 'On the way', 'Completed', 'Canceled'],
        datasets: [{
            label: 'Orders',
            data: [pending, accept, onway, complete, canceled],
            backgroundColor: ['#035397','#ff8400', '#B20600', '#5a761d', '#F55353'],
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
</body>
</html>