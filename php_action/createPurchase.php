<?php 	

require_once 'common.php';

$valid['success'] = array('success' => FALSE, 'messages' => array(), 'purchase_id' => '');

if($_POST){	

	$purchaseDate = date('Y-m-d', strtotime($_POST['purchaseDate']));	
	$vendorName = $_POST['vendorName'];
	$refNo = $_POST['referenceNo'];
	$ppi = $_POST['ppi'];
	$grandTotalValue = $_POST['grandTotalValue'];
	$paymentStatus = $_POST['paymentStatus'];
	$purchaseStatus = $_POST['purchaseStatus'];
				
	$stmt = "INSERT INTO purchase_transaction (purchase_date, vendor_name, purchase_no, grand_total, payment_status,purchase_status, reference_no) VALUES ('$purchaseDate', '$vendorName', (SELECT purchase_no + 1 FROM purchase_transaction ORDER BY purchase_no DESC LIMIT 1), '$grandTotalValue', '$paymentStatus', '$purchaseStatus')";
	
	if($connect->query($stmt) === true) {
		$valid['success'] = TRUE;
		$valid['messages'] = "Success!";
		$purchase_id = $connect->insert_id;
		$valid['purchase_id'] = $purchase_id;
	}else{
		$valid['success'] = FALSE;
		$valid['messages'] = "Error!";
	}

	$stmt = "SELECT purchase_no FROM purchase_transaction ORDER BY purchase_no DESC LIMIT 1";
	$result = $connect->query($stmt);
	$purchase_no = $result[0];

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT id, quantity FROM ms_product WHERE product_name = ".$_POST['productName'][$x];
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[1] + $_POST['quantity'][$x];							
			$updateProductTable = "UPDATE ms_product SET quantity = '".$updateQuantity[$x]."' WHERE product_name = ".$_POST['productName'][$x];
			$connect->query($updateProductTable);

			$purchaseDetailSql = "INSERT INTO purchase_detail (purchase_no, product_id, quantity, price_per_item, subtotal) 
			VALUES ('$purchase_no', '".$updateProductQuantityResult[0]."', ".$_POST['quantity'][$x].", ".$_POST['priceValue'][$x].", ".$_POST['totalValue'][$x].")";

			$connect->query($purchaseDetailSql);		
		}
	}	

	$connect->close();
	echo json_encode($valid);
}

?>