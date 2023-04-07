<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function fetchStock()
    {
        $data = DB::table('stock')->get();

        $output=[];

        
        
        foreach($data as $item){
            $button = '<!-- Single button -->
        <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a type="button" href="" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$item->id.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
            <li><a type="button" href="" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$item->id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
        </ul>
        </div>';

           // dd($item);
            $output['data'][] = array( 	
                
                $item->id,
                $item->stock_type,
                $item->dealer,
                $item->amount,
                $item->created_at,
                $item->status,
                $button
            ); 	
        }



        echo json_encode($output);
    }

    public function add_stock()
    {
        # code...
        $dealers = DB::table('dealers')->select('id','name')->get();
        return view('sv.stock.addStock')->with('dealers',$dealers);
    }
    public function insertStock(Request $request)
    {
       // dd($request->all());
        //stock values

        $totalStockAmount=0;

        $typeOfStock = $request->type;

        $product_set= [];

        //----

        $request->validate([
            'date'=>'required',
            'dealer'=>'required',
            'brandName'=> $typeOfStock=="newStock" ? 'required' : 'nullable',
            'categoryName'=> $typeOfStock=="newStock" ? 'required' : 'nullable',
            'productName'=>'required',
            'spprice'=>'required',
            'gotprice'=>'required',
            'quant'=>'required',
            'total'=>'required',

        ]);
        
        //dd("ok");

        $dealer = $request->dealer;  // stock value

        $date = $request->date;
        $productName =$request->productName;
        $spprice =$request->spprice;
        $gotprice =$request->gotprice;
        $quant =$request->quant;
        $total =$request->total;


        if($typeOfStock=="oldStock"){

            

           $len = count($productName);
           $data =[];

           for($i=0;$i<$len;$i++){
            $var=[];    
            $var['product_id']=$productName[$i];
            $var['got_rate']=$gotprice[$i];
            $var['selling_price']=$spprice[$i];
            $var['quantity']=$quant[$i];
            $var['total']=$total[$i];
            array_push($data, $var);
           }

           //dd($data);

           foreach ($data as $item) {

            $produtId=$item['product_id'];

            //dd($item);

            $value =[
                "updated_at"=>today(),
                "got_rate"=>$item['got_rate'],
                "selling_price"=>$item['selling_price'],
                "quantity"=>$item['quantity']
            ];
            
            DB::table('product')->where('product_id',$produtId)->update($value);

            array_push($product_set, $produtId); //product _sets


            $totalStockAmount+=$item['total']; // total amount


           }

            
        }
        else if($typeOfStock=="newStock"){

           // dd($request->all());
            $brandName = $request->brandName;
            $categoryName = $request->categoryName;

            $len = count($productName); // old without the order
            $data =[];

            $productNames = []; // with the order

            foreach($productName as $p){
                array_push($productNames, $p);
            }
           // dd($productNames);
 
            for($i=0;$i<$len;$i++){
               

             $var=[];    
             $var['product_name']=$productNames[$i];
             $var['got_rate']=$gotprice[$i];
             $var['selling_price']=$spprice[$i];
             $var['brand_id']=$brandName[$i];
             $var['categories_id']=$categoryName[$i];
             $var['quantity']=$quant[$i];
             $var['total']=$total[$i];
             
             array_push($data, $var);
            }
 
            //dd($data);
 
            foreach ($data as $item) {

                $items_len = count($item['product_name']);


                //dd($item);

                for($i=0;$i<$items_len;$i++){

                    $value =[
                            "product_name"=>$item['product_name'][$i],
                            "got_rate"=>$item['got_rate'][$i],
                            "selling_price"=>$item['selling_price'][$i],
                            "quantity"=>$item['quantity'][$i],
                            "brand_id"=>$item['brand_id'],
                            "categories_id"=>$item['categories_id'],
                            "active"=>1
                        ];

                    //dd($value);

                $p_id = DB::table('product')->insertGetId($value);

                array_push($product_set, $p_id); // adding items to stock_product_set_array

                }

                $totalStockAmount+=array_sum($item['total']); // total amount

            }

        }

        // for stock

       // dd($product_set);

       $stock_name =$typeOfStock." app";
       $stock_values = [

        "stock_name"=>$stock_name,
        "stock_type"=>$typeOfStock,
        "dealer"=>$dealer,
        "amount"=>$totalStockAmount,
        "created_by"=>auth()->id()
       ];

       $stock_id = DB::table('stock')->insertGetId($stock_values);


       $stock_data_values = [
        "stock_id"=>$stock_id,
        "products"=>json_encode($product_set),
        "created_by"=>auth()->id()

       ];

       DB::table('stock_data')->insert($stock_data_values);

       return redirect('/stock');


    }

    public function getStockEntryOptions()
    {
        
    }
}
