<?php 	

require_once 'common.php';

$valid['success'] = array('success' => FALSE, 'messages' => array(), 'order_id' => '');

if($_POST){	

	$orderDate = date('Y-m-d', strtotime($_POST['orderDate']));	
	$customerName = $_POST['customerName'];
	$subTotalValue = $_POST['subTotalValue'];
	$discount = $_POST['discount'];
	$grandTotalValue = $_POST['grandTotalValue'];
	$paymentStatus = $_POST['paymentStatus'];
	$orderStatus = $_POST['orderStatus'];
				
	$stmt = "INSERT INTO order_transaction (order_date, customer_name, order_no, grand_total, payment_status, order_status) VALUES ('$orderDate', '$customerName', (SELECT order_no + 1 FROM order_transaction ORDER BY order_no DESC LIMIT 1), '$discount', '$grandTotalValue', '$paymentStatus', '$orderStatus')";
	
	if($connect->query($stmt) === true) {
		$valid['success'] = TRUE;
		$valid['messages'] = "Success!";
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;
	}else{
		$valid['success'] = FALSE;
		$valid['messages'] = "Error!";
	}

	$stmt = "SELECT order_no FROM order_transaction ORDER BY order_no DESC LIMIT 1";
	$result = $connect->query($stmt);
	$order_id = $result[0];

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT id, quantity FROM ms_product WHERE product_name = ".$_POST['productName'][$x];
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[1] - $_POST['quantity'][$x];							
			$updateProductTable = "UPDATE ms_product SET quantity = '".$updateQuantity[$x]."' WHERE product_name = ".$_POST['productName'][$x];
			$connect->query($updateProductTable);

			$orderDetailSql = "INSERT INTO order_detail (order_id, product_id, quantity, price_per_item, subtotal) 
			VALUES ('$order_id', '".$updateProductQuantityResult[0]."', ".$_POST['quantity'][$x].", ".$_POST['priceValue'][$x].", ".$_POST['totalValue'][$x].")";

			$connect->query($orderDetailSql);		
		}
	}	

	$connect->close();
	echo json_encode($valid);
}

?>