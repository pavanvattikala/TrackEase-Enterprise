var manageStockTable;

$(document).ready(function() {
	// top bar active
	$('select').selectpicker();

	$('#navStock').addClass('active');

	
	
	// manage Expense table

	var area = $(location).attr('href');
	var parts = area.split('/');

	var last = parts[parts.length-1];
	
	if(last == "stock"){
		manageStockTable = $("#manageStockTable").DataTable({
			'ajax': 'stock/fetchStock',
			'stock': []		
		});
	}

	if(last == "add_stock"){
		$.ajax({
			
			url: '/stock/getStockEntryOptions',
			type: 'get',
			dataType: 'json',
			success:function(response) {

				x = "<tr><td>pr Name</td><td>pr got price</td><td>pr sp price</td><td>pr quantity</td><td>pr total</td></tr>"
				$("#addStockBody").append(x);
			} // /success
		}); // ajax function
	}

});