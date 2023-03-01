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
        <div class="panel-heading">Manage Service</div>
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
        </div> 
    </div> 
    
    <!-- remove Service -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeServiceModal">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Service</h4>
            </div>
            <div class="modal-body">
                <div class="removeServiceMessages"></div>
                <p>Do you really want to remove ?</p>
            </div>
            <div class="modal-footer removeServiceFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <form action="/service/trash" method="POST" id="removeServiceForm">
                    @csrf
                        <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </div>
        </div>
        </div>
    </div>

    
  
  <script src="{{ asset('custom/js/service.js') }}"></script>
  
@endsection