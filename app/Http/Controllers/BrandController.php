<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    //
    public function create(Request $request){
       $request->validate([
        'brandName'=>'required',
        'brandStatus'=>'required'
       ]);
       $name = $request->brandName;
       $brandactive=$request->brandStatus;
       DB::table('brands')->insert([
        'brand_name'=>$name,
        'brand_active'=>$brandactive
       ]);

       return back();
    }
    public function fetchbrand(){
        // $sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1";
        $result = DB::table('brands')->select('brand_id','brand_name','brand_active','brand_status')->where('brand_status',1)->get();
        
        foreach($result as $item) { 
    

            // $row = $result->fetch_array();
            $activeBrands = ""; 
            $brandId = $item->brand_id;
            // active 
            if($item->brand_active == 1) {
                // activate member
                $activeBrands = "<label class='label label-success'>Available</label>";
            } else {
                // deactivate member
                $activeBrands = "<label class='label label-danger'>Not Available</label>";
            }

            $button = '<!-- Single button -->
            <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a type="button" href="" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$brandId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                <li><a type="button" href="" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$brandId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
            </ul>
            </div>';

            $output['data'][] = array( 		
                $item->brand_name, 		
                $activeBrands,
                $button
                ); 	

        } // if num_rows

        echo json_encode($output);
    }
    public function editbrand(Request $request){
        //dd($request->all());

        $request->validate([
            'editBrandName'=>'required',
            'editBrandActiveStatus'=>'required',
            'editBrandId'=>'required'
        ]);

        $brandId=$request->editBrandId;
        $editBrandName=$request->editBrandName;
        $editBrandActiveStatus=$request->editBrandActiveStatus;

        DB::table('brands')->where('brand_id',$brandId)->update(['brand_name'=>$editBrandName,'brand_status'=>$editBrandActiveStatus,'updated_at'=>today()]);

       return redirect('/brand')->with('success','Brand Edited Sucessfully');

    }
    public function fetchselectedbrand(Request $request){

        $result = DB::table('brands')->select('brand_name','brand_active')->where('brand_id',$request->brandId)->first();

        echo json_encode($result);
    }

    public function trash(Request $request){
        $request->validate([
            'removeBrandId'=>'required'
        ]);

        $removeBrandId = $request->removeBrandId;

        DB::table('brands')->where('brand_id',$removeBrandId)->update(['brand_status'=>0,'updated_at'=>today()]);

        return redirect('/brand')->with('success','Brand Deleted Sucessfully');
    }
}
