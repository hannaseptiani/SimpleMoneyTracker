<?php 	

require_once 'common.php';

$sql = "SELECT id, order_date, customer_name, order_no, payment_status, order_status, grand_total FROM order_transaction";
$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) { 
	$paymentStatus = ""; 
	$x = 1;

	while($row = $result->fetch_array()) {
		if($row[4] == 'Paid'){
			$paymentStatus = "<label class='label label-success'>".$row[4]."</label>";
		}else{
			$paymentStatus = "<label class='label label-warning'>".$row[4]."</label>";
		}
		
		$orderId = $row[0];
		$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">  
	    <li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';		

		$output['data'][] = array(
			$x,
			$row[1],
			$row[2], 
			$row[3],
			$row[6],	 	
			$paymentStatus,
			$button 		
			); 	
		$x++;
	}
}

$connect->close();
echo json_encode($output);

?>