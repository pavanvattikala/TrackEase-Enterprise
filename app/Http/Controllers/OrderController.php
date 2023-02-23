<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function create(Request $request){
        //dd($request->all());
        $request->validate([
            'orderDate'=>'required',
            'clientName'=>'required',
            'clientContact'=>'required',
            'productName'=>'required',
            'paymentStatus'=>'required',
            'paid'=>'required'
        ]);
        
        $data = [
            "order_date"=>$request->orderDate,
            "client_name" => $request->clientName,
            "client_contact" => $request->clientContact,
            "sub_total" => $request->subTotalValue,
            "total_amount" => $request->totalAmountValue,
            "discount" => $request->discount,
            "grand_total" => $request->grandTotalValue,
            "paid" => $request->paid,
            "due" => $request->dueValue,
            "payment_type" => $request->paymentType,
            "payment_status" => $request->paymentStatus
        ];


        $total_items = count($request->productName); // getting no of products

        $order_id =  DB::table('orders')->insertGetId($data);


        for ($i=0; $i < $total_items; $i++) { 

            $order_item_data=[
                'order_id'=>$order_id,
                'product_id'=>$request->productName[$i],
                'quantity'=>$request->quantity[$i],
                'rate'=>$request->rateValue[$i],
                'total'=>$request->totalValue[$i]
            ];
            DB::table('order_items')->insert($order_item_data);
             
          }

          return redirect()->back()->with('success','Order is added sucessfully');  



    }
}
