@extends('layouts.app')
@section('content')


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li><a href="/service">Service</a></li>
	<li class="active">Add Service Type</li>
</ol>
  
  
  <h4>
	  <i class='glyphicon glyphicon-circle-arrow-right'></i>
	  Add Service Type
  </h4>
  
  
  
  <div class="panel panel-default">
	  <div class="panel-heading">
				Add Service Type
  
	  </div> <!--/panel-->	
	  @include('partials.error')
	  <div class="panel-body">
					  
  
			  <div class="success-messages"></div> <!--/success-messages-->
  
			<form class="form-horizontal" method="POST" action="/service/insert_service_type">
				@csrf
  
				<div class="form-group">
				  <label for="serviceTypeName" class="col-sm-2 control-label">Service Type Name</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="serviceTypeName" name="serviceTypeName" placeholder="Enter the Service Name"/>
				  </div>
                  <div class="col-sm-12">
                    <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign" ></i> Add Service Type</button>
                  </div>
				</div> <!--/form-group-->
            
            </form>

            <table class="table" id="manageServiceTypesTable">
                <thead>
                    <tr>
                        <th>Sno</th>

                        <th>Service Type Name</th>
                    </tr>
                </thead>
            </table>
  
	  </div> <!--/panel-->	
  </div> <!--/panel-->	

  <script>

    
$(document).ready(function() {


// top nav bar 
$("#navService").addClass('active');

manageProductTable = $('#manageServiceTypesTable').DataTable({
    'ajax': '/service/fetchServiceTypes',
    'serviceNames': [],
    
}); // call the data table

}); // /documernt
  </script>
  
  
  
@endsection