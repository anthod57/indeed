<?php
 
namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class CompanyAuthController extends Controller
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
 
        if (Auth::guard('company')->attempt($credentials, true)) {
            $request->session()->regenerate();
 
            return response()->json(Auth::guard('company')->user(), 200);
        }
 
        return response('The provided credentials do not match our records.', 401);
    }

    public function register(Request $request)
    {
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

    public function logout(Request $request)
    {
        Auth::guard('company')->logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return [
            'messsage' => 'Logged out'
        ];
    }
}