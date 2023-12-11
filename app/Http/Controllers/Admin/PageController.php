<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageData;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use Exception;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PageController extends Controller
{
    public function listing($id){

        try{
            $user= Auth::user();

            $getfieldData= PageData::where('page_id',$id)->where('created_by',$user->id)->get();
            $get=[];
            foreach($getfieldData as $fieldData){
                $data= json_decode($fieldData->field_data,true);
                $data['id']= $fieldData->id ;
                $get[]= $data;
            }
            
            return DataTables::of($get)
            ->addIndexColumn()
            ->addColumn('id',function($query){
                return $query['id'];
            })
            ->addColumn('action',function($query){
                return '<a href="#" data-id="'.$query['id'].'" class="btn btn-success edit">Edit</a>'.' '. '<a href="#" data-id="'.$query['id'].'"class="btn btn-success delete">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }catch(Exception $e){
            dd($e->getMessage());
        }
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
            dd($message);
        }
    }

    public function edit(Request $request){
        try{
    
            $user= Auth::user();
            $getFieldData= PageData::where('id',$request->id)->where('created_by',$user->id)->first();
            if($getFieldData){
                $fieldData= json_decode($getFieldData->field_data);
                $respose= ['success'=> true, 'status'=> 200, 'fieldData'=> $fieldData,'filedData_id'=> $getFieldData->id];
                return response()->json($respose);
            }else{
                $respose= ['success'=> false, 'status'=> 500, 'message'=> 'Data not found'];
                return response()->json($respose);
            }
            
        }catch(Exception $e){
            $message= $e->getMessage();
            $respose= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($respose);
        }
    }

    public function updateData(Request $request){
        try{
    
            $user= Auth::user();
            $input= $request->all();
            
            $validation= Validator::make($input,[
                '*'=> 'required'
            ]);

            if($validation->fails()){
                $message= $validation->messages()->first();
                return redirect()->back()->with(Toastr::error($message));
            }
            unset($input['_token']);

            $getFieldData= PageData::where('id',$input['fieldData_id'])->where('created_by',$user->id)->first();
            
            if($getFieldData){
                if($request->hasFile('image')){
                    $fieldData= json_decode($getFieldData->field_data,true);
                    Storage::delete($fieldData['image']);
                    $file= $request->image;
                    $fileName= time().'-'.$file->getClientOriginalName();
                    $filePath= $file->storeAs('pageData/'.$fileName);
                    $input['image']= $filePath;
                }

                $filedData= [
                    'field_data'=> json_encode($input),
                    'updated_by'=> $user->id
                ];
    
                $update= $getFieldData->update($filedData);
                if($update){
                    $message="Record update successfully";
                    return redirect()->back()->with(Toastr::success($message));
                }else{
                    $message= "Error in record update";
                    return redirect()->back()->with(Toastr::error($message));
                }
            }else{
                $message="Record nor found";
                return redirect()->back()->with(Toastr::success($message));
            }

        }catch(Exception $e){
            $message= $e->getMessage();
            dd($message);
            Toastr::error($message);
        }
    }

    public function deleteData(Request $request){
        try{
            $user= Auth::user();
            $getData= PageData::where('id',$request->id)->where('created_by',$user->id)->first();
            if($getData){
                $getData->delete();
                $getData->updated_by= $user->id;
                $delete= $getData->save();
                if($delete){
                    $respose= ['success'=> true, 'status'=> 200, 'message'=> 'Record delete successfully'];
                    return response()->json($respose);
                }else{
                    $respose= ['success'=> false, 'status'=> 500, 'message'=> 'Error in delete  Record'];
                    return response()->json($respose);
                }
            }else{
                $respose= ['success'=> false, 'status'=> 500, 'message'=> 'Record not found'];
                return response()->json($respose);
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
