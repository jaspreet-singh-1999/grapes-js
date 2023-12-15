<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\PageType;
use App\Models\DesignedTemplates;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class DesignTemplateController extends Controller
{

    public function selectPageType(){
        $getPageType= PageType::where('status','!=',0)->get();
        return view('admin.design-template.select-page-type',['pageTypes'=> $getPageType]);
    }

    public function edit_template(Request $request){
        $page_type_id= $request->page_type_id;
        if(!empty($page_type_id)){
            $response= ['success'=> true, 'status'=> 200, 'page_type_id'=>$page_type_id];
            return response()->json( $response);
        }else{
            $response= ['success'=> false, 'status'=> 422, 'message'=>'Please select page type '];
            return response()->json( $response);
        }
    }

    public function editor($id){
        return view('admin.design-template.editor',['page_type_id'=> $id]);
    }

    Public function save_tempate_data(Request $request){
        try{
          
            $user= Auth::user();
            $input= $request->all();
           
            $html= json_encode($input['html']);
            $css= json_encode($input['css']);
            $templateData=[
                'page_id'=> $input['page_type_id'],
                'html'=> $html,
                'css'=> $css,
                'created_by'=> $user->id
            ];
          
            $create= DesignedTemplates::create($templateData);
            if($create){
                $response= [
                    'success'=> true, 
                    'status'=> 201, 
                    'message'=> 'Tamplate create successfully'
                ];
                return response()->json($response);

            }else{
                $response= [
                    'success'=> false, 
                    'status'=> 500, 
                    'message'=> 'Error to save page data'
                ];
                return response()->json($response);
            }
            
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    
}
