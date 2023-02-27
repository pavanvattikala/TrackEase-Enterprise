var manageServiceTable;

$(document).ready(function() {

	var divRequest = $(".div-request").text();

	// top nav bar 
	$("#navService").addClass('active');

	manageProductTable = $('#manageServiceTable').DataTable({
		'ajax': '/service/fetchService',
		'service': [],
		order: [[0, 'desc']], // to sort the order id in reverse
		
	}); // call the data table

}); // /documernt


function addRow() {
	$("#addRowBtn").button("loading");

	var tableLength = $("#serviceTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#serviceTable tbody tr:last").attr('id');
		arrayNumber = $("#serviceTable tbody tr:last").attr('class');
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
		url: '/service/fetchServiceData',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+			  				
				'<td>'+
					'<div class="form-group">'+

					'<select class="form-control" name="serviceName[]" id="serviceName'+count+'" >'+
						'<option value="">~~SELECT~~</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							//console.log(value);
							tr += '<option value="'+value.service_type_id +'">'+value.service_type_name+'</option>';							
						});
													
					tr += '</select>'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;"">'+
					'<input type="text" name="rate[]" id="rate'+count+'" onkeyup="subAmount()" autocomplete="off" class="form-control" />'+
				'</td style="padding-left:20px;">'+
				'<td style="padding-left:20px;">'+
					'<div class="form-group">'+
					'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="subAmount()" autocomplete="off" class="form-control" min="1" value="1"/>'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;">'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeServiceRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#serviceTable tbody tr:last").after(tr);
			} else {				
				$("#serviceTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row

function removeServiceRow(row = null) {
	if(row) {
		$("#row"+row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}



function subAmount() {
	var tableProductLength = $("#serviceTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#serviceTable tbody tr")[x];
		//console.log(tr);
		rate=  $(tr).find("td:eq(1) input").val();
		quantity=  $(tr).find("td:eq(2) input").val();
		// adding to total value
		$("#total"+Number(x+1)).val(Number(rate*quantity));
		$("#totalValue"+Number(x+1)).val(Number(rate*quantity));
		var count = $(tr).attr('id');
		count = count.substring(3);
		totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);


	//alert(totalSubAmount);

	$("#subTotal").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);

	calculateAllAmount();

} // /sub total amount
function calculateAllAmount(){

	subTotal = $("#subTotal").val();

	serviceCharge = $('#serviceCharge').val();

	totalAmount = Number(subTotal)+Number(serviceCharge);

	$("#totalAmount").val(totalAmount);
	$("#totalAmountValue").val(totalAmount);

	
	//calculate discount

	discount = $("#discount").val();

	var percentage = Number(discount) / 100;
	var afterDiscount = totalAmount - (totalAmount * percentage);

	$("#grandTotal").val(afterDiscount.toFixed(2));
	$("#grandTotalValue").val(afterDiscount.toFixed(2));

	paidAmount = $('#paid').val();

	dueAmount = (afterDiscount-paidAmount).toFixed(2);

	$('#due').val(dueAmount);
	$('#dueValue').val(dueAmount);


	
}


function resetOrderForm() {
	// reset the input field
	$("#createOrderForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form


// remove order from server
function removeOrder(orderId = null) {
	if(orderId) {
		$("#removeOrderBtn").unbind('click').bind('click', function() {
			$("#removeOrderBtn").button('loading');

			$.ajax({
				url: 'php_action/removeOrder.php',
				type: 'post',
				data: {orderId : orderId},
				dataType: 'json',
				success:function(response) {
					$("#removeOrderBtn").button('reset');

					if(response.success == true) {

						manageServiceTable.ajax.reload(null, false);
						// hide modal
						$("#removeOrderModal").modal('hide');
						// success messages
						$("#success-messages").html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          

					} else {
						// error messages
						$(".removeOrderMessages").html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          
					} // /else

				} // /success
			});  // /ajax function to remove the order

		}); // /remove order button clicked
		

	} else {
		alert('error! refresh the page again');
	}
}
