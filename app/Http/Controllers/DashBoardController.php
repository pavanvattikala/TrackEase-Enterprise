<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    //
    public function index(){

        //product count
        $countProduct = DB::table('product')->where('status',1)->get()->count();

        //order count
        $countOrder = DB::table('orders')->where('order_date',today())->where('status',1)->get()->count();

        //service count
        $countService = DB::table('service_data')->where('service_date',today())->where('status',1)->get()->count();


        
        //total revenue from orders
        $totalRevenueorder = DB::table('orders')->where('order_date',today())->where('status',1)->sum('paid');

        //total revenue from services
        $totalRevenueService = DB::table('service_data')->where('service_date',today())->where('status',1)->sum('paid_amt');

        $totalRevenue = $totalRevenueorder +  $totalRevenueService; // total revenue
        
        $lowStockCount = DB::table('product')->where('quantity','<=',3)->where('status',1)->get()->count(); // low stock count

        $data = [
            'countProduct'=>$countProduct,
            'countOrder'=>$countOrder,
            'countService'=>$countService,
            'totalRevenue'=>$totalRevenue,
            'lowStockCount'=>$lowStockCount

        ];

        return view('sv.dashboard')->with('data',$data);

    }

}
