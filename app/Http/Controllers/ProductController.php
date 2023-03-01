<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function fetchProduct(){
        $result = DB::table('product')
        ->join('brands', 'product.brand_id', '=', 'brands.brand_id')
        ->join('categories', 'product.categories_id', '=', 'categories.categories_id')
        ->select('product.product_id', 'product.product_name', 'product.product_image', 'product.brand_id',
        'product.categories_id', 'product.quantity', 'product.selling_price', 'product.active', 'product.status', 
        'brands.brand_name', 'categories.categories_name')
        ->where('product.status',1)
        ->get();

        //var_dump($result);

        
        foreach($result as $item) { 
            $active = ""; 
            $productId = $item->product_id;
            // active 
            if($item->active == 1) {
                // activate member
                $active = "<label class='label label-success'>Available</label>";
            } else {
                // deactivate member
                $active = "<label class='label label-danger'>Not Available</label>";
            } // /else

            $button = '<!-- Single button -->
            <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a type="button" href="" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                <li><a type="button" href="" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
            </ul>
            </div>';

            $brand = $item->brand_name;
            $category = $item->categories_name;

            $imageUrl = substr($item->product_image, 3);
            $productImage = "<img class='img-round' src='".$imageUrl."' style='height:30px; width:50px;'  />";

            //setting red colur to less stock quntity

            $quanity='<span>'.$item->quantity.'</span>';
            
            if($item->quantity<0){
                $quanity='<span style="color:red">'.$item->quantity.'</span>';
            }

            $output['data'][] = array( 		
                // image
                $productImage,
                // product name
                $item->product_name, 
                // selling_price
                $item->selling_price,
                // quantity 
                $quanity, 		 	
                // brand
                $brand,
                // category 		
                $category,
                // active
                $active,
                // button
                $button 		
                ); 	
        } // /while 



        echo json_encode($output);
    }
    public function create(Request $request){
        //dd($request->all());
        $request->validate([
            'productName'=>'required',
            'quantity'=>'required',
            'got_rate'=>'required',
            'price'=>'required',
            'brandName'=>'required',
            'categoryName'=>'required',
            'productStatus'=>'required',
        ]);

        $data=[
            'product_image'=>null,
            'product_name'=>$request->productName,
            'quantity'=>$request->quantity,
            'got_rate'=>$request->got_rate,
            'selling_price'=>$request->price,
            'brand_id'=>$request->brandName,
            'categories_id'=>$request->categoryName,
            'active'=>$request->productStatus,
            
        ];

        DB::table('product')->insert($data);

        return redirect('/product');


    }
    public function fetchSelectedProduct(Request $request){
        $request->validate([
            'productId'=>'required'
        ]);

       $productId = $request->productId;

       //dd($productId);


       if($request->editProductinfo === "yes"){
            $result = DB::table('product')
            ->join('brands', 'product.brand_id', '=', 'brands.brand_id')
            ->join('categories', 'product.categories_id', '=', 'categories.categories_id')
            ->select('product.product_id', 'product.product_name','brands.brand_id','product.quantity','product.selling_price','product.categories_id','product.active')
            ->where('product.status',1)
            ->where('product_id',$productId)
            ->get()->first();       
        }
       else{
        $result = DB::table('product')->select('selling_price')->where('product_id',$productId)->first();
       
       }
       return json_encode($result);

       $result = DB::table('product')->select('selling_price')->where('product_id',$productId)->first();
       return json_encode($result);
    }
    public function fetchProductData(){
        $result = DB::table('product')
        ->join('brands', 'product.brand_id', '=', 'brands.brand_id')
        ->join('categories', 'product.categories_id', '=', 'categories.categories_id')
        ->select('product.product_id', 'product.product_name')
        ->where('product.status',1)
        ->get()->first();

       // dd($result);

        return json_encode($result);

        
    }

    public function trash(Request $request){
        $request->validate([
            'removeProductId'=>'required'
        ]);

        $removeProductId = $request->removeProductId;

        DB::table('product')->where('product_id',$removeProductId)->update(['status'=>0,'updated_at'=>today()]);

        return redirect('/product')->with('success','Product Deleted Sucessfully');
    }

    public function editProduct(Request $request){
       // dd($request->all());
        $request->validate([
            "editProductName" => "required",
            "editQuantity" => "required",
            "editRate" => "required",
            "editBrandName" => "required",
            "editCategoryName" => "required",
            "editProductStatus" => "required",
            "productId" => "required"
        ]);

        $data = array(
            'product_name' => $request->editProductName,
            'quantity'  =>  $request->editQuantity,
            'selling_price'  =>  $request->editRate,
            'brand_id'  =>  $request->editBrandName,
            'categories_id'  =>  $request->editCategoryName,
            'active'  =>  $request->editProductStatus,
            'updated_at' => today()
        );


        DB::table('product')->where('product_id',$request->productId)->update($data);

        return redirect('/product')->with('success','Product Edited Sucessfully');

        
    }
}
