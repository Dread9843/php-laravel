<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;
use Validator;

class CustomAuthController extends Controller
{
    public function login(){
        return view("auth.Login");

    }
    public function registration(){
        return view("auth.registration");

    }

    public function registerUser(Request $request)
    {
        
        // echo 'value posted';
        // exit;
        // echo '<pre>';
        // print_r($_POST);
        // exit;
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();
        if($res){
            return back()->with('success','You have registered sucessfully');
        }else{
            return back()-with('failed','Something is Wrong');

        }
    }

    public function loginUser(Request $request){
        // echo '<pre>';
        // print_r($_POST);
        // exit;
        $request->validate([
            
            'email'=>'required',
            'password'=>'required'
        ]);
        // echo '<pre>';
        // print_r($request->email);
        // exit;
        
        
        //$user = User::select('*')->where('email','=',$request->email)->first();
        $user =User::where('email', '=', $request->email)->first();
        if ($user){ 
            if(Hash::check($request->password, $user->password)){

                $request->session()->put('loginId',$user->id);
                return redirect('dashboard'); 

            }else{
                return back()->with('fail','Password mismatched.');
            }

        }else{
            return back()->with('fail','this email is not registered.');
        }

    }

    public function dashboard(){
        //return "Welcome!| to the Dashboard";
        $data = array();
     
        if(Session::has('loginId')){
            $data = User::where('id','=',Session::get('loginId'))->first();
        }
        return view('dashboard', compact('data'));
        // return redirect('dashboard'); 
    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }




}
