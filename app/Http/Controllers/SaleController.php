<?php

namespace App\Http\Controllers;

use App\View\Components\SaleItemComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //

    public function getSaleItems(){
        $products = DB::table('product')
        ->join('brands', 'product.brand_id', '=', 'brands.brand_id')
        ->join('categories', 'product.categories_id', '=', 'categories.categories_id')
        ->select('product.product_id as product_id', 'product.product_name as product_name')
        ->where('product.status',1)
        ->get();
        
        $services = DB::table('service_types')
        ->select('service_type_id as service_id', 'service_type_name as service_name')
        ->get();


        $result = $products->merge($services);

        return json_encode($result);
    }

    public function getSaleItemComponent(Request $request){
        $itemId = $request->itemId;
        $itemType = $request->itemType;


        if($itemType=="service"){
            $service_price = $request->service_price;

            $item = DB::table('service_types')
            ->select('service_type_id as id', 'service_type_name as name')
            ->where('service_type_id',$itemId)
            ->first();


            $item->price=$service_price;

            $item->id="s".$item->id;
           
        }
        else{
            
            $item = DB::table('product')
            ->join('brands', 'product.brand_id', '=', 'brands.brand_id')
            ->join('categories', 'product.categories_id', '=', 'categories.categories_id')
            ->select('product.product_id as id', 'product.product_name as name','product.selling_price as price')
            ->where('product.product_id',$itemId)
            ->where('product.status',1)
            ->first();
            $item->id="p".$item->id;
        }

        

        $html = view('components.sale-item-component',compact('item'))->render();


        return $html;
    }
    
}
