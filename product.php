<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="home.php">Home</a></li>		  
		  <li class="active">Product</li>
		</ol>
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Product</div>
			</div>
			<div class="panel-body">
				<div class="remove-messages"></div>
				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Product </button>
				</div>		
				<table class="table" id="manageProductTable">
					<thead>
						<tr>				
							<th>Product Name</th>
							<th>Quantity</th>
							<th>Selling Price</th>
							<th>Status</th>
							<th style="width:20%;">Options</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>	
	</div>
</div>

<!-- add product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form class="form-horizontal" id="submitProductForm" action="php_action/createProduct.php" method="POST" enctype="multipart/form-data">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-plus"></i> Add Product</h4>
			</div>
			<div class="modal-body" style="max-height:450px; overflow:auto;">
				<div id="add-product-messages"></div>    	           	       
				<div class="form-group">
					<label for="productName" class="col-sm-3 control-label">Product Name</label>
					<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					    	<input type="text" class="form-control" id="productName" placeholder="Product Name" name="productName" autocomplete="off">
					    </div>
				</div>	    

				<div class="form-group">
					<label for="quantity" class="col-sm-3 control-label">Quantity</label>
					<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					    	<input type="number" class="form-control" id="quantity" placeholder="Quantity" name="quantity" autocomplete="off">
					    </div>
				</div>        	 

				<div class="form-group">
					<label for="price" class="col-sm-3 control-label">Selling Price</label>
					<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					    	<input type="number" class="form-control" id="price" placeholder="Selling Price" name="price" autocomplete="off">
					    </div>
				</div>			        	         	       

				<div class="form-group">
					<label for="productStatus" class="col-sm-3 control-label">Status</label>
					<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <select class="form-control" id="productStatus" name="productStatus">
					      	<option value="">---SELECT---</option>
					      	<option value="true">Available</option>
					      	<option value="false">Not Available</option>
					      </select>
					    </div>
				</div>
			</div>
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>      
     	</form>    
    </div>   
  </div>
</div>
<!-- end of add product -->

<!-- edit product -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content"> 	
  		<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Product</h4>
      	</div>
      	<div class="modal-body" style="max-height:450px; overflow:auto;">
	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					<span class="sr-only">Loading...</span>
	      	</div>
	      	<div class="div-result">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Product Info</a></li>    
				</ul>
				    <div role="tabpanel" class="tab-pane" id="productInfo">
				    	<form class="form-horizontal" id="editProductForm" action="php_action/editProduct.php" method="POST">				    
					    	<br />
					    	<div id="edit-product-messages"></div>
					    	<div class="form-group">
					        	<label for="editProductName" class="col-sm-3 control-label">Product Name</label>
					        	<label class="col-sm-1 control-label">: </label>
							    <div class="col-sm-8">
						      		<input type="text" class="form-control" id="editProductName" placeholder="Product Name" name="editProductName" autocomplete="off">
							    </div>
				        	</div>   

					        <div class="form-group">
					        	<label for="editQuantity" class="col-sm-3 control-label">Quantity</label>
					        	<label class="col-sm-1 control-label">: </label>
							    <div class="col-sm-8">
							      <input type="number" class="form-control" id="editQuantity" placeholder="Quantity" name="editQuantity" autocomplete="off">
							    </div>
					        </div>        	 

				        <div class="form-group">
				        	<label for="editPrice" class="col-sm-3 control-label">Selling Price</label>
				        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="number" class="form-control" id="editPrice" placeholder="Selling Price" name="editPrice" autocomplete="off">
						    </div>
				        </div>     	        			        	         	       

				        <div class="form-group">
				        	<label for="editProductStatus" class="col-sm-3 control-label">Status</label>
				        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						    	<select class="form-control" id="editProductStatus" name="editProductStatus">
							      	<option value="">---SELECT---</option>
							      	<option value="true">Available</option>
							      	<option value="false">Not Available</option>
						    	</select>
						    </div>
				        </div>         	        

				        <div class="modal-footer editProductFooter">
					        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
					        <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      	</div>			     
			        </form>			     	
			    </div>    
				</div>
			</div>
	    </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Product</h4>
      		</div>
      		<div class="modal-body">
      			<div class="removeProductMessages"></div>
        		<p>Do you really want to remove ?</p>
      		</div>
      		<div class="modal-footer removeProductFooter">
        		<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        		<button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      		</div>
    	</div>
  	</div>
</div>

<script src="custom/js/product.js"></script>

<?php require_once 'includes/footer.php'; ?>