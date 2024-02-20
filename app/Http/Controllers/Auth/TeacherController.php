<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;



// use App\Models\User;

class TeacherController extends Controller
{
public function teachregister()
{
    return view('auth.teachregister');
}
public function saveteacher(Request $request)
{
$request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
]);
    $teacher = new User;
    $teacher->name = $request['name'];
    $teacher->email = $request['email'];
    $teacher->password = $request['password'];
    $teacher->role = 1;
    // echo $teacher;exit;
    $teacher->save();

    // return view('auth.login');
    event(new Registered($teacher));

    Auth::login($teacher);

    return redirect(RouteServiceProvider::HOME);
}
}
