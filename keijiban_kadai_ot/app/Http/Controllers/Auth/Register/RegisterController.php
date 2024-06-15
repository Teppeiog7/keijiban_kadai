<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //=====================================

    public function __construct()
    {
        $this->middleware('guest');
    }

    //=====================================

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    //=====================================

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:2|max:12',
            'email' => 'required|string|email|min:5|max:40|unique:users',
            'password' => 'required|string|min:8|max:20|alpha_num|confirmed',
        ]);
    }

    //=====================================

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //=====================================

    public function register(Request $request){
        if($request->isMethod('post')){//isMethod() 引数に指定した文字列とHTTP動詞が一致するかを判定
            $data = $request->input();
            //dd($data);
            $validator = $this->validator($data);//validatorメソッドを呼び出し
            //dd($validator);
            if($validator->fails()){//もしvalidatorメソッドが失敗したら
            return redirect('/register')//registerへリダイレクト
            ->withErrors($validator)
            ->withInput();
            }
            //登録完了ページにユーザー名を表示させる処理
            $username = $this->create($data);
            $user = $request->get('username');
            return redirect('added')->with('username', $user);
        }
        return view('auth.register.register');
    }

    //=====================================

    public function added(){
        return view('auth.result.added');
    }

    //=====================================
}
