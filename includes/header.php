<?php require_once 'php_action/common.php'; ?>

<!DOCTYPE html>
<html>
<head>

	<title>Inventory System</title>

	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="custom/css/custom.css">
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">
	<script src="assests/jquery/jquery.min.js"></script>
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
	<nav class="navbar navbar-default navbar-static-top">
    <a class="navbar-brand" href="index.php">Inventory Management System</a>
		<div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
      <ul class="nav navbar-nav navbar-right">        
      	<li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-list-alt"></i> Dashboard</a></li>       
        <li id="navProduct"><a href="product.php"> <i class="glyphicon glyphicon-gift"></i> Product</a></li>     
        <li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Orders <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddOrder"><a href="order.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Add Order</a></li>            
            <li id="topNavManageOrder"><a href="order.php?o=manage"> <i class="glyphicon glyphicon-edit"></i> Manage Order</a></li>            
          </ul>
        </li>
        <li class="dropdown" id="navPurchase">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Purchases <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavAddPurchase"><a href="purchase.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Add Purchase</a></li>            
            <li id="topNavManagePurchase"><a href="purchase.php?o=manage"> <i class="glyphicon glyphicon-edit"></i> Manage Purchase</a></li>            
          </ul>
        </li>
        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">        
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>            
          </ul>
        </li>                
      </ul>
    </div>
  </div>
	</nav>
	<div class="container">