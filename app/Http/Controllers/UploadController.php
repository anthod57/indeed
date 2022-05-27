<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request){
        // check if image has been received from form
        if($request->file('avatar')){
        
            // processing the uploaded image
            $avatar_name = User::find($request->user()->id)->id.'.png';
            $avatar_path = $request->file('avatar')->storeAs($request->user()->type === "user" ? "users" : "companies", $avatar_name, 'profile_pictures');
            
            return response()->json([
                'status'    =>  'success',
                'message'   =>  'Profile Photo Updated!',
                'avatar_url'=>  url('storage/images/profiles/'.$avatar_path)
            ]);    
        }
      
        return response()->json([
          'status'    => 'failure',
          'message'   => 'No image file uploaded!',
          'avatar_url'=> NULL
        ]);
    }
}
