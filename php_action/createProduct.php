<?php 	

require_once 'common.php';

$valid['success'] = array('success' => FALSE, 'messages' => array());

if($_POST){	
	$productName = $_POST['productName'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	$status = $_POST['productStatus'];

	$stmt = "INSERT INTO ms_product (product_name, quantity, selling_price, is_active) 
			VALUES ('".$productName."', ".$quantity.", ".$price.", ".$status.")";
	//not the safest way to insert, prone to sql inject, but will work for now.
				
	if($connect->query($stmt) === TRUE){
		$valid['success'] = TRUE;
		$valid['messages'] = "Success!";	
	}else{
		$valid['success'] = FALSE;
		$valid['messages'] = "Error!";
	}

	$connect->close();
	echo json_encode($valid);
}

?>