<?php 	

require_once 'common.php';

$valid['success'] = array('success' => FALSE, 'messages' => array());
$productId = $_POST['productId'];

if($productId){ 
	$stmt = "DELETE FROM ms_product WHERE id = ".$productId;

	if($connect->query($stmt) === TRUE) {
		$valid['success'] = TRUE;
		$valid['messages'] = "Success!";		
	} else {
		$valid['success'] = FALSE;
		$valid['messages'] = "Error!";
	}

	$connect->close();
	echo json_encode($valid);
}

?>