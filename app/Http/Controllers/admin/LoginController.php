<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class loginController extends Controller
{
    public function index(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if (Auth::attempt($credentials)) {
            
            $user = User::where('id', Auth::user()->id)->first();
            
            return view('AdminLTE.index')->with('user', $user);
        } else {
            return Redirect()->back()->with('success', 'EROR!');
        }
    }
}
