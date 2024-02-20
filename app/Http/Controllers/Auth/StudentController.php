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

class StudentController extends Controller
{
    public function studregister()
{
    return view('auth.studregister');
}
public function savestudent(Request $request)
{
$request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
]);
    $student = new User;
    $student->name = $request['name'];
    $student->email = $request['email'];
    $student->password = $request['password'];
    $student->role = 2;
    // echo $teacher;exit;
    $student->save();

    // return view('auth.login');
    event(new Registered($student));

    Auth::login($student);

    return redirect(RouteServiceProvider::HOME);
}

}
