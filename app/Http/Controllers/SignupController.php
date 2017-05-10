<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Storage;
use League\Flysystem\Filesystem;
use App\Register;

class SignupController extends Controller
{
    public function signup(Request $request)
    {          
        $register = new Register();
        
        $register->user_email = $request->email;     
        $register->user_fname = $request->fname;   
        $register->user_lname = $request->lname;
        $register->password = md5($request->password);
        $register->city = $request->city;     
        
        $extension = '.jpg';
        $filename = $register->id.$extension;
        $register->reg_cert = $filename;   
        $register->insurance = $filename;
        $register->permit    = $filename;
        $register->license = $filename;
        $register->status = $filename;

        if($register->save()){            
            Storage::disk('local')->put($filename, base64_decode($request->RC));            

            $res = [
                'success' => 'Registered successfully',
                'error' => ''
            ];
        }else{
            $res = [
                'success' => '',
                'error' => 'Internal server error'
            ];
        }
        return json_encode($res);               
    }

    public function checkemail(Request $request)
    {
        $mail = $request->email;
        $mobile = $request->mobile;
        $res = [
        	'success' => 'Email and phone number validated',
        	'error' => ''
        ];
       	return json_encode($res);
    }

    public function profilePhoto(Request $request)
    {
        $profile_photo = $request->profile_photo;
        $extension = '.jpg';
        $filename = 'pic'.$extension;
        Storage::disk('local')->put($filename, base64_decode($profile_photo));            
        $res = [
            'success' => 'Profile picture uploaded successfully',
            'error' => ''
        ];
        return json_encode($res);
    }

    public function citylist(Request $request)
    {        
        $res = ['Chennai','Banglore','Trichy','Coimbatore'      	
        ];
       	return json_encode($res);
    }
}
