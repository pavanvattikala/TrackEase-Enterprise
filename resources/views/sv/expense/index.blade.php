@extends('layouts.app')
@section('content')
    
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="/">Home</a></li>		  
		  <li class="active">Expense</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Expense</div>
			</div> 
			<div class="panel-body">

				<div class="remove-messages"></div>
				@include('partials.error')

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addExpenseModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Expense </button>
				</div> 	
				
				<table class="table" id="manageExpenseTable">
					<thead>
						<tr>							
							<th>Expense Name</th>
							<th>Date</th>
							<th>Amount</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
			</div> 
		</div> 
</div> 

{{-- add Expense --}}
<div class="modal fade" id="addExpenseModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitExpenseForm" action="expense/createExpense" method="POST">
			@csrf
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Expense</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-Expense-messages"></div>

	        <div class="form-group">
	        	<label for="expenseName" class="col-sm-3 control-label">Expense Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="expenseName" placeholder="Expense Name" name="expenseName" autocomplete="off">
				    </div>
	        </div>         	        
	        <div class="form-group">
	        	<label for="expenseAmount" class="col-sm-3 control-label">Amount: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
						<input type="number" name="expenseAmount" id="expenseAmount">
				    </div>
	        </div>        	        

	      </div> 
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createExpenseBtn" data-loading-text="Loading..." autocomplete="off">Add Expense</button>
	      </div>     
     	</form>   
    </div>
  </div>
</div>


<!-- edit Expense -->
<div class="modal fade" id="editExpenseModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editExpenseForm" action="Expense/editExpense" method="POST">
			@csrf
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Expense</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-Expense-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
				<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
				<span class="sr-only">Loading...</span>
			</div>

			<div class="edit-Expense-result">
				<div class="form-group">
					<label for="editExpenseName" class="col-sm-3 control-label">Expense Name: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="editExpenseName" placeholder="Expense Name" name="editExpenseName" autocomplete="off">
						</div>
				</div>        	        
				<div class="form-group">
					<label for="editExpenseActiveStatus" class="col-sm-3 control-label">Status: </label>
					<label class="col-sm-1 control-label">: </label>
						<div class="col-sm-8">
							<select class="form-control" id="editExpenseActiveStatus" name="editExpenseActiveStatus">
								<option value="">~~SELECT~~</option>
								<option value="1">Available</option>
								<option value="2">Not Available</option>
							</select>
						</div>
				</div>
			</div>  
	      </div>
	      
	      <div class="modal-footer editExpenseFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editExpenseBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
     	</form>
    </div>
  </div>
</div>


<!-- remove Expense -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Expense</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeExpenseFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
		<form action="/Expense/trash" method="post" id="removeExpenseForm">
			@csrf
			<input  class="btn btn-danger" type="submit" value="Delte Expense">
		</form>
      </div>
    </div>
  </div>
</div>

<script src="custom/js/expense.js"></script>

@endsection
