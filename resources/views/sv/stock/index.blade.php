@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="/">Home</a></li>		  
		  <li class="active">Stock</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Stock</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
                <div class="div-action pull pull-right" style="padding-bottom:20px;">
					<a href="stock/add_stock"><button class="btn btn-default button1"> <i class="glyphicon glyphicon-plus-sign"></i> Add Stock </button></a>
				</div>

				<div class="remove-messages"></div>
                @include('partials.error')			
				
				<table class="table" id="manageStockTable">
					<thead>
						<tr>
							<th style="width:10%;">Stock Id</th>	
							<th>Stock Type</th>						
							<th>Delear Name</th>
							<th>Amount</th>
							<th>Date</th>
							<th>Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				
			</div> 
		</div>
	</div> 
</div> 

<script src="{{ asset('custom/js/stock.js') }}"></script>
@endsection