<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
 
            return response()->json(Auth::user(), 200);
        }
 
        return response('The provided credentials do not match our records.', 401);
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'lastname' => ['required', 'string'],
            'firstname' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'lastname' => $credentials['lastname'],
            'firstname' => $credentials['firstname'],
            'email' => $credentials['email'], 
            'password' => bcrypt($credentials['password'])
        ]);

        return response($user, 201);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return [
            'messsage' => 'Logged out'
        ];
    }
}