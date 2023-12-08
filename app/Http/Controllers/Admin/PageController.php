<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageData;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use Exception;
use Yajra\DataTables\DataTables;

class PageController extends Controller
{
    public function listing($id){
        $user= Auth::user();
        $getfieldData= PageData::where('page_id',$id)->where('created_by',$user->id)->first();
        $data = json_decode($getfieldData->field_data, true);
        return DataTables::of([$data])
        ->addIndexColumn()
        ->addColumn('id',function($query){
            return $query['page_id'];
        })
        ->addColumn('action',function($query){
            return '<a href="" class="btn btn-success">Edit</a>  <a href="" class="btn btn-success">Delete</a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function save_field_data(Request $request){
        try{
    
            $input= $request->all();
            $validation= Validator::make($input,[
                '*'=> 'required'
            ]);

            if($validation->fails()){
                $message= $validation->messages()->first();
                return redirect()->back()->with(Toastr::error($message));
            }

            unset($input['_token']);
            $page_id= $input['page_id'];
            
            if($request->hasFile('image')){
                $file= $request->image;
                $fileName= time().'-'.$file->getClientOriginalName();
                $filePath= $file->storeAs('pageData/'.$fileName);

                $input['image']= $filePath;
            }

            $filedData= [
                'page_id'=> $page_id,
                'field_data'=> json_encode($input),
                'created_by'=> Auth::user()->id
            ];
        
            $create= PageData::create($filedData);
            if($create){
                $message= 'Record save successfully';
                return redirect()->back()->with(Toastr::success($message));
            }else{
                $message= 'Error in record save';
            }

        }catch(Exception $e){
            $message= $e->getMessage();
        }
    }

    public function edit(){
        
    }
}
