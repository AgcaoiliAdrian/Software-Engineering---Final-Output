<?php
session_start();
require('connection.inc.php');

$name=mysqli_real_escape_string($con,$_POST['name']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$user_id=mysqli_real_escape_string($con,$_POST['id']);

$_SESSION['USER_ID']=$user_id;
        

$res=mysqli_query($con,"select * from users where id='$user_id'");
$check=mysqli_num_rows($res);
        $row=mysqli_fetch_assoc($res);
        $_SESSION['NAME']=$row['name'];
        
if($check>0){

}else{
        mysqli_query($con,"insert into users(name,email,id) values('$name','$email','$user_id')");
        $_SESSION['NAME']=$name;
}

echo "done";
?>