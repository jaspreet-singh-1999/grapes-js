<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\WebPage;
use Exception;
use PHPUnit\Framework\Constraint\IsEmpty;

class AuthController extends Controller
{
    
    public function loginPage(){
        return view("login");
    }
   

    public function page_using_slug($slug){
        try{
            $getPage= WebPage::where('page_slug',$slug)->first();
            if(!empty($getPage)){
                if($getPage->status == 2){
                    $pageHtml= json_decode($getPage['page_html']);
                    $html= str_replace(['<body>','</body>'],'',$pageHtml);
                    $pageCss= json_decode($getPage['page_css']);
    
                    return view('home',['html'=> $html,'css'=> $pageCss,'title'=>$slug]);
                }else{
                    Toastr::success('This Page is not publish');
                    return view('unpublish');
                }
            }else{
                return redirect()->back();
            }
            
        }catch(Exception $e){
            $message= $e->getMessage();
            return redirect()->back();
        }
    }
    

    public function homePage($page_slug){
        try{
            $getPage= WebPage::where('page_slug',$page_slug)->first();
            if($getPage){
                $pageHtml= json_decode($getPage['page_html']);
                $html= str_replace(['<body>','</body>'],'',$pageHtml);
                $pageCss= json_decode($getPage['page_css']);

                return view('home',['html'=> $html,'css'=> $pageCss,'title'=>$page_slug]);
            }else{
                Toastr::success('Page not found');
                return redirect()->back();
            }
        }catch(Exception $e){
            $message= $e->getMessage();
            return redirect()->back();
        }
    }
    

    public function user_login(Request $request){
        
        $input = $request->all();
        $validate= Validator::make($input,[
            'email'=> 'required',
            'password'=> 'required'
        ]);
        if($validate->fails()){ 
            return redirect()->back()->with(['message'=> $validate->messages()]);  
        }
        if(Auth::attempt(['email'=> $input['email'],'password'=> $input['password']])){
            Toastr::success('login successfully');
            return redirect()->route('pages-list');
        }else{
            Toastr::success('The provided credentials do not match our records.');
            return redirect()->back()->with(['message'=>'The provided credentials do not match our records.']);
        }
    }

    public function logout(){
        $logout = Auth::logout();
        return redirect()->route('login');
    }
}
