<?php

namespace App\Http\Controllers;

use App\Models\PageData;
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

    public function showSelectOption(){
        try{
            $getPageType= PageType::get();
            if($getPageType->isNotEmpty()){
                $response= ['success'=> true, 'status'=> 200, 'options'=> $getPageType];
                return response()->json($response);
            }else{
                $response= ['success'=> true, 'status'=> 404, 'message'=> 'Page type not found'];
                return response()->json($response);
            }
            
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=>false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    public function show_editor(){
        $getPageType= PageType::get();
        return view('admin.design-template.editor',['option'=>$getPageType]);
    }

    // get selected page details
    public function getPageDetails(Request $request){
        try{
            
            $getPageDetails= PageData::where('page_id',$request->pageType);
            if($request->recentPost == 'true'){
                $getPageDetails->orderBy('created_at', 'desc');
            }
            if($request->postCount !== '0'){
                $getPageDetails->limit($request->postCount);
            }

            $getDetails= $getPageDetails->get();

            $row_column= [
                'noOfColumn'=> $request->column,
                // 'noOfRow'=> $request->row
            ];

            if($getDetails->isNotEmpty()){

                if($request->masonry == 'true'){
                    $gridhtml= view('admin.grid-template.masonry',['pageDetail'=> $getDetails,'rowColumn'=> $row_column ])->render();
                }else{
                    $gridhtml= view('admin.grid-template.simple-grid',['pageDetail'=> $getDetails,'rowColumn'=> $row_column ])->render();    
                }

                $response= [
                    'success'=>  true,
                    'status'=> 200,
                    'message'=> 'Page details found successfully',
                    'gridHtml'=> $gridhtml
                ];
                return response()->json($response);
            }else{
                $response= [
                    'success'=>  false,
                    'status'=> 500,
                    'message'=> 'Page details not found '
                ];
                return response()->json($response);
            }
            
        }catch (Exception $e){
            $message= $e->getMessage();
            $response= [
                'success'=>  false,
                'status'=> 500,
                'message'=> $message
            ];
            return response()->json($response);
        }
    }
}
