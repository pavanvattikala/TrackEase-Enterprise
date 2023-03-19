var manageStockTable;

var selectRow;

$(document).ready(function() {
	// top bar active
	$('select').selectpicker();
	$('select').selectpicker('refresh');



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
		

		// ajax for loading the select
		$.ajax({
			url: '/api/productapi',
			type: 'get',
			success:function(response) {
				

				//console.log(response);
				
				select ='<select name="productName[]" id="productName" data-live-search="true" class="selectpicker" id="my-select">Select Product';

				response.forEach(obj => {
					select+='<option value="'+obj.product_id+'">'+obj.product_name+'</option>'
				});
				select+='</select>';

				selectRow = select;

				for(i=0;i<10;i++){
					appendTableRow('#addStockBody',i);
				}

				$('select').selectpicker('refresh');
				
			} 
		});
	}

	
});


function appendTableRow(tableid,i){
	gotpricerow = '<td><input type="number" id="gotprice'+i+'" name="gotprice[]" onkeyup="changeTotalPrice('+i+')"></td>';
	spprice='<td><input type="number" id="spprice'+i+'" name="spprice[]"></td>';
	quantRow = '<td><input type="number" id="quant'+i+'" name="quant[]" onkeyup="changeTotalPrice('+i+')"></td>';
	totalRow = '<td><input type="number" id="total'+i+'" name="total[]" readonly>';
	deleteRow = '<td><a class="btn bg-grey" onclick="removeRow('+i+')"><i class="glyphicon glyphicon-remove text-danger"></i><span class="text-danger">Remove</span></a></td>'
	row='<tr id="row'+i+'">'+'<td>'+selectRow+'</td>'+spprice+gotpricerow+quantRow+totalRow+deleteRow+'</tr>';
	$(tableid).append(row);
}


function changeTotalPrice(i){
	
	gotprice = Number($('#gotprice'+i).val());
	quant = Number($('#quant'+i).val());
	var total =gotprice*quant;
	//alert(total);
	$('#total'+i).val(total);
	
}

function removeRow(i){
	$('#row'+i+'').remove();
}

function addRow(){
	var id = $('#addStockBody tr:last').attr('id').substring(3);
	//alert(id);
	id=Number(id)+1;
	appendTableRow('#addStockBody',id);
	$('select').selectpicker('refresh');
}