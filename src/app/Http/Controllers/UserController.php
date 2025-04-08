<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // 登録フォームを表示
    }
    
    public function storeUser(RegisterRequest $request){
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        Auth::login($user);
        return redirect('/profile');
    }

    public function loginUser(LoginRequest $request){
        $credentials=$request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect('/');
        }

    }

        public function logout(){
            return view('layouts.appp');
    }

    public function showProfile()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'ログインが必要です');
        }
    
        $profile = $user->profile ?? new Profile();
    
        // 出品した商品
        $selling_products = $user->products()->where('status', 'selling')->get();
    
        // 購入した商品
        $purchased_products = $user->purchases()->get();
    
        return view('profile', compact('user', 'profile', 'selling_products', 'purchased_products'));
    }
    

}
