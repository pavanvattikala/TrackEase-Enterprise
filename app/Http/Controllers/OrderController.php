<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //to create an order
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

            // update the product table colums
            DB::table('product')->where('product_id',$request->productName[$i])->decrement('quantity',$request->quantity[$i]);
            DB::table('product')->where('product_id',$request->productName[$i])->update(['updated_at'=>today()]);

             
          }

          return redirect()->back()->with('success','Order is added sucessfully');  



    }

    // to fetch the order from the api call
    public function fetchOrders(){
        $orders_data = DB::table('orders')->orderBy('order_date','desc')->get();

        //dd($orders_data);

        foreach($orders_data as $order) { 

           // dd($order);
            
            $order_id = $order->order_id;

            $button = '<!-- Single button -->
            <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
            <li><a type="button" data-toggle="modal" href="/orders/manage/view_order/'.$order_id.'"> <i class="glyphicon glyphicon-search"></i>View / Edit</a></li> 
                <li><a type="button" href="" onclick="removeOrder('.$order_id.')" data-toggle="modal" data-target="#removeOrder"> <i class="glyphicon glyphicon-trash"></i><span style="color:red">Delete</span></a></li>
                <li><a type="button" data-toggle="modal" href="/orders/print/'.$order_id.'"> <i class="glyphicon glyphicon-print"></i>Print</a></li>
            </ul>
            </div>';

            $order_date = date('d-m-Y',strtotime($order->order_date));
            $client_name = $order->client_name;
            $client_mobile = $order->client_contact;
            // to display the orders names
            $product_name  = DB::table('order_items')
            ->join('product', 'order_items.product_id', '=', 'product.product_id')
            ->where('order_items.order_id',$order_id)
            ->select('product.product_name',)
            ->get();
            
            $order_name=""; // empty string

            foreach($product_name as $name){
                $order_name=$name->product_name.",  ".$order_name; // appending the strings
            }

            $order_name= substr($order_name, 0, -3); // removing the last , from the attached string



            $total_amount = $order->total_amount;

            $paid_amt = $order->paid;
            $due_amt = $order->due;
            $val='<span style="color:green">'.$due_amt.'</span>';
            
            if($due_amt>0){
                $val='<span style="color:red">'.$due_amt.'</span>';
            }

            $output['data'][] = array( 		
                $order_id,
                $order_date, 
                $client_name,
                $client_mobile, 		 	
                $order_name,
                $total_amount,
                $paid_amt,
                $val,

                $button 		
                ); 	
            
        }; 

        echo json_encode($output);

    }

    // to trash the order
    public function removeOrder(Request $request){
        $request->validate([
            'orderId'=>'required'
        ]);

        $orderId = $request->orderId;
        DB::table('order_items')->where('order_id', $orderId)->delete();
        DB::table('orders')->where('order_id', $orderId)->delete();

        $messege= "Order ".$orderId." is sucessfully deleted";

        return redirect()->back()->with('success',$messege);
    }
    
    // to view or edit the order
    public function viewOrder($orderId)
    {
        $orderData = DB::table('orders')->join('order_items','order_items.order_id','=','orders.order_id')->where('orders.order_id',$orderId)->get();


        //dd($orderData);

        $orderCount = count($orderData);


        foreach($orderData as $order){
            //elemets that dont repeat
            $orderDate=$order->order_date;
            $clientName = $order->client_name;
            $clientContact = $order->client_contact;
            $subTotal = $order->sub_total;
            $totalAmount = $order->total_amount;
            $discount = $order->discount;
            $grandTotal = $order->grand_total;
            $paid = $order->paid;
            $due = $order->due;
            $paymentType = $order->payment_type;
            $paymentStatus = $order->payment_status;

            //elemets that repeat

            $productId [] = $order->product_id;

            $qunatity [] = $order->quantity;

            $rate [] = $order->rate;

            $total [] = $order->total;
        }


        $data = [
            //single time 
            "orderDate"=>$orderDate,
            "clientName" =>$clientName,
            "clientContact" => $clientContact,
            "subTotal" => $subTotal,
            "totalAmount" => $totalAmount,
            "discount" => $discount,
            "grandTotal" => $grandTotal,
            "paid" => $paid,
            "due" => $due,
            "paymentType" => $paymentType,
            "paymentStatus" => $paymentStatus,
            //elements that repeat
            "productId"=>$productId,
            "quantity" => $qunatity,
            "rate" =>$rate,
            "total"=> $total,

            // count

            "orderCount"=>$orderCount
        ];
       // dd($data);

        return view('sv.order.view_order')->with('data',$data);
    }
}
