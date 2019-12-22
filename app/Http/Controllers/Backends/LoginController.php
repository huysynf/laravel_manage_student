<?php

namespace App\Http\Controllers\Backends;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');

    }
 public function login(Request $request)
    {

            if( Auth::attempt(['email' => $request->email,'password'=>$request->password]))
            {
                return redirect('/manage');
            }

    }


}
