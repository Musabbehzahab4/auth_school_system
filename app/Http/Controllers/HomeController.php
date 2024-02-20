<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $role = Auth()->user()->role;

            if ($role == 0) {

                return view('dashboard');

            } elseif ($role == 1) {

                return view('teacher');

            } elseif ($role == 2) {

                return view('student');

            } else {
                
                return redirect()->back();

            }
        }
    }

}
