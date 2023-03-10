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
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Add Stock</div>
			</div> <!-- /paneDealerl-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>
                @include('partials.error')			

                <form action="/stock/insert_stock" method="post" enctype="multipart/form-data">>
                @csrf
                <div class="form-group">
                    <label for="date" class="col-sm-2 control-label"> Date</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="date" name="date" value="{{date('Y-m-d')}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="dealer" class="col-sm-2 control-label"> Select Dealer</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="dealer" id="dealer">
                            <option value="">~~SELECT Dealer~~</option>
                            @foreach ($dealers as $dealer)
                                <option value="{{$dealer->id}}">{{$dealer->name}}</option>
                            @endforeach
                        </select>	
                    </div>
                </div>  	           	       
                    
                  <div class="form-group">
                    <label for="stockFile" class="col-sm-2 control-label">Select Stock File: </label>
                        <div class="col-sm-8">
                                <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
                            <div class="kv-avatar center-block">					        
                                <input type="file" class="form-control" id="stockFile" placeholder="Stock File" name="stockFile" class="file-loading" style="width:auto;" accept=".xlsx" />
                            </div>
                          
                        </div>
                </div>	   
                </form>
			</div> 
		</div>
	</div> 
</div> 

<script src="{{ asset('custom/js/stock.js') }}"></script>
@endsection