var manageExpenseTable;

$(document).ready(function() {
	// top bar active
	$('#navExpense').addClass('active');
	
	// manage Expense table
	manageExpenseTable = $("#manageExpenseTable").DataTable({
		'ajax': 'expense/fetchExpense',
		'order': []		
	});

});

function editExpenses(ExpenseId = null) {
	if(ExpenseId) {

		$('#editExpenseId').remove();
		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		//$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		 $('.edit-Expense-result').addClass('div-hide');
		// // modal footer
		 $('.editExpenseFooter').addClass('div-hide');

		 $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			
			url: 'Expense/fetchSelectedExpense',
			type: 'post',
			data: {
				ExpenseId : ExpenseId
			},
			dataType: 'json',
			success:function(response) {

				//hide  modal loading
				$('.modal-loading').addClass('div-hide');
				// add modal result
				$('.edit-Expense-result').removeClass('div-hide');
				// add  modal footer
				$('.editExpenseFooter').removeClass('div-hide');

				$(".editExpenseFooter").append('<input type="hidden" name="editExpenseId" id="editExpenseId" value="'+ExpenseId+'" />');				


				$('#editExpenseId').val(ExpenseId);

				$("#editExpenseName").val(response.Expense_name);
				var option = response.Expense_active;
				//console.log($("#editExpenseStatus option:eq(2)"))
				$('#editExpenseActiveStatus option:eq('+option+')').attr('selected', true);

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} 

function removeExpenses(ExpenseId = null){
	if(ExpenseId) {
		$("#removeExpenseForm").append('<input type="hidden" name="removeExpenseId" id="removeExpenseId" value="'+ExpenseId+'" />');				

	} else {
		alert('error!! Refresh the page again');
	}
}