<?php 
require_once 'includes/header.php'; 

$productSql = "SELECT * FROM ms_product WHERE is_active = 1";
$productQuery = $connect->query($productSql);
if($productQuery == null){
	$countProduct = 0;
}else{
	$countProduct = $productQuery->num_rows;
}

$revenueSql = "SELECT (penjualan - modal) AS revenue FROM (SELECT (SELECT sum(grand_total) FROM order_transaction) AS penjualan, (SELECT sum(grand_total) FROM purchase_transaction) AS modal) AS a";
$revenueQuery = $connect->query($revenueSql);
$fetchRevenue = $revenueQuery->fetch_array();
$totalRevenue = $fetchRevenue['revenue'];

$connect->close();

?>

<div class="row">
	<div class="col-md-6">
		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1>
		    	<?php 
		    		if($totalRevenue){
		    			echo $totalRevenue;
		    		}else{
		    			echo '0';
		    		} 
	    		?></h1>
		  </div>
		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-usd"></i> Total Revenue</p>
		  </div>
		</div> 
	</div>

	<div class="col-md-6">
		<div class="card">
		  <div class="cardHeader" style="background-color:#245580;">
		    <h1><?php echo $countProduct; ?></h1>
		  </div>
		  <div class="cardContainer">
		    <p> <i class="glyphicon glyphicon-shopping-cart"></i> Total Product</p>
		  </div>
		</div> 
	</div>
</div>

<?php require_once 'includes/footer.php'; ?>