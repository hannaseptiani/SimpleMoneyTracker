var managePurchaseTable;

$(document).ready(function(){

	var divRequest = $(".div-request").text();
	$("#navPurchase").addClass('active');
	if(divRequest == 'add'){

		$('#topNavAddPurchase').addClass('active');	
		$("#PurchaseDate").datepicker();
		$("#createPurchaseForm").unbind('submit').bind('submit', function(){

			var form = $(this);
			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();

			var purchaseDate = $("#purchaseDate").val();
			var vendorName = $("#vendorName").val();
			var referenceNo = $("#referenceNo").val();
			var paymentStatus = $("#paymentStatus").val();
			var purchaseStatus = $("#purchaseStatus").val();	

			if(purchaseDate == "") {
				$("#purchaseDate").after('<p class="text-danger"> Purchase Date is required!</p>');
				$('#purchaseDate').closest('.form-group').addClass('has-error');
			} else {
				$('#purchaseDate').closest('.form-group').addClass('has-success');
			}

			if(vendorName == "") {
				$("#vendorName").after('<p class="text-danger"> Vendor Name is required!</p>');
				$('#vendorName').closest('.form-group').addClass('has-error');
			} else {
				$('#vendorName').closest('.form-group').addClass('has-success');
			}

			if(referenceNo == "") {
				$("#referenceNo").after('<p class="text-danger"> Reference No is invalid!</p>');
				$('#referenceNo').closest('.form-group').addClass('has-error');
			} else {
				$('#referenceNo').closest('.form-group').addClass('has-success');
			}

			if(paymentStatus == "") {
				$("#paymentStatus").after('<p class="text-danger"> Payment Status is required!</p>');
				$('#paymentStatus').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentStatus').closest('.form-group').addClass('has-success');
			}

			if(purchaseStatus == "") {
				$("#purchaseStatus").after('<p class="text-danger"> Purchase Status is required!</p>');
				$('#purchaseStatus').closest('.form-group').addClass('has-error');
			} else {
				$('#purchaseStatus').closest('.form-group').addClass('has-success');
			}

			var productName = document.getElementsByName('productName[]');				
			var validateProduct;
			for (var x = 0; x < productName.length; x++){       			
				var productNameId = productName[x].id;	    	
			    if(productName[x].value == ''){	    		    	
			    	$("#"+productNameId+"").after('<p class="text-danger"> Please select product!</p>');
			    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
		        }else{      	
			    	$("#"+productNameId+"").closest('.form-group').addClass('has-success');	    		    		    	
		        }          
		   	}

		   	for (var x = 0; x < productName.length; x++) {       						
			    if(productName[x].value){	    		    		    	
			    	validateProduct = true;
				}else{      	
					validateProduct = false;
				}          
		   	}

		   	var ppi = document.getElementsByName('priceValue[]');		   	
		   	var validatePPI;
		   	for (var x = 0; x < ppi.length; x++) {       
	 			var ppiId = ppi[x].id;
			    if(ppiId[x].value == ''){	    	
			    	$("#"+ppiId+"").after('<p class="text-danger"> Please select product!</p>');
			    	$("#"+ppiId+"").closest('.form-group').addClass('has-error');	    		    		    	
				}else{      	
					$("#"+ppiId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
				} 
		   	}

		   	for (var x = 0; x < ppi.length; x++){       						
			    if(ppi[x].value){	    		    		    	
			    	validatePPI = true;
		      }else{      	
			    	validatePPI = false;
		      }          
		   	}    		   	
	   	
		   	var quantity = document.getElementsByName('quantity[]');		   	
		   	var validateQuantity;
		   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
			    if(quantity[x].value == ''){	    	
			    	$("#"+quantityId+"").after('<p class="text-danger"> Please select product!</p>');
			    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
				}else{      	
					$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
				} 
		   	}

		   	for (var x = 0; x < quantity.length; x++){       						
			    if(quantity[x].value){	    		    		    	
			    	validateQuantity = true;
		      }else{      	
			    	validateQuantity = false;
		      }          
		   	}     	
	   	
			if(purchaseDate && vendorName && referenceNo && paymentStatus && purchaseStatus) {
				if(validateProduct == true && validateQuantity == true && validatePpi == true) {
					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							$("#createPurchaseBtn").button('reset');
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');
							if(response.success == true){	
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	            	'<a href="purchase.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Purchase </a>'+
	   		       '</div>');
								
								$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);
								$(".submitButtonFooter").addClass('div-hide');
								$(".removeProductRowBtn").addClass('div-hide');	
							}else{
								alert(response.messages);								
							}
						}
					});
				}
			}
			return false;
		});
	}else if(divRequest == 'manage') {
		$('#topNavManagePurchase').addClass('active');
		managePurchaseTable = $("#managePurchaseTable").DataTable({
			'ajax': 'php_action/getPurchase.php',
			'purchase': []
		});					
	} 
});

function addRow() {
	$("#addRowBtn").button("loading");
	var tableLength = $("#productTable tbody tr").length;
	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		count = 1;
		arrayNumber = 0;
	}

	$.ajax({
		url: 'php_action/getProductData.php',
		type: 'post',
		dataType: 'json',
		success:function(response){
			$("#addRowBtn").button("reset");			
			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+			  				
				'<td>'+
					'<div class="form-group">'+

					'<select class="form-control" name="productName[]" id="productName'+count+'" onchange="getProductData('+count+')" >'+
						'<option value="">---SELECT---</option>';
						$.each(response, function(index, value){
							tr += '<option value="'+value[0]+'">'+value[1]+'</option>';							
						});
													
					tr += '</select>'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;"">'+
					'<input type="text" name="rate[]" id="rate'+count+'" autocomplete="off" disabled="true" class="form-control" />'+
					'<input type="hidden" name="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td style="padding-left:20px;">'+
				'<td style="padding-left:20px;">'+
					'<div class="form-group">'+
					'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;">'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0){							
				$("#productTable tbody tr:last").after(tr);
			} else {				
				$("#productTable tbody").append(tr);
			}		
		}
	});
}

function removeProductRow(row = null){
	if(row) {
		$("#row"+row).remove();
		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

function getProductData(row = null) {
	if(row){
		var productId = $("#productName"+row).val();		
		if(productId == ""){
			$("#price"+row).val("");
			$("#quantity"+row).val("");						
			$("#total"+row).val("");
		}else{
			$.ajax({
				url: 'php_action/getCurrentProduct.php',
				type: 'post',
				data: {productId : productId},
				dataType: 'json',
				success:function(response){
					$("#price"+row).val(response.selling_price);
					$("#priceValue"+row).val(response.selling_price);
					$("#quantity"+row).val(1);
					var total = Number(response.selling_price) * 1;
					total = total.toFixed(2);
					$("#total"+row).val(total);
					$("#totalValue"+row).val(total);
					subAmount();
				}
			});
		}		
	} else {
		alert('no row! please refresh the page');
	}
}

function getTotal(row = null) {
	if(row) {
		var total = Number($("#priceValue"+row).val()) * Number($("#quantity"+row).val());
		total = total.toFixed(2);
		$("#total"+row).val(total);
		$("#totalValue"+row).val(total);
		subAmount();
	} else {
		alert('no row !! please refresh the page');
	}
}

function subAmount() {
	var tableProductLength = $("#productTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);
		totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
	}

	totalSubAmount = totalSubAmount.toFixed(2);

	$("#subTotal").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);

	var discount = $("#discount").val();
	if(discount){
		var grandTotal = Number($("#subTotalValue").val()) - Number(discount);
		grandTotal = grandTotal.toFixed(2);
		$("#grandTotal").val(grandTotal);
		$("#grandTotalValue").val(grandTotal);
	} else {
		$("#grandTotal").val(totalSubAmount);
		$("#grandTotalValue").val(totalSubAmount);
	}
}

function discountFunc() {
	var discount = $("#discount").val();
 	var totalAmount = Number($("#subTotalValue").val());
 	totalAmount = totalAmount.toFixed(2);

 	var grandTotal;
 	if(totalAmount) { 	
 		grandTotal = Number($("#subTotalValue").val()) - Number($("#discount").val());
 		grandTotal = grandTotal.toFixed(2);
 		$("#grandTotal").val(grandTotal);
 		$("#grandTotalValue").val(grandTotal);
 	} else {
 	}
}

function resetPurchaseForm() {
	$("#createPurchaseForm")[0].reset();
	$(".text-danger").remove();
	$(".form-group").removeClass('has-success').removeClass('has-error');
}

function removePurchase(purchaseId = null) {
	if(purchaseId) {
		$("#removePurchaseBtn").unbind('click').bind('click', function() {
			$("#removePurchaseBtn").button('loading');
			$.ajax({
				url: 'php_action/deletePurchase.php',
				type: 'post',
				data: {purchaseId : purchaseId},
				dataType: 'json',
				success:function(response) {
					$("#removePurchaseBtn").button('reset');
					if(response.success == true) {
						managePurchaseTable.ajax.reload(null, false);
						$("#removePurchaseModal").modal('hide');
						$("#success-messages").html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');
	          			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						});          
					} else {
						$(".removePurchaseMessages").html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');
	          			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						});	          
					}
				}
			});
		});
	} else {
		alert('error! refresh the page again');
	}
}