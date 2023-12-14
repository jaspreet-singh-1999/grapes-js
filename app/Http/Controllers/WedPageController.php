<?php

namespace App\Http\Controllers;

use App\Models\PageType;
use Exception;
use Illuminate\Http\Request;
use App\Models\WebPage;
use Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\PostStatus;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;

class WedPageController extends Controller
{
    // for admin dashboard
    public function admin_home(){
       
        return view('admin.dashboard');
    }
    // for page list 
    public function pagesList(){
        $getPostStatus= PostStatus::all();
        return view('admin.web-pages.pages',['page_status'=> $getPostStatus]);
    }
    
    //This function list the all pages
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
                    return '<a href="'.route('editor',$data->id).'" class="btn btn-xs btn-primary">Edit with editor</a>'. ' ' .
                    '<a href="#" data-id="'.$data->id.'" class= "btn btn-xs btn-primary editPage">Edit</a>'.' '.
                    '<a href="'.route('delete-page',$data->id).'"class="btn btn-xs btn-primary">Delete</a>'.' '.
                    '<a href="'.route('home',$data->page_slug).'"class="btn btn-xs btn-primary">Preview</a>'.' '.
                    '<a href="#" data-id="'.$data->id.'" class="btn btn-xs btn-primary publish ">Publish</a>';
                }) 
                ->rawColumns(['action'])
                ->make(true);
            }
            return view('admin.pages');
        }catch(Exception $e){
            $message= $e->getMessage();
            Toastr::error($message);
        }
    }

    // This function create a new page 
    public function save_page(Request $request){
        try{
            $input= $request->all();
            $validation = validator::make($input,[
                'page_title'=>'required',
                'description'=> 'required'
            ]);

            if($validation->fails()){
                $response= [
                    'success'=> false,
                    'status'=> 500,
                    'message'=> $validation->messages()->first()
                ];

                return response()->json($response);
            }

            $checkPageExists= WebPage::where('page_title',$input['page_title'])->exists();
            if($checkPageExists){
                $message= 'Page already exists';
                $response=[
                    'success'=> false,
                    'status'=> 500,
                    'message'=> $message
                ];
                return response()->json($response);
            } 

            $create_slug= Str::lower($input['page_title']);
            $slug = Str::of($create_slug)->slug('-');
            $page= [
                'page_id'=> rand(100000,9999),
                'page_title'=> $input['page_title'],
                'page_slug'=> $slug,
                'description'=> $input['description'],
                'status'=> $input['status'],
                'protected_password'=> Hash::make($input['password']) ?? null,
                'created_by'=> Auth::user()->id
            ];
            $createPage= WebPage::create($page);
            if($createPage){  
                $message= 'Page created successfully';  
                $response=[
                    'success'=> true,
                    'status'=> 200,
                    'message'=> $message
                ];

                return response()->json($response);
            }else{
                $message= 'Error in page creation';
                $response=[
                    'success'=> false,
                    'status'=> 500,
                    'message'=>  $message
                ];
                return response()->json($response);
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }
    
    // This function edit the page 
    public function edit_page(Request $request){
        try{
    
            $getPageDetail= WebPage::where('id',$request->id)->first();
            if($getPageDetail){                
                $data=[
                    'page_id'=> $getPageDetail['id'],
                    'page_title'=> $getPageDetail['page_title'],
                    'page_slug'=> $getPageDetail['page_slug'],
                    'description'=>$getPageDetail['description'],
                    'status'=>$getPageDetail['status'],
                ];
                $response= [
                    'success'=> true, 
                    'status'=> 200, 
                    'pageDetails'=>$data,
                    'message'=> 'Page found'
                ];
                return response()->json($response);
            }else{
                $response= ['success'=> true, 'status'=> 404, 'message'=> 'Page not found'];    
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    // This function update the page 
    public function page_update(Request $request){
        try{
            $input= $request->all();
            $validation = validator::make($input,[
                'page_title'=>'required',
                'page_slug'=>'required',
                'description'=> 'required'
            ]);

            if($validation->failed()){
                $response= [
                    'success'=> true,
                    'status'=> 200,
                    'message'=> $validation->messages()
                ];
                return response()->json($response);
            }

            $create_slug= Str::lower($input['page_slug']);
            $slug = Str::of($create_slug)->slug('-');
            $checkSlugExists= WebPage::where('page_slug',$slug)->where('id','!=',$input['id'])->exists();
            if($checkSlugExists){
                $message= 'Page slug aleary exists try another slug';  
                $response=[
                    'success'=> false,
                    'status'=> 500,
                    'message'=> $message
                ];
                return response()->json($response);
            }

            $page= WebPage::where('id',$input['id'])->first();
            if($page){
                $page->page_title= $input['page_title'];
                $page->page_slug= $slug;
                $page->description= $input['description'];
                $page->status= $input['status'];
                $page->updated_by= Auth::user()->id;
                $update= $page->save();
            }
            
            if($update){    
                $response=[
                    'success'=> true,
                    'status'=> 200,
                    'message'=> 'Page update successfully'
                ];
                return response()->json($response);
            }else{
                $response=[
                    'success'=> false,
                    'status'=> 500,
                    'message'=> 'Error in create page'
                ];
                return response()->json($response);
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }
    
    // This function delete the page  
    public function delete_page($id){
        try{
            $getPage= WebPage::where('id',$id)->first();
            if($getPage){
                $delete= $getPage->delete();
                if($delete){
                    $response=[
                        'success'=> true,
                        'status'=> 200,
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
                    'status'=> 404,
                    'message'=> 'Page not found'
                ];
                return response()->json($response);
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    // This function edit the page in builder
    public function pageEdit($id){
        
        try{
            $getPageData= WebPage::where('id',$id)->first();
            if($getPageData){
                $pageHtml= json_decode($getPageData['page_html']);
                $pageCss= json_decode($getPageData['page_css']);
                return view('web-builder',['id'=> $id,'html'=>$pageHtml,'css'=>$pageCss]);
            }else{
                return redirect()->back()->with(['message'=> 'Page not found']);
            } 
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }

    // This function save the editor data
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
                        'status'=> 200, 
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
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    // This function change the status of the page publish & unpublish 
    public function publish_page(Request $request){
        try{
            $gatPage= WebPage::where('id',$request->page_id)->first();
            if($gatPage){
                if($gatPage->status == 1){
                    $gatPage->status= 3;
                    $gatPage->updated_by= Auth::user()->id;
                    $gatPage->save();
                    $response= [
                        'success'=> true,
                        'status'=> 200,
                        'message'=> 'Page publish successfully',
                        'page_status'=> $gatPage->status
                    ];
                    return response()->json($response);
                }else{
                    $gatPage->status= 1;
                    $gatPage->updated_by= Auth::user()->id;
                    $gatPage->save();
                    $response= [
                        'success'=> true,
                        'status'=> 200,
                        'message'=> 'Page unpublish successfully',
                        'page_status'=> $gatPage->status
                    ];
                    return response()->json($response);
                }
            }else{
                $response= [
                    'success'=> false,
                    'status'=> 404,
                    'message'=> 'Page not found',
                ];
                return response()->json($response);
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= [
                'success'=> false,
                'status'=> 500,
                'message'=> $message
            ];
            return response()->json($response);
        }
    }
}