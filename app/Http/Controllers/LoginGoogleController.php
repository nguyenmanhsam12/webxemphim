<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginGoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect(); //Mạng xã hội là google
    }

    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user(); //Mạng xã hội là google
       
            $finduser = User::where('google_id', $user->id)->first(); //tìm kiếm xem tài khoản đã có trong db chưa
       
            if($finduser){ //nếu có
       
                Auth::login($finduser); //login ngay lập tức
      
                return redirect()->intended('/');
       
            }else{ //nếu không có thì tạo user mới 
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456789') //trên 8 ký tự
                ]);
                //login vào với acccount mới
                Auth::login($newUser);
      
                return redirect()->intended('/');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
