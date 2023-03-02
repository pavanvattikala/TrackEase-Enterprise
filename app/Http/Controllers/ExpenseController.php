<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    //
    public function create(Request $request){
       $request->validate([
        'expenseName'=>'required',
        'expenseAmount'=>'required'
       ]);
       $name = $request->expenseName;
       $amount=$request->expenseAmount;
       DB::table('expenses')->insert([
        'name'=>$name,
        'amount'=>$amount
       ]);

       return back();
    }
    public function fetchExpense(){
        $result = DB::table('expenses')->select('expense_id','name','amount','created_at','verified')->where('status',1)->get();
        
        foreach($result as $item) { 
    

            // $row = $result->fetch_array();
            $verifiedExpenses = ""; 
            $expenseId = $item->expense_id;
            // active 
            if($item->verified == 1) {
                // activate member
                $verifiedExpenses = "<label class='label label-success'>Verified</label>";
            } else {
                // deactivate member
                $verifiedExpenses = "<label class='label label-danger'>Not Verified</label>";
            }

            $button = '<!-- Single button -->
            <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a type="button" href="" data-toggle="modal" data-target="#editexpenseModel" onclick="editexpenses('.$expenseId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                <li><a type="button" href="" data-toggle="modal" data-target="#removeMemberModal" onclick="removeexpenses('.$expenseId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
            </ul>
            </div>';

            $output['data'][] = array( 		
                $item->name, 		
                $verifiedExpenses,
                $button
                ); 	

        } // if num_rows

        echo json_encode($output);
    }
    public function editexpense(Request $request){
        //dd($request->all());

        $request->validate([
            'editexpenseName'=>'required',
            'editexpenseActiveStatus'=>'required',
            'editexpenseId'=>'required'
        ]);

        $expenseId=$request->editexpenseId;
        $editexpenseName=$request->editexpenseName;
        $editexpenseActiveStatus=$request->editexpenseActiveStatus;

        DB::table('expenses')->where('expense_id',$expenseId)->update(['expense_name'=>$editexpenseName,'expense_status'=>$editexpenseActiveStatus,'updated_at'=>today()]);

       return redirect('/expense')->with('success','expense Edited Sucessfully');

    }
    public function fetchselectedexpense(Request $request){

        $result = DB::table('expenses')->select('expense_name','expense_active')->where('expense_id',$request->expenseId)->first();

        echo json_encode($result);
    }

    public function trash(Request $request){
        $request->validate([
            'removeexpenseId'=>'required'
        ]);

        $removeexpenseId = $request->removeexpenseId;

        DB::table('expenses')->where('expense_id',$removeexpenseId)->update(['expense_status'=>0,'updated_at'=>today()]);

        return redirect('/expense')->with('success','expense Deleted Sucessfully');
    }
}
