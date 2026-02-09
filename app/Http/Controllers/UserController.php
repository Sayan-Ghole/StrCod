<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ValidateUser = $request->validate([
            'name'=>'required|string|max:255',
            'email' =>'required|unique:users,email',
            'phone' =>'required |unique:users,numeric',
            'password'=>'required|string|min:8',
        ]);

        $user = user::create($ValidateUser);
        Auth::login($user);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $userDetails = user::all();

        return view('users.UserDetails',compact('userDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $test = user::findorFail($id);
        
        return view('Admin.UpdateUser',compact('test'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $UpdateUser = user::findorFail($id);
        $validateUserUpdate = $request->validate([
            'name'=>'required|string|max:255',
            'email' =>'required|email',
            'phone' =>'required | numeric',
            'password'=>'required|string|min:8',
        ]);

        $UpdateUser->update($validateUserUpdate);

        return redirect()->route('Admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $DeleteUser = user::findorFail($id);
        $DeleteUser->delete();
         return redirect()->route('Admin');

    }
    public function loginShow(){
        return view('users.login');
    }
    public function login(Request $request){
       $credentials = $request -> validate([
             'email' =>'required|email',
              'password'=>'required|string|min:8',
        ]);
        Auth::attempt($credentials);
       return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
