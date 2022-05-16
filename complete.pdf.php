<?php
include('vendor/autoload.php');
require('connection.inc.php');
require('functions.inc.php');


$css=file_get_contents('css/bootstrap.min.css');
$css.=file_get_contents('style.css');
$html='<div class="wishlist-table table-responsive">
   <table>
      <thead>
         <tr>
            <th class="product-thumbnail">Name</th>
            <th class="product-thumbnail">Contact</th>
            <th class="product-name">Payment Type</th>
            <th class="product-price">Total Payment</th>
         </tr>
      </thead>
      <tbody>';
      $res=mysqli_query($con,"SELECT * FROM `order` where order_status='5'");	
		while($row=mysqli_fetch_assoc($res)){
		// $total_price=$total_price+($row['qty']*$row['price']);
		//  $pp=$row['qty']*$row['price'];
         $html.='<tr>
            <td class="product-name">'.$row['user_name'].'</td>
            <td class="product-name">'.$row['contact'].'</td>
            <td class="product-name"> '.$row['payment_type'].'</td>
            <td class="product-price">₱ '.$row['total_price'].'</td>
         </tr>';
		 }
      $html.='</tbody>
   </table>
</div>';
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$file=time().'.pdf';
$mpdf->Output($file,'D');
?>
