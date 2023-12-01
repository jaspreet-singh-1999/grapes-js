<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\FieldType;
use App\Models\CustomField;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Auth;

class CustomFieldController extends Controller
{
   
    public function custom_field(){

        return view('admin.custom-field.custom-page');
    }

    public function field_list(){
        try{
            $getFields= CustomField::with('fieldType')->get();
           
            return DataTables::of($getFields)
            ->addIndexColumn()
            ->addColumn('id',function($data){
                return $data->id;
            })
            ->addColumn('label',function($data){
                return $data->label;
            })
            ->addColumn('name',function($data){
                return $data->name;
            })
            ->addColumn('field_key', function($data){
                return $data->field_key;
            })
            ->addColumn('type',function($data){
                return $data->fieldType->name;
            })
            ->addColumn('action',function($data){
                return '<a href="#" data-id="'.$data->id.'" class= "btn btn-xs btn-primary status">Deactivate</a>'.' '.
                '<a href="'.route('edit',$data->id).'" class= "btn btn-xs btn-primary ">Edit</a>'.' '.
                '<a href="'.route('delete',$data->id).'" class= "btn btn-xs btn-primary ">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    public function add_field(){
        $getFieldType= FieldType::all();
        return view('admin.custom-field.add-field',['fieldType'=> $getFieldType]);
    }

    public function saveField(Request $request){
        try{
            $input= $request->all();
            $validation = validator::make($input,[
                'group_name'=>'required',
                'type'=> 'required',
                'label'=>'required',
                'name'=> 'required',
                'default_value'=> 'required'
            ]);

            if($validation->fails()){
                $response= [
                    'success'=> false,
                    'status'=> 500,
                    'message'=> $validation->messages()->first()
                ];

                return response()->json($response);
            }
            $groupKey= 'group_'.Str::random(7);
            $fieldKey= 'fiels_'.Str::random(7);
    
            $field= [
                'group_name'=> $input['group_name'],
                'group_key'=> $groupKey,
                'field_key'=> $fieldKey,
                'type'=> $input['type'],
                'label'=> $input['label'],
                'name'=> $input['name'],
                'default_value'=> $input['default_value'],
                'created_by'=> Auth::user()->id
            ];

            $createPage= CustomField::create($field);
            if($createPage){  
                $message= 'Field created successfully';  
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

    public function editField($id){
        try{
            $getdata= CustomField::with('fieldType')->where('id',$id)->first();
            $getFieldType= FieldType::all();
            if($getdata){
                return view('admin.custom-field.edit-field',['data'=> $getdata,'fieldType'=> $getFieldType]);
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    public function updateField(Request $request){
        try{
            $input= $request->all();
            $validation = validator::make($input,[
                'group_name'=>'required',
                'type'=> 'required',
                'label'=>'required',
                'name'=> 'required',
                'default_value'=> 'required'
            ]);

            if($validation->fails()){
                $response= [
                    'success'=> false,
                    'status'=> 500,
                    'message'=> $validation->messages()->first()
                ];

                return response()->json($response);
            }
           
            $getField= CustomField::where('id',$input['id'])->first();
            if($getField){
                $getField->group_name= $input['group_name'];
                $getField->type= $input['type'];
                $getField->label= $input['label'];
                $getField->name= $input['name'];
                $getField->default_value= $input['default_value'];
                $getField->updated_by= Auth::user()->id;
                $save= $getField->Save();
            }
           
            if($save){  
                $message= 'Field update successfully';  
                $response=[
                    'success'=> true,
                    'status'=> 201,
                    'message'=> $message
                ];

                return response()->json($response);
            }else{
                $message= 'Error in page update';
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
    
    public function changeStatus(Request $request){
        try{
            $getField= CustomField::where('id',$request->id)->first();
            if($getField){
                if($getField->status == 1){
                    $getField->status=0;
                    $getField->updated_by= Auth::user()->id;
                    $update= $getField->save();
                    $response= [
                        'success'=> true,
                        'status'=> 200,
                        'message'=> 'Field deactivate',
                        'field_status'=> $getField->status
                    ];
                    return response()->json($response);
                }else{
                    $getField->status= 1;
                    $getField->updated_by= Auth::user()->id;
                    $update= $getField->save();
                    $response= [
                        'success'=> true,
                        'status'=> 200,
                        'message'=> 'Field activate',
                        'field_status'=> $getField->status
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

    public function deleteField($id){
        try{
            $getdata= CustomField::where('id',$id)->first();
            if($getdata){
                $delete= $getdata->delete();
                $message= 'Field deleted successfully';
                return redirect()->back()->with(Toastr::success($message));
            }else{
                $message= 'Error in delete field';
                Toastr::error($message);

            }
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }
}
