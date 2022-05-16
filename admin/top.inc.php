<?php
require('../connection.inc.php');
require('functions.inc.php');
require('footer.inc.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

}else{
	header('location:../login.php');
	die();
}
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Dashboard Page</title>
      <!--Google Fonts-->
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <script src="assets/js/main.js"></script>
      <!--Icons-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <!--Google Fonts-->
      
   </head>
   <body>
      <aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">Menu</li>  
                     <li class="menu-item-has-children dropdown">             
                        <a href="index.php"><span><i class="fas fa-chart-line"></i>Dashboard</span></a>
                        <hr>
                     </li>           
                     <li class="menu-item-has-children dropdown">             
                        <a href="./pending.php"><span><i class="fas fa-coffee"></i>Orders</span></a>
                     </li>
                     <li class="menu-item-has-children dropdown">
                        <a href="fee.php" ><span><i class="fas fa-hand-holding-usd"></i> Delivery Fee</span></a>
                        <hr>
                     </li>
                     
                     <li class="menu-item-has-children dropdown">
                        <a href="categories.php" ><span><i class="fas fa-list"></i>Categories</span></a>
                     </li>   

                     <li class="menu-item-has-children dropdown">
                        <a href="product.php" ><i class="fab fa-elementor"></i>Products</span></a>
                        <hr>
                     </li>    

                     <li class="menu-item-has-children dropdown">
                        <a href="users.php" > <span><i class="fas fa-users"></i>Customer User</span></a>
                     </li>

                     <li class="menu-item-has-children dropdown">
                        <a href="contact_us.php"><span><i class="fas fa-phone-square-alt"></i>Feedbacks</span></a>
                     </li>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel">
         <header id="header" class="header">
            <div class="top-left">
               <div class="navbar-header">
                  <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Logo">
                  <h3>Coffee Hour</h3>
               </a>
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
               </div>
            </div>
            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Welcome <?php echo $_SESSION['ADMIN_USERNAME']?></a>
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>