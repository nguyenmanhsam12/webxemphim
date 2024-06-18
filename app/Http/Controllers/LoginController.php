<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function postlogin(Request $request){
        $validate = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ],
        [
            'email.required'=>'Email không được để trống',
            'email.email'=>'Email phải đúng định dạng',
            'password.required'=>'mật khẩu không được để trống',   
        ]);
        if (Auth::attempt($validate)) {
            $request->session()->regenerate();  

            return redirect(route('admin.index'));
        }
        return redirect(route('loginAdmin'))->with('error','Thông tin đăng nhập không chính xác');
        
    }

    public function Aulogout(Request $request){

        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect(route('homepage'));

    }

}
