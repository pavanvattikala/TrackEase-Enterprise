<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ServiceController extends Controller
{
    //
    public function insertService(Request $request){
         
        //dd($request->all());

        $request->validate([
            'clientName'=>'required',
            'clientContact'=>'required',
            'serviceName'=>'required',
            'rate'=>'required',
            'quantity'=>'required',
            'totalValue'=>'required',
            'subTotalValue'=>'required',
            'serviceCharge'=>'required',
            'totalAmountValue'=>'required',
            'grandTotalValue'=>'required',
            'paid'=>'required',
            'dueValue'=>'required',
            'paymentType'=>'required',
            'paymentStatus'=>'required'        
        ]);

         $serviceDate  = $request->servicedate;
         $clientName = $request->clientName;
         $clientContact = $request->clientContact;
         $totalAmount = $request->totalAmountValue;
         $serviceCharge = $request->serviceCharge;
         $discount = $request->discount;
         $grand_total = $request->grandTotalValue;
         $paid = $request->paid;
         $dueValue = $request->dueValue;
         $paymentType = $request->paymentType;
         $paymentStatus = $request->paymentStatus;
         $subtotal = $request->subTotalValue;

         // items that can be 1 or more

         $serviceNames= $request->serviceName;
         $rates = $request->rate;
         $quantites = $request->quantity;
         $totalValue = $request->totalValue;

         $total_items = count($request->serviceName); // getting no of services

         $service_id= DB::table('service_data')->insertGetId(
            [
                'service_date'=>$serviceDate,
                'client_name'=>$clientName,
                'client_contact'=>$clientContact,
                'subtotal'=>$subtotal,
                'service_charge'=>$serviceCharge,
                'total_amt'=>$totalAmount,
                'discount'=>$discount,
                'grandtotal'=>$grand_total,
                'paid_amt'=>$paid,
                'due_amt'=>$dueValue,
                'payment_type'=>$paymentType,
                'payment_status'=>$paymentStatus
            ]
        ); // from table 

         for ($i=0; $i < $total_items; $i++) { 

           DB::table('service_taken_data')->insert(
            [
                'service_id'=>$service_id,
                'service_type'=>$serviceNames[$i],
                'rate'=>$rates[$i],
                'quantity'=>$quantites[$i],
                'amount'=>$totalValue[$i]

            ]
            );
            
         }

            

         return redirect()->back()->with('success','Service is added sucessfully');  

         



    }

    public function fetchServiceData(Request $request){
        $services = DB::table('service_types')->get();
        return json_encode($services);

    }

    public function fetchService(){

        $service_data = DB::table('service_data')->orderBy('service_date','desc')->get();

        //dd($service_data);
       

        foreach($service_data as $service) { 
            
            $service_id = $service->service_id;

            $button = '<!-- Single button -->
            <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" id="editProductModalBtn"  href="/service/manage/edit_service/'.$service_id.'"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                <li><a type="button" data-toggle="modal" href="/service/manage/view_service/'.$service_id.'"> <i class="glyphicon glyphicon-search"></i> View in Detail</a></li> 
                <li><a type="button" data-toggle="modal" href="/service/print/'.$service_id.'"> <i class="glyphicon glyphicon-print"></i>Print</a></li>      
            </ul>
            </div>';

            $service_date = date('d-m-Y',strtotime($service->service_date));
            $client_name = $service->client_name;
            $client_mobile = $service->client_contact;
            // to display the services names
            $service_names  = DB::table('service_taken_data')
            ->join('service_types', 'service_types.service_type_id', '=', 'service_taken_data.service_type')
            ->where('service_taken_data.service_id',$service->service_id)
            ->select('service_types.service_type_name',)
            ->get();
            
            $service_name=""; // empty string

            foreach($service_names as $name){
                $service_name=$name->service_type_name.",  ".$service_name; // appending the strings
            }

            $service_name= substr($service_name, 0, -3); // removing the last , from the attached string



            $total_amount = $service->total_amt;

            $paid_amt = $service->paid_amt;
            $due_amt = $service->due_amt;
            $val='<span style="color:green">'.$due_amt.'</span>';
            
            if($due_amt>0){
                $val='<span style="color:red">'.$due_amt.'</span>';
            }

            $output['data'][] = array( 		
                $service_id,
                $service_date, 
                $client_name,
                $client_mobile, 		 	
                $service_name,
                $total_amount,
                $paid_amt,
                $val,

                $button 		
                ); 	
            
        }; 

        echo json_encode($output);

    }

    public function editService($service_id){
        $service_data = DB::table('service_data') ->join('service_taken_data', 'service_data.service_id', '=', 'service_taken_data.service_id')->where('service_data.service_id',$service_id)->get();

        $service_name  = DB::table('service_types')->select('service_type')->where('service_id',$service_data->service_type)->first()->service_type;
       

    }

    public function viewService($service_id){
        $service_data = DB::table('service_data') ->join('service_taken_data', 'service_data.service_id', '=', 'service_taken_data.service_id')->where('service_data.service_id',$service_id)->get();

       // dd($service_data);

       $services_count = count($service_data);
        
        foreach($service_data as $service){

            //dd($service);

            $service_date=$service->service_date;

            $client_name=$service->client_name;

            $client_contact=$service->client_contact;

            //services, particular rates,quanities and total amounts

            $service_types[] = $service->service_type;

            $rates[] = $service->rate;

            $quantites[] = $service->quantity;

            $amounts[] = $service->amount;


            $sub_amount=$service->subtotal; // sub amount before discount
            
            $service_charge=$service->service_charge;

            $total_amount=$service->total_amt;

            $discount = $service->discount;

            $grandtotal = $service->grandtotal;

            $paid_amt = $service->paid_amt;


            $due_amt = $service->due_amt;

            $payment_type = $service->payment_type;

            $payment_status = $service->payment_status;



        }

        $data = [
            'service_date'=>$service_date,
            'client_name'=>$client_name,
            'client_contact'=>$client_contact,
            'sub_amount'=>$sub_amount,           
            'service_charge'=>$service_charge,
            'total_amount'=>$total_amount,
            'discount'=>$discount,
            'grandtotal'=>$grandtotal,
            'paid_amt'=>$paid_amt,
            'due_amt'=>$due_amt,
            'payment_type'=>$payment_type,
            'payment_status'=>$payment_status,
            // array values 
            'service_types'=>$service_types,
            'rates'=>$rates,
            'quantites'=>$quantites,
            'amounts'=>$amounts,

            //other info for better display

            'services_count'=>$services_count
        ];

        //dd($data);
        

        return view('sv.service.view_service_in_detail')->with('data',$data);
       
    }

    public function fetchServiceTypesData(){
        $service_types = DB::table('service_types')->get();

        foreach($service_types as $service_type){
            $output['data'][] = array( 		
                $service_type->service_type_id,
                $service_type->service_type_name	
                ); 	
        }
        return json_encode($output);
    }

    public function insert_service_type(Request $request){
        $request->validate([
            'serviceTypeName'=>'required'
        ]);

        DB::table('service_types')->insert(['service_type_name'=>$request->serviceTypeName]);

        return back()->with('success','Service Type is added sucessfully');  
    }

    public function print($service_id){

        $data =[
            'service_id' => $service_id
        ];

        return view('sv.service.service_print')->with('data',$data);

    }
}
