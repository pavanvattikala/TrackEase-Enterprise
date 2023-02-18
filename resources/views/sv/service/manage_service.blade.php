@extends('layouts.app')
@section('content')


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li>Service</li>
	<li class="active">Manage Service</li>
</ol>
  
  
<h4>
    <i class='glyphicon glyphicon-circle-arrow-right'></i>
    Manage Service
</h4>
  
  
  
  <div class="panel panel-default">
	  <div class="panel-heading">
        Manage Service
  
	  </div> <!--/panel-->	
	  @include('partials.error')  <!--/success-messages or error messages-->
	  <div class="panel-body">
        <table class="table" id="manageServiceTable">
            <thead>
                <tr>
                    <th>Service ID</th>
                    <th>Service Date</th>						
                    <th>Customer Name</th>
                    <th>Customer Mobile</th>							
                    <th>Service Name</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Due Amount</th>
                    <th>Options</th>
                </tr>
            </thead>
        </table>
	  </div> <!--/panel-->	
  </div> <!--/panel-->	
  
  

  
  
  <script src="{{ asset('custom/js/service.js') }}"></script>
  
@endsection