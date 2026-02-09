<?php

namespace App\Http\Controllers;
use App\Models\Admin;
 use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin/AdminHomePage');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin/AdminSignUp');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateAdmin = $request->validate([
            'name' => 'required',
            'email' =>'required|email',
              'password'=>'required|string|min:8',
        ]);

       $validateAdmin['password']=Hash::make($validateAdmin['password']);
       Admin::create($validateAdmin);
        
         if (Auth::guard('admin')->attempt([
        'email' => $request->email,
        'password' => $request->password,
    ])) {
        return redirect('/admin');
    }

        return redirect('/adminSignUp');

    }

   public function loginShow()
    {
        return view('Admin/LoginAdmin');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' =>'required|email',
              'password'=>'required|string|min:8',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('/admin');
        }

        return redirect('/adminLogin');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('AdminLogin');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
