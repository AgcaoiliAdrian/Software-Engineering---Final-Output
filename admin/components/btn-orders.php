<div class="dash-cards">
<?php
isAdmin();
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

<!--Pending-->
    <div class="cards-single">
      <a href="./pending.php">Pending</a>   
      <div class="icon-badge-container">
        <?php if($count_pending != 0){echo "<div class='icon-badge'>$count_pending</div>";}else {  }; ?>
      </div>      
    </div>
<!--Accept-->
    <div class="cards-single">
      <a href="./accepted.php">Accepted</a>
      <div class="icon-badge-container">
        <?php if($count_accept != 0){echo "<div class='icon-badge'>$count_accept</div>";}else {  }; ?>
      </div> 
    </div>
  <!--On The Way-->
    <div class="cards-single">
      <a href="./onway.php">On the way</a> 
      <div class="icon-badge-container">
        <?php if($count_onway != 0){echo "<div class='icon-badge'>$count_onway</div>";}else {  }; ?>
      </div>
    </div>
  <!--Complete-->
    <div class="cards-single">
      <a href="./complete.php">Completed</a> 
      <div class="icon-badge-container">
        <?php if($count_complete != 0){echo "<div class='icon-badge'>$count_complete</div>";}else {  }; ?>
      </div>
    </div>
  <!--Canceled-->
    <div class="cards-single">
      <a href="./canceled.php">Canceled</a>
      <div class="icon-badge-container">
        <?php if($count_canceled != 0){echo "<div class='icon-badge'>$count_canceled</div>";}else {  }; ?>
      </div>
    </div>
</div>
