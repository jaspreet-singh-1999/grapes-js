<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\WebPage;
use Auth;
use Illuminate\Validation\Rules\Unique;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WedPageController extends Controller
{

    public function admin_home(){
       
        return view('admin.dashboard');
    }

    public function pagesList(){
        return view('admin.pages');
    }

    public function webBuilder($id){
        return view('web-builder',['id'=> $id]);
    }

    public function pageEdit($id){
        
        $getPageData= WebPage::where('id',$id)->first();
        if($getPageData){
            $pageHtml= json_decode($getPageData['page_html']);
            $pageCss= json_decode($getPageData['page_css']);
        
            return view('web-builder',['id'=>$id,'html'=>$pageHtml,'css'=>$pageCss]);
        }else{
            
        } 
        
    }

    public function pagesListData(){

        try{
            $getPages= WebPage::all();
            if($getPages){  
                return DataTables::of($getPages)
                ->addIndexColumn()
                ->addColumn('id', function($data){
                    return $data->id;
                })
                ->addColumn('page_slug', function($data){
                    return $data->page_slug;
                })
                ->addColumn('page_title', function($data){
                    return $data->page_title;
                })
                ->addColumn('action', function($data){
                    return '<a href="'.route('web-builder',$data->id).'" class="btn btn-xs btn-primary">Edit with editor</a>'. ' ' .
                    '<a href="'.route('delete-page',$data->id).'"class="btn btn-xs btn-primary">Delete</a>'. ' ' .
                    '<a href="'.route('editor',$data->id).'"class="btn btn-xs btn-primary">Editor</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('admin.pages');
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function save_page(Request $request){
        try{
            $input= $request->all();
            $validation = validator::make($input,[
                'page_title'=>'required',
                'description'=> 'required'
            ]);

            if($validation->failed()){
                $response= [
                    'success'=> true,
                    'status'=> 201,
                    'message'=> $validation->messages()
                ];
                return response()->json($response);
            }

            $slug= Str::lower($input['page_title']);

            $replace_slug= str_replace(' ','-',$slug);

            $page= [
                'page_id'=> rand(100000,9999),
                'page_title'=> $input['page_title'],
                'page_slug'=> $replace_slug,
                'description'=> $input['description'],
                'created_by'=> Auth::user()->id
            ];
            $createPage= WebPage::create($page);
            if($createPage){    
                $response=[
                    'success'=> true,
                    'status'=> 201,
                    'message'=> 'page created successfully'
                ];
                return response()->json($response);
            }else{
                $response=[
                    'success'=> false,
                    'status'=> 500,
                    'message'=> 'Rrror in create page'
                ];
                return response()->json($response);
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
        
    }

    public function save_page_data(Request $request){
        
        try{
            $pageData= $request->all();
            $getPage= WebPage::where('id',$pageData['id'])->first();
            if($getPage){
                $html= json_encode($pageData['html']);
                $css= json_encode($pageData['css']);
                $getPage->page_html= $html;
                $getPage->page_css= $css;
                $getPage->updated_by= Auth::user()->id;
                $save= $getPage->save();
                if($save){
                    $response= [
                        'success'=> true, 
                        'status'=> 201, 
                        'message'=> 'Page data save successfully'
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
            }
            
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    public function delete_page($id){
        try{
            $getPage= WebPage::where('id',$id)->first();
            if($getPage){
                $delete= $getPage->delete();
                if($delete){
                    $response=[
                        'success'=> true,
                        'status'=> 201,
                        'message'=> 'page delete successfully'
                    ];
                    return redirect()->route('pages-list');
                }else{
                    $response=[
                        'success'=> false,
                        'status'=> 500,
                        'message'=> 'Error in delete page'
                    ];
                    return response()->json($response);
                }
            }else{
                $response=[
                    'success'=> false,
                    'status'=> 500,
                    'message'=> 'Page not found'
                ];
                return response()->json($response);
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
