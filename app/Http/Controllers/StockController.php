<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function fetchStock()
    {
        $data['data']=[
            '0'=>['1','Ramana','50,000','22-03-2023','verifies','none'],
        ];

       return json_encode($data);
    }

    public function add_stock()
    {
        # code...
        $dealers = DB::table('dealers')->select('id','name')->get();
        return view('sv.stock.addStock')->with('dealers',$dealers);
    }
    public function insertStock(Request $request)
    {
        dd($request->all());
    }

    public function getStockEntryOptions()
    {
        
    }
}
