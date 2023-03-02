@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="/">Home</a></li>		  
		  <li class="active">Day Sheet</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Day Activites</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>
				@include('partials.error')
                

                <div class="row flex" style="padding-bottom:20px;">
                    <div class="col-md-4">
                        <label for="orderDate">From Date</label>
                        <input type="date" class="form-control" id="fromOrderDate" name="fromOrderDate" onchange="getactivites()" value="{{date('Y-m-d')}}" />
                    </div>
                    <div class="col-md-4">
                        <label for="orderDate">To Date</label>
                        <input type="date" class="form-control" id="toOrderDate" name="toOrderDate" onchange="getactivites()" value="{{date('Y-m-d')}}" />
                    </div>
                </div>
				
				<table class="table table-hover table-striped" id="manageDaySheetTable" >
					<thead>
						<tr>							
							<th>Activity Type</th>
							<th>Amount</th>
							<th style="width:15%;">View In detail</th>
						</tr>
					</thead>
				</table>

			</div> 
		</div> 
	</div>
</div>


<script src="custom/js/daySheet.js"></script>

@endsection