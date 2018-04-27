<?php 	

require_once 'common.php';
$valid['success'] = array('success' => FALSE, 'messages' => array());

$orderId = $_POST['orderId'];

if($orderId){ 
 $sql = "DELETE FROM order_transaction WHERE order_id = ".$orderId;
 $orderDetail = "DELETE FROM order_detail WHERE  order_id = (SELECT order_no FROM order_transaction WHERE order_id = ".$orderId.")";

 if($connect->query($sql) === TRUE && $connect->query($orderItem) === TRUE) {
 	$valid['success'] = TRUE;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = FALSE;
 	$valid['messages'] = "Error while removing Order";
 }
 
 $connect->close();

 echo json_encode($valid);
 
}

?>