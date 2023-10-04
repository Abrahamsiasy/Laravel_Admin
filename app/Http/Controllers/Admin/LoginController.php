<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Hash;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        // dd('yes');
        //dd(Hash::make('password'));

        //dd(bcrypt('password'));


        return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('admin')->attempt($credential)) {
            return redirect()->route('admin.dashboard');
        } else {
            //
            //return redirect()->route('admin.dashboard');
            return redirect()->route('admin.login')->with('error', 'Information is not correct!');
        }
    }
}
