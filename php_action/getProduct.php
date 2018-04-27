<?php 	
require_once 'common.php';

$sql = "SELECT id, product_name, quantity, selling_price, is_active FROM ms_product";
$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) { 
	$status = ""; 

	while($row = $result->fetch_array()) {
		$productId = $row['0'];

		if($row['4'] == 1){
			$status = "<label class='label label-success'>Available</label>";
		}else{
			$status = "<label class='label label-danger'>Not Available</label>";
		}

		$button = '
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Action <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu">
		    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
		    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
		  </ul>
		</div>';

		$output['data'][] = array($row['1'], $row['2'], $row['3'], $status, $button); 	
	}
}

$connect->close();
echo json_encode($output);

?>