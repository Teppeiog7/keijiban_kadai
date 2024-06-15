<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{

    //=================================

    public function loginView()
    {
        return view('auth.login.login');
    }

    //=================================

    public function login(Request $request){
        if($request->isMethod('post')){
            $data=$request->only('email','password');
            //dd($data);
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if(Auth::attempt($data)){
                return redirect('/top');
            }
        }
        return view("auth.login.login");
    }
    //ログアウトメソッド
    public function Logout(){
        Auth::logout();//ログアウトする。Authは認証関連の機能を提供するためのクラスの事。
        return redirect('/login');//ログイン画面にリダイレクト。
    }

    //=================================

}
