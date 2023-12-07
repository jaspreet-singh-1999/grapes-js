<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\FieldType;
use App\Models\CustomField;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\PageType;
use Auth;

class CustomFieldController extends Controller
{
   
    public function custom_field(){

        return view('admin.custom-field.custom-page');
    }

    // Listing All type of pages 
    public function field_list(){
        try{
            $getFields= PageType::all();
            return DataTables::of($getFields)
            ->addIndexColumn()
            ->addColumn('id',function($data){
                return $data->id;
            })
            ->addColumn('page_type',function($data){
                return $data->page_type;
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

    // View Add field blade with Field type 
    public function add_field(){
        $getFieldType= FieldType::all();
        return view('admin.custom-field.add-field',['fieldType'=> $getFieldType]);
    }

    // Save Page type & fields 
    public function saveField(Request $request){
        try{

            $input= $request->all();
            $validation = validator::make($input,[
                'page_type'=> 'required',
                'data.*.field_type'=> 'required',
                'data.*.label'=> 'required',
                'data.*.name'=> 'required',
            ]);

            if($validation->fails()){
                $message= $validation->messages()->first();
                return redirect()->back()->with(Toastr::error($message));
            }

            $checkPageTypeExists= PageType::where('page_type',$input['page_type'])->exists();
            if($checkPageTypeExists){
                $message= 'Page type already exists';
                return redirect()->back()->with(Toastr::error($message));
            }

            $pageType= ['page_type'=> $input['page_type'], 'created_by'=> Auth::user()->id];
            $create= PageType::create($pageType);
            
            $data= $input['data'];
            foreach($data as $field){
                $createField= CustomField::create([
                    'page_id'=> $create->id,
                    'field_type'=> $field['field_type'],
                    'label'=> $field['label'],
                    'name'=> $field['name'],
                    'default_value'=> $field['default_value'],
                ]);
            }
            if($createField){
                $createField->created_by= Auth::user()->id;
                $createField->save();
    
                $message= 'Field created successfully';  
                Toastr::success($message);
                return redirect()->route('custom-field');
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

    // Edit Page type & there fields
    public function editField($id){
        try{
            $getPageType= PageType::where('id',$id)->first();
            $getField= CustomField::with('fieldType')->where('page_id',$getPageType->id)->get();
            $getFieldType= FieldType::all();
            if(isset($getField)){
                return view('admin.custom-field.edit-field',['pageType'=>$getPageType,'fields'=> $getField,'fieldType'=> $getFieldType]);
            }else{
                $message= 'Data not found';
                return redirect()->back()->with(Toastr::error($message));
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    // Update Page type and there fields
    public function updateField(Request $request){
        try{    
            $input= $request->all();
            $validation = Validator::make($input,[
                'page_type'=> 'required',
                'data.*.field_type'=> 'required',
                'data.*.label'=> 'required',
                'data.*.name'=> 'required',
            ]);

            if($validation->fails()){
                $response= [
                    'success'=> false,
                    'status'=> 500,
                    'message'=> $validation->messages()->first()
                ];

                return response()->json($response);
            }
            $getPageType= PageType::where('id',$input['pageType_id'])->first();
            if($getPageType){
                $getPageType->page_type= $input['page_type'];
                $getPageType->updated_by= Auth::user()->id;
                $update= $getPageType->save();
                if($update){
                    $fieldData= $input['data'];
                    foreach($fieldData as $data){
                        $field= CustomField::where('id',$data['field_id'])->first();
                        if(!empty($field)){    
                            $field->page_id= $getPageType->id;
                            $field->field_type= $data['field_type'];
                            $field->label= $data['label'];
                            $field->name= $data['name'];
                            $field->default_value= $data['default_value'];
                            $field->updated_by= Auth::user()->id;
                            $created= $field->save();
                        }else{
                            $createNew= [
                                'page_id'=> $getPageType->id,
                                'field_type'=> $data['field_type'],
                                'label'=> $data['label'],
                                'name'=> $data['name'],
                                'default_value'=> $data['default_value'],
                                'created_by'=> Auth::user()->id
                            ];
                            $created= CustomField::create($createNew);
                        }
                    }
                    if($created){
                        $message= 'Page type & Field update successfully';
                        Toastr::success($message);
                        return redirect()->route('custom-field');
                        
                    }else{
                        $message= 'Error in update page type & field';
                        return redirect()->back()->with(Toastr::error($message));
                    }
                }else{
                    $message= 'Error in update page type';
                    Toastr::error($message);
                }
            }else{
                $message= 'Page type not found';
                Toastr::error($message);
            }
            
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    // Delete Page type with there all fields
    public function deletePage($id){
        try{
            $getdata= PageType::where('id',$id)->where('created_by',Auth::user()->id)->first();
            if($getdata){
                $getdata->field()->delete();
                $getdata->delete();
                $getdata->updated_by= Auth::user()->id;
                $delete= $getdata->Save();
                if($delete){
                    $message= 'Page & Field deleted successfully';
                    return redirect()->route('custom-field');
                }else{
                    $message= 'Erro in deleted Page & Field';
                    return redirect()->back()->with(Toastr::error($message));
                }
                
            }else{
                $message= 'Page not found';
                return redirect()->back()->with(Toastr::error($message));
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            $response= ['success'=> false, 'status'=> 500, 'message'=> $message];
            return response()->json($response);
        }
    }

    // Change Page type status active/deactive
    public function changeStatus(Request $request){
        try{
            $getField= PageType::where('id',$request->id)->first();
            if($getField){
                if($getField->status == 1){
                    $getField->status=0;
                    $getField->updated_by= Auth::user()->id;
                    $update= $getField->save();
                    $response= [
                        'success'=> true,
                        'status'=> 200,
                        'message'=> 'Page deactivate',
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
                        'message'=> 'Page activate',
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

    // Show assign field to Page Base on clicked page  
    public function showField($id){
        try{
            $user= Auth::user();
            $getPageType= PageType::where('id',$id)->where('created_by',$user->id)->first();
            if($getPageType){
                $getField= CustomField::with('fieldType')->where('page_id',$getPageType->id)->get();
                if($getField){
                    return view('admin.pages.page',['page'=> $getPageType,'fields'=>$getField]);
                }else{
                    $message= 'fields not found';
                    return redirect()->back()->with(Toastr::error($message));
                }
            }else{
                $message= 'Page not found';
                return redirect()->back()->with(Toastr::error($message));
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
