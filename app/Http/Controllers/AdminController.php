<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    
    public function index($id)
    {
        if(view()->exists('AdminLTE/'.$id)){
            return view('AdminLTE/'.$id);
        }
        else {
            return view('404');
        }
        
    }

    function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        User::create($request->post());
    return view('AdminLTE.login');
    }

    function login(Request $request)
    {
        
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if (Auth::attempt($credentials)) {
            
            $user = User::where('id', Auth::user()->id)->first();
            
            return view('AdminLTE.index')->with('user', $user);
        } else {
            return Redirect()->back();
        }
    }
    
    function logout()
    {
        Auth::logout();
    
        return redirect('/');
    }

    function update(Request $request, User $user)
    {
        //$user->id=$this->id;
        //dd($user);
        
        $validatedData = $request->validate([
            'password' => 'required|string|min:6'
        ]);
    
        $user->update(['password' => bcrypt($validatedData['password'])]);
        return  view('AdminLTE.login');
        //view('AdminLTE.index')->with('user', $request->id);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete($id);
        Auth::logout();
        return view('AdminLTE.login');
    }
}
