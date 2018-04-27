var manageProductTable;

$(document).ready(function(){
	$('#navProduct').addClass('active');
	manageProductTable = $('#manageProductTable').DataTable({
		'ajax': 'php_action/getProduct.php',
		'order': []
	});

	$("#addProductModalBtn").unbind('click').bind('click', function() {
		$("#submitProductForm")[0].reset();		
		$(".text-danger").remove();
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$("#submitProductForm").unbind('submit').bind('submit', function() {

			var productName = $("#productName").val();
			var quantity = $("#quantity").val();
			var price = $("#price").val();
			var productStatus = $("#productStatus").val();

			if(productName == ""){
				$("#productName").after('<p class="text-danger">Product Name is required!</p>');
				$('#productName').closest('.form-group').addClass('has-error');
			}else{
				$("#productName").find('.text-danger').remove();
				$("#productName").closest('.form-group').addClass('has-success');	  	
			}

			if(quantity <= 0 || quantity == ""){
				$("#quantity").after('<p class="text-danger">Quantity is invalid!</p>');
				$('#quantity').closest('.form-group').addClass('has-error');
			}else{
				$("#quantity").find('.text-danger').remove();
				$("#quantity").closest('.form-group').addClass('has-success');	  	
			}

			if(price <= 0 || price == "") {
				$("#price").after('<p class="text-danger">Selling Price is invalid!</p>');
				$('#price').closest('.form-group').addClass('has-error');
			}else{
				$("#price").find('.text-danger').remove();
				$("#price").closest('.form-group').addClass('has-success');	  	
			}

			if(productStatus == "") {
				$("#productStatus").after('<p class="text-danger">Status is required!</p>');
				$('#productStatus').closest('.form-group').addClass('has-error');
			}else{
				$("#productStatus").find('.text-danger').remove();
				$("#productStatus").closest('.form-group').addClass('has-success');	  	
			}

			if(productName && quantity && price && productStatus) {
				$("#createProductBtn").button('loading');
				var form = $(this);
				var formData = new FormData(this);

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response){

						if(response.success == true) {
							$("#createProductBtn").button('reset');						
							$("#submitProductForm")[0].reset();
							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
							$('#add-product-messages').html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

		          			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							});

							manageProductTable.ajax.reload(null, true);

							$(".text-danger").remove();
							$(".form-group").removeClass('has-error').removeClass('has-success');
						
						}
					}
				});
			}				
			return false;
		});
	});
});

function editProduct(productId = null){

	if(productId){
		$("#productId").remove();		
		$(".text-danger").remove();
		$(".form-group").removeClass('has-error').removeClass('has-success');
		$('.div-loading').removeClass('div-hide');
		$('.div-result').addClass('div-hide');

		$.ajax({
			url: 'php_action/getCurrentProduct.php',
			type: 'post',
			data: {productId: productId},
			dataType: 'json',
			success:function(response){

				$('.div-loading').addClass('div-hide');
				$('.div-result').removeClass('div-hide');			
			
				$(".editProductFooter").append('<input type="hidden" name="productId" id="productId" value="'+response.product_id+'" />');

				$("#editProductName").val(response.product_name);
				$("#editQuantity").val(response.quantity);
				$("#editPrice").val(response.selling_price);
				$("#editProductStatus").val(response.is_active);
				
				$("#editProductForm").unbind('submit').bind('submit', function() {

					var productName = $("#editProductName").val();
					var quantity = $("#editQuantity").val();
					var price = $("#editPrice").val();
					var productStatus = $("#editProductStatus").val();		

					if(productName == ""){
						$("#editProductName").after('<p class="text-danger">Product Name is required!</p>');
						$('#editProductName').closest('.form-group').addClass('has-error');
					}else{
						$("#editProductName").find('.text-danger').remove();
						$("#editProductName").closest('.form-group').addClass('has-success');	  	
					}

					if(quantity <= 0 || quantity == ""){
						$("#editQuantity").after('<p class="text-danger">Quantity is invalid!</p>');
						$('#editQuantity').closest('.form-group').addClass('has-error');
					}else{
						$("#editQuantity").find('.text-danger').remove();
						$("#editQuantity").closest('.form-group').addClass('has-success');	  	
					}

					if(price <= 0 || price == "") {
						$("#editPrice").after('<p class="text-danger">Selling Price is invalid!</p>');
						$('#editPrice').closest('.form-group').addClass('has-error');
					}else{
						$("#editPrice").find('.text-danger').remove();
						$("#editPrice").closest('.form-group').addClass('has-success');	  	
					}

					if(productStatus == "") {
						$("#editProductStatus").after('<p class="text-danger">Status is required!</p>');
						$('#editProductStatus').closest('.form-group').addClass('has-error');
					}else{
						$("#editProductStatus").find('.text-danger').remove();
						$("#editProductStatus").closest('.form-group').addClass('has-success');	  	
					}					

					if(productName && quantity && price && productStatus) {
						$("#editProductBtn").button('loading');
						var form = $(this);
						var formData = new FormData(this);
						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: formData,
							dataType: 'json',
							cache: false,
							contentType: false,
							processData: false,
							success:function(response) {
								console.log(response);
								if(response.success == true) {
									$("#editProductBtn").button('reset');																		
									$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
									$('#edit-product-messages').html('<div class="alert alert-success">'+
				            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

				          			$(".alert-success").delay(500).show(10, function(){
										$(this).delay(3000).hide(10, function(){
											$(this).remove();
										});
									});
									manageProductTable.ajax.reload(null, true);
									$(".text-danger").remove();
									$(".form-group").removeClass('has-error').removeClass('has-success');
								}	
							}
						});
					}				
					return false;
				});
			}
		});
	}else{
		alert('error please refresh the page');
	}
}

function removeProduct(productId = null){
	if(productId) {
		$("#removeProductBtn").unbind('click').bind('click', function() {
			$("#removeProductBtn").button('loading');
			$.ajax({
				url: 'php_action/removeProduct.php',
				type: 'post',
				data: {productId: productId},
				dataType: 'json',
				success:function(response) {
					$("#removeProductBtn").button('reset');
					if(response.success == true){
						$("#removeProductModal").modal('hide');
						manageProductTable.ajax.reload(null, false);
						$(".remove-messages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	          			$(".alert-success").delay(500).show(10, function(){
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						});
					}else{
						$(".removeProductMessages").html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');
	          			$(".alert-success").delay(500).show(10, function(){
							$(this).delay(3000).hide(10, function(){
								$(this).remove();
							});
						});
					}
				}
			});
			return false;
		});
	}
}