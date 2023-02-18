@extends('layouts.app')
@section('content')
<!-- add product -->
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>		  
  <li class="active">Product</li>
</ol>
        <form class="form-horizontal" id="submitProductForm" action="/product/createProduct" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-plus"></i> Add Product</h4>
          </div>

          <div class="modal-body" style="max-height:450px; overflow:auto;">

              <div id="add-product-messages"></div>

              <div class="form-group">
                <label for="productImage" class="col-sm-3 control-label">Product Image: </label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                        <!-- the avatar markup -->
                            <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
                        <div class="kv-avatar center-block">					        
                            <input type="file" class="form-control" id="productImage" placeholder="Product Name" name="productImage" class="file-loading" style="width:auto;"/>
                        </div>
                      
                    </div>
            </div> <!-- /form-group-->	     	           	       

            <div class="form-group">
                <label for="productName" class="col-sm-3 control-label">Product Name: </label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="productName" placeholder="Product Name" name="productName" autocomplete="off" required>
                    </div>
            </div> <!-- /form-group-->	    

            <div class="form-group">
                <label for="quantity" class="col-sm-3 control-label">Quantity: </label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="quantity" placeholder="Quantity" name="quantity" autocomplete="off">
                    </div>
            </div> <!-- /form-group-->	        	 

            <div class="form-group">
                <label for="rate" class="col-sm-3 control-label">Rate: </label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="rate" placeholder="Rate" name="got_rate" autocomplete="off">
                    </div>
            </div> <!-- /form-group-->
            <div class="form-group">
              <label for="price" class="col-sm-3 control-label">Selling Price: </label>
              <label class="col-sm-1 control-label">: </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="price" placeholder="Selling price" name="price" autocomplete="off" required>
                  </div>
          </div> <!-- /form-group-->   	        

            <div class="form-group">
                <label for="brandName" class="col-sm-3 control-label">Brand Name: </label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      @php
                            $brands = DB::table('brands')->select('brand_id','brand_name')->where('brand_status',1)->where('brand_active',1)->get();
                      @endphp
                      <select class="form-control" id="brandName" name="brandName">
                          <option value="">~~SELECT~~</option>
                          @foreach ($brands as $brand)
                          <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                        @endforeach
                      </select>
                    </div>
            </div> <!-- /form-group-->	

            <div class="form-group">
                <label for="categoryName" class="col-sm-3 control-label">Category Name: </label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      @php
                          $categoreis = DB::table('categories')->select('categories_id','categories_name')->where('categories_status',1)->where('categories_active',1)->get();
                      @endphp
                      <select type="text" class="form-control" id="categoryName" placeholder="Product Name" name="categoryName" >
                          <option value="">~~SELECT~~</option>
                          @foreach ($categoreis as $category)
                            <option value="{{$category->categories_id}}">{{$category->categories_name}}</option>
                          @endforeach

                      </select>
                    </div>
            </div> <!-- /form-group-->					        	         	       

            <div class="form-group">
                <label for="productStatus" class="col-sm-3 control-label">Status: </label>
                <label class="col-sm-1 control-label">: </label>
                    <div class="col-sm-8">
                      <select class="form-control" id="productStatus" name="productStatus">
                          <option value="">~~SELECT~~</option>
                          <option value="1">Available</option>
                          <option value="2">Not Available</option>
                      </select>
                    </div>
            </div> <!-- /form-group-->	         	        
          </div> <!-- /modal-body -->
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
            
            <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
          </div> <!-- /modal-footer -->	      
         </form> <!-- /.form -->	     
@endsection