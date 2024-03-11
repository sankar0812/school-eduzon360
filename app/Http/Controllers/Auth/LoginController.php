<?php

namespace App\Http\Controllers\Auth;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\session;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware(\App\Http\Middleware\CheckLoginStatus::class);

    }


    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'status' => 1))) {
            if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.home');
            } else if (auth()->user()->type == 'staff') {
                return redirect()->route('staff.home');
            } else if (auth()->user()->type == 'clerk') {
                return redirect()->route('clerk.home');
            } else if (auth()->user()->type == 'frontoffice') {
                return redirect()->route('frontoffice.home');
            } else if (auth()->user()->type == 'accountant') {
                return redirect()->route('accountant.home');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')
                ->with('failed', 'Email-Address And Password Are Wrong.');
        }
    }
    
//     public function logout(Request $request): RedirectResponse
// {
//     Auth::logout();
 
//     $request->session()->invalidate();
 
//     $request->session()->regenerateToken();
 
//     return redirect()->route('login');
// }
    
}
