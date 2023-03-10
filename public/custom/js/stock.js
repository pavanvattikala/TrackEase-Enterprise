var manageStockTable;

$(document).ready(function() {
	// top bar active
	$('#navStock').addClass('active');
	
	// manage Expense table
	manageStockTable = $("#manageStockTable").DataTable({
		'ajax': 'stock/fetchStock',
		'stock': []		
	});


    $("#stockFile").fileinput({		      
    }); 

});