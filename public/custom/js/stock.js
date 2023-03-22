var manageStockTable;
var selectBrand;
var selectCategory;

var oldStockProductNameRow;

var currentPage;



var headingRow = '<tr><th>ProductName</th><th>SellingPrice</th><th>GotPrice</th><th>Quantity</th><th>TotalAmount</th> <th>Action</th></tr>';

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
		currentPage = "stock";
		manageStockTable = $("#manageStockTable").DataTable({
			'ajax': 'stock/fetchStock',
			'stock': []		
		});
	}

	if(last == "add_stock"){
		//api calls

		// brand api
		$.ajax({
			url: '/api/brandapi',
			type: 'get',
			success:function(response) {
				select ='<select name="brandName[]" id="brandName" required class="col-3" data-live-search="true" class="selectpicker" id="my-select">';
				select+='<option value="">-- Select Brand --</option>'
		
				response.forEach(obj => {
					select+='<option value="'+obj.brand_id+'">'+obj.brand_name+'</option>'
				});
				select+='</select>';
		
				selectBrand = select;
			} 
		});
		//category api
		$.ajax({
			url: '/api/categoryapi',
			type: 'get',
			success:function(response) {
				
				select ='<select name="categoryName[]" id="categoryName" class="col-3" data-live-search="true" class="selectpicker" id="my-select" required="true">';
				select+='<option value="">-- Select Category --</option>'
				response.forEach(obj => {
					select+='<option value="'+obj.categories_id+'">'+obj.categories_name+'</option>'
				});
				select+='</select>';
				selectCategory = select;
			} 
		});
		//product api
		$.ajax({
			url: '/api/productapi',
			type: 'get',
			async: false,
			success:function(response) {
				
				select ='<select name="productName[]" required id="productName" data-live-search="true" class="selectpicker" id="my-select">Select Product';
		
				response.forEach(obj => {
					select+='<option value="'+obj.product_id+'">'+obj.product_name+'</option>'
				});
				select+='</select>';
		
				oldStockProductNameRow = select;
			} 
		});

		currentPage = "addstock";
		//$("#getOldStock").click();
		$('#submit').attr('disabled',true);
		$('#addRow').attr('disabled',true);
		
	}

	
});

//appends row to the given selector
function appendTableRow(tableid,i,type="oldStock",subTableId=0){

	// if new stock

	if(type=="newStock"){
		newStockprodutNameRow ='<input type="text" name="productName[][]"';
		gotpricerow = '<td><input type="number"  min="1" required id="gotprice'+i+'" name="gotprice[][]" onkeyup="changeTotalPrice('+encodeURIComponent("'newStock'")+','+i+','+subTableId+')"></td>';
		spprice='<td><input type="number"  min="1" required id="spprice'+i+'" name="spprice[][]"></td>';
		quantRow = '<td><input type="number" min="1" required id="quant'+i+'" name="quant[][]" onkeyup="changeTotalPrice('+encodeURIComponent("'newStock'")+','+i+','+subTableId+')"></td>';
		totalRow = '<td><input type="number"  min="1" required id="total'+i+'" name="total[][]" readonly>';
		deleteRow = '<td><a class="btn bg-grey" onclick="removeRow('+encodeURIComponent("'newStock'")+','+i+','+subTableId+')"><i class="glyphicon glyphicon-remove text-danger"></i><span class="text-danger">Remove</span></a></td>'
		row='<tr id="row'+i+'">'+'<td>'+newStockprodutNameRow+'</td>'+spprice+gotpricerow+quantRow+totalRow+deleteRow+'</tr>';
		$(tableid).append(row);
	}
	else{
		gotpricerow = '<td><input type="number" min="1" required id="gotprice'+i+'" name="gotprice[]" onkeyup="changeTotalPrice('+i+')"></td>';
		spprice='<td><input type="number" min="1" required  id="spprice'+i+'" name="spprice[]"></td>';
		quantRow = '<td><input type="number" min="1" required  id="quant'+i+'" name="quant[]" onkeyup="changeTotalPrice('+i+')"></td>';
		totalRow = '<td><input type="number" min="1" required  id="total'+i+'" name="total[]" readonly>';
		deleteRow = '<td><a class="btn bg-grey" onclick="removeRow('+i+')"><i class="glyphicon glyphicon-remove text-danger"></i><span class="text-danger">Remove</span></a></td>'
		row='<tr id="row'+i+'">'+'<td>'+oldStockProductNameRow+'</td>'+spprice+gotpricerow+quantRow+totalRow+deleteRow+'</tr>';
		$(tableid).append(row);
	}
	
}

// to add price to total column via quantity and got price
function changeTotalPrice(type="oldStock",i,subTableId=0){
	if(type=="newStock"){
		gotprice = Number($('#newSubMainTableBody'+subTableId+'> #row'+i+' > td > #gotprice'+i).val());
		quant = Number($('#newSubMainTableBody'+subTableId+'> #row'+i+' > td > #quant'+i).val());
		var total =gotprice*quant;
		$($('#newSubMainTableBody'+subTableId+'> #row'+i+' > td > #total'+i)).val(total);


	}
	else{
		gotprice = Number($('#gotprice'+i).val());
		quant = Number($('#quant'+i).val());
		var total =gotprice*quant;
		//alert(total);
		$('#total'+i).val(total);
	}
	
	
	
}

// to remove the row 
function removeRow(type="oldStock",i,subTableId=0){
	if(type=="newStock"){
		
		//console.log(subTableId,i);
		$('#newSubMainTableBody'+subTableId+' > #row'+i+'').remove();

		innerRowsCount = Number($('#newSubMainTableBody'+subTableId+' tr').length);
		if(innerRowsCount<2){
			$('#newSubMainrow'+subTableId).remove();
		}
		totalRowsCount = Number($('#newStockTableBody tr').length);
		if(totalRowsCount  == 0){
			$('#newStockTableBody').remove();
		}
	}
	else{
		$('#row'+i+'').remove();
	}
	
}
// to add the extra row 
function addRow(type="oldStock",subTableId=0){
	if(type=="newStockBody"){
		var id = $('#newStockTableBody > tr[id^="newSubMainrow"]').last().attr('id').substring(13);
		id=Number(id)+1;
		appendNewStockRow(id,globalNewStockEntryOptions);
		$('select').selectpicker('refresh');
		
		
	}
	if(type=="newStockSubBody"){
		//console.log(subTableId);
		
		
		var id = $('#newSubMainTableBody'+subTableId+' tr:nth-last-child(2)').attr('id').substring(3);
		console.log(id);
		var lasttr = $('#subAddRowTr'+subTableId).clone();
		console.log(lasttr);
		$('#subAddRowTr'+subTableId).remove();
		id=Number(id)+1;
		appendTableRow('#newSubMainTableBody'+subTableId+'',id,"newStock",subTableId);
		$("#newSubMainTableBody"+subTableId).append(lasttr);
		$('select').selectpicker('refresh');
	}
	
	else{
		var id = $('#addStockBody').last().attr('id').substring(3);
		//alert(id);
		id=Number(id)+1;
		appendTableRow('#addStockBody',id);
		$('select').selectpicker('refresh');
	}
}
//to load old stock page
$("#getOldStock").click(function (e) { 
	$('#newStockTableBody').remove();

	if($('#addStockBody').length == 0){
		$('#addStockTable').append('<thead>'+headingRow+'</thead>');
		$('#addStockTable').append('<tbody id="addStockBody"></tbody>');

		for(i=0;i<10;i++){
			appendTableRow('#addStockBody',i);
		}
	
		$('select').selectpicker('refresh');
	
		$('#submit').attr('disabled',false);
		$('#addRow').attr('disabled',false);
		
	}
});
// to load new stock page
$("#getNewStock").click(function (e) {
	
	if($('#newStockTableBody').length==0){
		$('#addStockTable').empty();
		newStockEntryOptions = '<tr><th colspan="2"><label class="col-3">Select Brand :: </label>'+selectBrand+'</th><th colspan="2"><label class="col-3">Select Category :: </label>'+selectCategory+'</th></tr>';
		globalNewStockEntryOptions =newStockEntryOptions;
		$('#addStockTable').append('<tbody id="newStockTableBody"></tbody>');
		for(i=0;i<4;i++){
			appendNewStockRow(i,newStockEntryOptions);
		}
		$("#addRow").attr('onclick', 'addRow("newStockBody")');
		$('#submit').attr('disabled',false);
		$('#addRow').attr('disabled',false);

	}


});

function appendNewStockRow(i,newStockEntryOptions){
		$('#newStockTableBody').append('<tr id="newSubMainrow'+i+'"></tr>');
		$('#newSubMainrow'+i).append('<table class="table table-responsive table-stripped" id="newSubMainTable'+i+'"></table>');
		$('#newSubMainTable'+i).append('<thead id="newSubMainTableHead'+i+'"></thead>');
		$('#newSubMainTableHead'+i).append(newStockEntryOptions);
		$('#newSubMainTableHead'+i).append(headingRow);
		$('#newSubMainTable'+i).append('<tbody id="newSubMainTableBody'+i+'"></tbody>');
		
		for(j=0;j<5;j++){
			appendTableRow('#newSubMainTableBody'+i+'',j,"newStock",i);
		}
		$('#newSubMainTableBody'+i).append('<tr id="subAddRowTr'+i+'"><td><a class="btn btn-primary" id="subAddRow'+i+'" >Add Row</a></td></tr>');
		$("#subAddRow"+i).attr('onclick', 'addRow("newStockSubBody",'+i+')');

		$('select').selectpicker('refresh');
}