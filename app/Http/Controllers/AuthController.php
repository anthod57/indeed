<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
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

        // Log in as a company.
        if ($request->type === "company" && Auth::guard('company')->attempt($credentials, true)) {
            $request->session()->regenerate();
            $company = Auth::guard('company')->user();
 
            return response()->json($company, 200);
        }
 
        // Log in as an user.
        if ($request->type === "user" && Auth::attempt($credentials, true)) {
            $request->session()->regenerate();
            $user = Auth::user();

            return response()->json($user, 200);
        }
 
        return response('The provided credentials do not match our records.', 401);
    }

    public function register(Request $request)
    {
        // Register as an user.
        if($request->type === "user"){
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

        // Register as a company.
        if($request->type === "company"){
            $credentials = $request->validate([
                'name' => ['required', 'string'],
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
    
            $company = Company::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'], 
                'password' => bcrypt($credentials['password'])
            ]);
    
            return response($company, 201);
        }
    }

    public function logout(Request $request)
    {
        // Log out user.
        if(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
        }

        // Log out company.
        if(Auth::guard('company')->check()){
            Auth::guard('company')->logout();
        }

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return [
            'messsage' => 'Logged out'
        ];
    }
}