<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //
    public function create(Request $request){
        $request->validate([
            'categoriesName'=>'required',
            'categoriesStatus'=>'required'
           ]);
           $name = $request->categoriesName;
           $active=$request->categoriesStatus;
           DB::table('categories')->insert([
            'categories_name'=>$name,
            'categories_active'=>$active
           ]);
    
           return back();

    }
    public function fetchCategories(){

        $result = DB::table('categories')->select('categories_id','categories_name','categories_active','categories_status')->where('categories_status',1)->get();

        foreach($result as $item) { 

        $activeCategories = ""; 

            $categoriesId = $item->categories_id;
            // active 
            if($item->categories_active == 1) {
                // activate member
                $activeCategories = "<label class='label label-success'>Available</label>";
            } else {
                // deactivate member
                $activeCategories = "<label class='label label-danger'>Not Available</label>";
            }

            $button = '<!-- Single button -->
            <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editCategoriesModal" onclick="editCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
            </ul>
            </div>';

            $output['data'][] = array( 		
                $item->categories_name,		
                $activeCategories,
                $button 		
                ); 	
        } 


        echo json_encode($output);
    }
    public function fetchSelectedCategories(Request $request){
       // var_dump($request->all());

        $result = DB::table('categories')->select('categories_name','categories_active')->where('categories_id',$request->categoriesId)->first();

        echo json_encode($result);

    }
    
}
