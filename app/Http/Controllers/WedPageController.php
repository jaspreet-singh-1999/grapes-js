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
use Brian2694\Toastr\Facades\Toastr;

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
                    '<a href="'.route('publish-page',$data->id).'" class="btn btn-xs btn-primary">Publish</a>'.' '.
                    '<a href="'.route('delete-page',$data->id).'"class="btn btn-xs btn-primary">Delete</a>';
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
            $checkPageExists= WebPage::where('page_title',$input['page_title'])->exists();
            if($checkPageExists){
                $message= 'Page already exists';
                // Toastr::error($message ,'Error',["positionClass" => "toast-top-center"]);
                return redirect()->back()->with(['message'=>$message]);
            } 

            $create_slug= Str::lower($input['page_title']);
            $slug= str_replace(' ','-',$create_slug);

            $page= [
                'page_id'=> rand(100000,9999),
                'page_title'=> $input['page_title'],
                'page_slug'=> $slug,
                'description'=> $input['description'],
                'created_by'=> Auth::user()->id
            ];
            $createPage= WebPage::create($page);
            if($createPage){  
                $message= 'Page created successfully';  
                $response=[
                    'success'=> true,
                    'status'=> 201,
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

    public function edit_page(Request $request){
        try{
    
            $getPageDetail= WebPage::where('id',$request->id)->first();
            if($getPageDetail){                
                $data=[
                    'page_id'=> $getPageDetail['id'],
                    'page_title'=> $getPageDetail['page_title'],
                    'description'=>$getPageDetail['description']
                ];
                $response= [
                    'success'=> true, 
                    'status'=> 201, 
                    'pageDetails'=>$data,
                    'message'=> 'Page found'
                ];
                return response()->json($response);
                // return view('admin.pages',['page'=>$getPageDetail]);
            }else{
                $response= ['success'=> true, 'status'=> 500, 'message'=> 'Page not found'];    
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    public function page_update(Request $request){
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

            $create_slug= Str::lower($input['page_title']);
            $slug= str_replace(' ','-',$create_slug);

            $page= WebPage::where('id',$input['id'])->first();
            if($page){
                $page->page_title= $input['page_title'];
                $page->page_slug= $slug;
                $page->description= $input['description'];
                $page->updated_by= Auth::user()->id;
                $update= $page->save();
            }
            
            if($update){    
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
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

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

    public function get_page_data(Request $request){
        try{
            $getPageData= WebPage::where('id',$request->id)->first();
            if($getPageData){
                $pageData= [
                    'html'=> json_decode($getPageData['page_html']),
                    'css'=> json_decode($getPageData['page_css'])
                ];
                $response= [
                    'success'=> true,
                    'status'=> 200,
                    'page'=> $pageData,
                    'message'=> 'Page found'
                ];
                return response()->json($response);
            }else{
                $response= [
                    'success'=> true,
                    'status'=> 200,
                    'message'=> 'Page data not found'
                ];
                return response()->json($response);
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= [
                'success'=> true,
                'status'=> 200,
                'message'=> 'Page data not found'
            ];
            return response()->json($response);
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
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    public function publish_page($id){
        try{
            $getPage= WebPage::where('id',$id)->first();
            if($getPage){
                $pageHtml= json_decode($getPage['page_html']);
                $html= str_replace(['<body>','</body>'],'',$pageHtml);

                $pageCss= json_decode($getPage['page_css']);
                // Toastr::success('Page publish successfully','Success',["positionClass" => "toast-top-center"]);
                return view('home',['css'=> $pageCss,'html'=> $html]);
            }else{
                // Toastr::success('Error to Page publish ','Error',["positionClass" => "toast-top-center"]);
                return redirect()->back();
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            // Toastr::success($message ,'Error',["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    }
}
