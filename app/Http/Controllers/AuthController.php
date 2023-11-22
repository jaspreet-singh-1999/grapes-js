<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class AuthController extends Controller
{
    
    public function loginPage(){
        return view("login");
    }
   
    public function homePage($html='', $css=''){

        return view("home",['html'=> $html,'css'=> $css]);
    }
    
    // public function webBuilder(){
    //     return view('web-builder');
    // }

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
            return redirect()->route('pages-list');
        }else{
            return redirect()->back()->with(['message'=>'The provided credentials do not match our records.']);
        }
    }

    public function logout(){
        $logout = Auth::logout();
        return redirect()->route('login');
    }
}
