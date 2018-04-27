<?php 	

require_once 'common.php';

$productId = $_POST['productId'];

$sql = "SELECT id, product_name, quantity, selling_price, is_active FROM ms_product WHERE id = ".$productId;

$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
}

$connect->close();
echo json_encode($row);

?>