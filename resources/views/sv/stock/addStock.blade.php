@extends('layouts.app')
@section('content')
<style>
	input:read-only{
	  background-color: #706b6b70  !important;
	}

    input[type=submit]{
        background-color: #419641 !important;
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
                        <select class="form-control" name="dealer" id="dealer"  data-live-search="true" required>
                            <option value="">~~SELECT Dealer~~</option>
                            @foreach ($dealers as $dealer)
                                <option value="{{$dealer->id}}">{{$dealer->name}}</option>
                            @endforeach
                        </select>	
                    </div>
                </div>
                <div class="container" id="topStockEntryMenu">
                    <div class="form-group row">
                        <a class="btn btn-primary col-3" id="getNewStock">New Stock Entry</a> 
                        <a class="btn btn-primary col-3" id="getOldStock">old Stock Entry</a> 
                    </div> 
                    <div class="modal-loading" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>
                    {{-- <div  class="form-group row ">
                        <select name="brand" id="brand"  data-live-search="true" >
                            <option value="1">surya</option>
                        </select>
                        <select  name="brand" id="brand"  data-live-search="true" >
                            <option value="1">surya</option>
                        </select>
                    </div>  --}}
                    
                </div>
                
                <table class="table table-responsive table-stripped table-borderd" id="addStockTable" border="1">
                </table>

                <div class="form-group row">
                    <a class="btn btn-primary col-3" id="addRow" onclick="addRow()">Add Row</a> 
                    <input class="btn col-3 btn-success" type="submit" id="submit"value="Submit">
                </div> 
                    	   
                </form>
			</div> 
		</div>
	</div> 
</div> 


<script src="{{ asset('custom/js/stock.js') }}"></script>
@endsection