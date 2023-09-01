<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('AdminLTE.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AdminLTE/register');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        User::create($request->post());

        return view('AdminLTE.login');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user=User::where('id',$id)->first();
        return  view('AdminLTE.profile')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id=User::find($id);
        return view('AdminLTE/recover-password')->with('user', $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    
    $validatedData = $request->validate([
        'password' => 'required|string|min:6'
    ]);

    $user = User::findOrFail($id);

    
    $user->password = bcrypt($validatedData['password']);
    $user->save();
    // $user->update($validatedData);
    
    return redirect('/');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete($id);
        Auth::logout();
    return redirect('/');
        
    }
}
