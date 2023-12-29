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
