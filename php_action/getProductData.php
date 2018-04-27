<?php 	

require_once 'common.php';

$sql = "SELECT id, product_name FROM ms_product WHERE is_active = 1";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);

?>