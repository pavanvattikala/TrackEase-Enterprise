@extends('layouts.app')
@section('content')


<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li>Order</li>
	<li class="active">Manage Orders</li>
</ol>
  
  
<h4>
    <i class='glyphicon glyphicon-circle-arrow-right'></i>
    Manage Orders
</h4>
  
  
  
  <div class="panel panel-default">
	  <div class="panel-heading">
        Manage Orders
  
	  </div> <!--/panel-->	
	  @include('partials.error')  <!--/success-messages or error messages-->
	  <div class="panel-body">
        <table class="table" id="manageOrderTable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>						
                    <th>Customer Name</th>
                    <th>Customer Mobile</th>							
                    <th>Order Name</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Due Amount</th>
                    <th>Options</th>
                </tr>
            </thead>
        </table>
	  </div> <!--/panel-->	
  </div> <!--/panel-->	
  
  

  
  
  <script src="{{ asset('custom/js/order.js') }}"></script>
  
@endsection