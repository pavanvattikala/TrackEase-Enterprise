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
  
 
  
{{-- for deletion of order --}}
<!-- Modal --> 
<div class="modal fade" id="removeOrder" tabindex="-1" role="dialog" aria-labelledby="removeOrderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="removeOrderLabel">Are you sure you want to delete :: <span id="removeOrderId"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <b>This process cannot be reversed are you sure ??</b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <form action="/orders/removeOrder" method="POST">
            @csrf
            <input type="hidden" name="orderId" id="formRemoveOrderId"value="">
            <input class="btn btn-danger" type="submit" value="Delete">
          </form>
          
        </div>
      </div>
    </div>
  </div>
  
  
  <script src="{{ asset('custom/js/order.js') }}"></script>
  
@endsection