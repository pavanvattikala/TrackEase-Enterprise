<?php

namespace App\Http\Controllers;

use App\View\Components\SaleItemComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //

    public function getSaleItems(){
        $result = DB::table('product')
        ->join('brands', 'product.brand_id', '=', 'brands.brand_id')
        ->join('categories', 'product.categories_id', '=', 'categories.categories_id')
        ->select('product.product_id', 'product.product_name')
        ->where('product.status',1)
        ->get();

        return json_encode($result);
    }

    public function getSaleItemComponent(Request $request){
        $itemId = $request->itemId;
        $itemType = $request->itemType;


        $item = DB::table('product')
        ->join('brands', 'product.brand_id', '=', 'brands.brand_id')
        ->join('categories', 'product.categories_id', '=', 'categories.categories_id')
        ->select('product.product_id', 'product.product_name','product.selling_price')
        ->where('product.product_id',$itemId)
        ->where('product.status',1)
        ->first();

        $html = view('components.sale-item-component',compact('item'))->render();


        return $html;
    }
}
