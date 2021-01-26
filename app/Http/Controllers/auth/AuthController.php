<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Validator;

class AuthController extends Controller
{
    public function loginPage(){
        if(Auth::check()){
            return redirect('/home');
        }
        return view('login');
    }
    public function login(Request $request){
        $v = Validator::make(
            $request->all(),
            [
                'password' => 'required',
            ],
        );
        if ($v->fails()) {
            return Redirect::back()->withErrors($v)->withInput();
        } 
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->isSuperAdmin || Auth::user()->isCC){
                return Redirect::to('/home');
            }
            return Redirect::to('/checkPhonePage');
        }
        return Redirect::back()->withErrors('The Username or Password invalid.')->withInput();
        }
}
