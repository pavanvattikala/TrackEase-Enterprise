var manageOrderTable;

// to load the data table
$(document).ready(function() {
	$('#navOrder').addClass('active');
	
	manageOrderTable = $("#manageOrderTable").DataTable({
		'ajax': '/orders/fetchOrders',
		'order': [],
		order: [[0, 'desc']], // to sort the order id in reverse
	});		
					
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
		// no table row
		count = 1;
		arrayNumber = 0;
	}
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajax({
		url: '/product/fetchProductData',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+			  				
				'<td>'+
					'<div class="form-group">'+

					'<select class="form-control" name="productName[]" id="productName'+count+'" onchange="getProductData('+count+')" >'+
						'<option value="">~~SELECT~~</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							//console.log(value);
							tr += '<option value="'+value.product_id+'">'+value.product_name+'</option>';							
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
					'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="subAmount()" autocomplete="off" class="form-control" min="1" />'+
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
			if(tableLength > 0) {							
				$("#productTable tbody tr:last").after(tr);
			} else {				
				$("#productTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row

// to delete the row
function removeProductRow(row = null) {
	if(row) {
		$("#row"+row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

// select on product data
function getProductData(row = null) {
	if(row) {
		var productId = $("#productName"+row).val();		
		
		if(productId == "") {
			$("#rate"+row).val("");

			$("#quantity"+row).val("");						
			$("#total"+row).val("");


		} else {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: '/product/fetchSelectedProduct',
				type: 'post',
				data: {productId : productId},
				dataType: 'json',
				success:function(response) {
					// setting the rate value into the rate input field
					//console.log(response);
					
					$("#rate"+row).val(response.selling_price);
					$("#rateValue"+row).val(response.selling_price);

					$("#quantity"+row).val(1);
			
					subAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} 
// /sub total amount
function subAmount() {
	var tableProductLength = $("#productTable tbody tr").length;
	//console.log(tableProductLength);
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		//console.log(tr);
		rate=  $(tr).find("td:eq(1) input").val();
		quantity=  $(tr).find("td:eq(2) input").val();
		// adding to total value
		$("#total"+Number(x+1)).val(Number(rate*quantity));
		$("#totalValue"+Number(x+1)).val(Number(rate*quantity));
		var count = $(tr).attr('id');
		//console.log(count);
		count = count.substring(3);
		totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);


	//alert(totalSubAmount);

	$("#subTotal").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);

	calculateAllAmount();

} 
// function to calculate the values down the sub amount
function calculateAllAmount(){

	subTotal = $("#subTotal").val();

	totalAmount = Number(subTotal);

	$("#totalAmount").val(totalAmount);
	$("#totalAmountValue").val(totalAmount);

	
	//calculate discount

	discount = Number($("#discount").val());

	var afterDiscount = totalAmount - (discount);

	$("#grandTotal").val(afterDiscount.toFixed(2));
	$("#grandTotalValue").val(afterDiscount.toFixed(2));

	paidAmount = $('#paid').val();

	dueAmount = (afterDiscount-paidAmount).toFixed(2);

	$('#due').val(dueAmount);
	$('#dueValue').val(dueAmount);


	
}
// reset order form
function resetOrderForm() {
	// reset the input field
	$("#createOrderForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} 
//order delte
function removeOrder(orderId) {
	$('#removeOrderId').text(orderId);
	$('#formRemoveOrderId').val(orderId);
}
