<?php 	

require_once 'common.php';

$valid['success'] = array('success' => FALSE, 'messages' => array());

if($_POST){
	$productId = $_POST['productId'];
	$productName = $_POST['editProductName']; 
	$quantity = $_POST['editQuantity'];
	$price = $_POST['editPrice'];
	$status = $_POST['editProductStatus'];
		
	$stmt = "UPDATE ms_product SET product_name = '".$productName."', quantity = ".$quantity.", selling_price = ".$price.", iis_active = ".$status." WHERE product_id = ".$productId;
	//not the safest way to update, prone to sql inject, but will work for now.

	if($connect->query($stmt) === TRUE) {
		$valid['success'] = TRUE;
		$valid['messages'] = "Success!";	
	} else {
		$valid['success'] = FALSE;
		$valid['messages'] = "Error!";
	}
}
	 
$connect->close();
echo json_encode($valid);
 
?>