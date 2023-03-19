@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="/">Home</a></li>		  
		  <li class="active">Product</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Product</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>
        @include('partials.error')

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<a href="product/add_product"><button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn"> <i class="glyphicon glyphicon-plus-sign"></i> Add Product </button></a>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageProductTable">
					<thead>
						<tr>
							<th style="width:10%;">Photo</th>		
              <th>Brand</th>
							<th>Product Name</th>
              <th>Category</th>
							<th>Rate</th>							
							<th>Quantity</th>
							<th>Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->



<!-- /add categories -->



<!-- /categories brand -->

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Product</h4>
      </div>
      <div class="modal-body">

      	<div class="removeProductMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <form action="/product/trash" method="post" id="removeProductForm">
          @csrf
          <input type="submit" class="btn btn-danger" value="Delete">
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- edit categories brand -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
                  
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Product</h4>
            </div>
            <div class="modal-body" style="max-height:450px; overflow:auto;">
  
                <div class="div-loading">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                          <span class="sr-only">Loading...</span>
                </div>
  
                <div class="div-result">
  
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
                      <li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Product Info</a></li>    
                    </ul>
  
                    <!-- Tab panes -->
                    <div class="tab-content">
  
                        
                      <div role="tabpanel" class="tab-pane active" id="photo">
                          <form action="product/editProductImage" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                          <br />
                          <div id="edit-productPhoto-messages"></div>
  
                          <div class="form-group">
                          <label for="editProductImage" class="col-sm-3 control-label">Product Image: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">							    				   
                                <img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
                              </div>
                      </div> <!-- /form-group-->	     	           	       
                          
                        <div class="form-group">
                          <label for="editProductImage" class="col-sm-3 control-label">Select Photo: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                      <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
                                  <div class="kv-avatar center-block">					        
                                      <input type="file" class="form-control" id="editProductImage" placeholder="Product Name" name="editProductImage" class="file-loading" style="width:auto;"/>
                                  </div>
                                
                              </div>
                      </div>	     	           	       
  
                      <div class="modal-footer editProductPhotoFooter">
                          <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                          
                        </div>
                        </form>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="productInfo">
                          <form class="form-horizontal" id="editProductForm" action="product/editProduct" method="POST">
                            @csrf				    
                          <br />
  
                          <div id="edit-product-messages"></div>
  
                          <div class="form-group">
                          <label for="editProductName" class="col-sm-3 control-label">Product Name: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="editProductName" placeholder="Product Name" name="editProductName" autocomplete="off">
                              </div>
                      </div> <!-- /form-group-->	    
  
                      <div class="form-group">
                          <label for="editQuantity" class="col-sm-3 control-label">Quantity: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="editQuantity" placeholder="Quantity" name="editQuantity" autocomplete="off">
                              </div>
                      </div>        	 
  
                      <div class="form-group">
                          <label for="editRate" class="col-sm-3 control-label">Rate: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="editRate" placeholder="Rate" name="editRate" autocomplete="off">
                              </div>
                      </div>     	        
  
                      <div class="form-group">
                          <label for="editBrandName" class="col-sm-3 control-label">Brand Name: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <select class="form-control" id="editBrandName" name="editBrandName">
                                    <option value="">~~SELECT~~</option>
                                    @php
                                      $brands = DB::table('brands')->select('brand_id','brand_name')->get();
                                    @endphp
                                    @foreach ($brands as $brand)
                                      <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                              </div>
                      </div> 	
  
                      <div class="form-group">
                          <label for="editCategoryName" class="col-sm-3 control-label">Category Name: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <select type="text" class="form-control" id="editCategoryName" name="editCategoryName" >
                                    <option value="">~~SELECT~~</option>
                                    @php
                                    $categories_name = DB::table('categories')->select('categories_id','categories_name')->get();
                                  @endphp
                                  @foreach ($categories_name as $category)
                                    <option value="{{ $category->categories_id }}">{{ $category->categories_name }}</option>
                                  @endforeach
                                </select>
                              </div>
                      </div> 					        	         	       
  
                      <div class="form-group">
                          <label for="editProductStatus" class="col-sm-3 control-label">Status: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <select class="form-control" id="editProductStatus" name="editProductStatus">
                                    <option value="">~~SELECT~~</option>
                                    <option value="1">Available</option>
                                    <option value="2">Not Available</option>
                                </select>
                              </div>
                      </div>	         	        
  
                      <div class="modal-footer editProductFooter">
                          <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                          
                          <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                        </div> 				     
                      </form> 	     	
                      </div>    
                    </div>
                  </div>   
            </div> 
      </div>
    </div>
  </div>


<script src="custom/js/product.js"></script>

    
@endsection