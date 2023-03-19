<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //to retuen the produts list from the db
        $result = DB::table('product')
        ->join('brands', 'product.brand_id', '=', 'brands.brand_id')
        ->join('categories', 'product.categories_id', '=', 'categories.categories_id')
        ->select('product.product_id', 'product.product_name')
        ->where('product.status',1)
        ->get();

       // dd($result);

    //    $select ='<select name="productName[]" id="productName" data-live-search="true" class="selectpicker" id="my-select">Select Product';
    //    foreach($result as $res){
    //     $select.='<option value="'.$res->product_id.'">'.$res->product_name.'</option>';
    //    }


    //    $select.='</select>';
    //     return ($select);

        return ($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
