<?php 	

require_once 'common.php';

$sql = "SELECT id, purchase_date, vendor_name, purchase_no, reference_no, payment_status, purchase_status, grand_total FROM purchase_transaction";
$result = $connect->query($sql);
$output = array('data' => array());

if($result->num_rows > 0) { 
	$paymentStatus = ""; 
	$x = 1;

	while($row = $result->fetch_array()) {
		if($row[5] == 'Paid'){
			$paymentStatus = "<label class='label label-success'>".$row[5]."</label>";
		}else{
			$paymentStatus = "<label class='label label-warning'>".$row[5]."</label>";
		}

		if($row[6] == 'Received'){
			$purchaseStatus = "<label class='label label-success'>".$row[6]."</label>";
		}else{
			$purchaseStatus = "<label class='label label-warning'>".$row[6]."</label>";
		}
		
		$purchaseId = $row[0];
		$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">  
	    <li><a type="button" data-toggle="modal" data-target="#removePurchaseModal" id="removePurchaseModalBtn" onclick="removePurchase('.$purchaseId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';		

		$output['data'][] = array(
			$x,
			$row[1],
			$row[2], 
			$row[3],
			$row[4],
			$row[7],	 	
			$paymentStatus,
			$purchaseStatus,
			$button 		
			); 	
		$x++;
	}
}

$connect->close();
echo json_encode($output);

?>