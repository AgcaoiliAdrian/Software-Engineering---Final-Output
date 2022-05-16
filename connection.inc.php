<?php
session_start();
$con=mysqli_connect("localhost","root","","ecommerce");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'../Coffee Hour');
define('SITE_PATH','http://localhost/Coffee%20Hour/');

?>