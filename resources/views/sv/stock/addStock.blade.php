@extends('layouts.app')
@section('content')
<style>
	input:read-only{
	  background-color: #706b6b70  !important;
	}
  </style>
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="/">Home</a></li>		  
		  <li class="active">Stock</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Add Stock</div>
			</div> <!-- /paneDealerl-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>
                @include('partials.error')			

                <form action="/stock/insert_stock" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="date" class="col-sm-2 control-label"> Date</label>
                    <div class="col-sm-5">
                      <input type="date" class="form-control" id="date" name="date" value="{{date('Y-m-d')}}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dealer" class="col-sm-2 control-label"> Select Dealer</label>
                    <div class="col-sm-5">
                        <select class="form-control" name="dealer" id="dealer">
                            <option value="">~~SELECT Dealer~~</option>
                            @foreach ($dealers as $dealer)
                                <option value="{{$dealer->id}}">{{$dealer->name}}</option>
                            @endforeach
                        </select>	
                    </div>
                </div>
                <div class="form-group row">
                    <a class="btn btn-primary col-3">New Stock Entry</a> 
                    <a class="btn btn-primary col-3">old Stock Entry</a> 
                    <a class="btn btn-primary col-3">Stock as Excel Entry</a> 
                    <a class="btn btn-primary col-3">Submit</a> 
                </div> 
                
                <table class="table table-responsive table-stripped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Selling Price</th>
                            <th>Got Price</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="addStockBody">
                        
                    </tbody>
                </table>

                <div class="form-group row">
                    <a class="btn btn-primary col-3" onclick="addRow()">Add Row</a> 
                    <input class="btn btn-success col-3" type="submit" value="Submit">
                </div> 
                    	   
                </form>
			</div> 
		</div>
	</div> 
</div> 


<script src="{{ asset('custom/js/stock.js') }}"></script>
@endsection