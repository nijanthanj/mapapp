<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Storage;
use League\Flysystem\Filesystem;
use App\Register;
use App\City;

class SignupController extends Controller
{
    public function signup(Request $request)
    {          
        $register = new Register();        
        
        $register->user_fname = $request->fname;   
        $register->user_lname = $request->lname;
        $register->user_email = $request->email;
        $register->password = md5($request->passwrd); 
        $register->mobile =$request->mob;
        $register->city = $request->city;     
        $register->user_type = $request->type;
        $register->status = 'pending';             
        

        $extension = '.jpg';
        if($request->drvlc){
            $filename = md5($request->email).'_drvlc'.$extension;
            $register->license = $filename;               
        }
        if($request->cominsur){
            $filename = md5($request->email).'_cominsur'.$extension;
            $register->insurance = $filename;             
        }
        if($request->certreg){
            $filename = md5($request->email).'_certreg'.$extension;
            $register->permit = $filename;              
        }
        if($request->carpermt){
            $filename = md5($request->email).'_carpermt'.$extension;
            $register->reg_cert = $filename;            
        } 
        if($request->profile_photo){
            $filename = md5($request->email).'_profile_photo'.$extension;
            $register->profile_photo = $filename;          
        }   

        if($register->save()){            

            $extension = '.jpg';
            if($request->drvlc){
                $filename = md5($request->email).'_drvlc'.$extension;
                Storage::disk('local')->put($filename, base64_decode($request->drvlc));            
            }
            if($request->cominsur){
                $filename = md5($request->email).'_cominsur'.$extension;
                Storage::disk('local')->put($filename, base64_decode($request->cominsur));            
            }
            if($request->certreg){
                $filename = md5($request->email).'_certreg'.$extension;
                Storage::disk('local')->put($filename, base64_decode($request->certreg));            
            }
            if($request->carpermt){
                $filename = md5($request->email).'_carpermt'.$extension;
                Storage::disk('local')->put($filename, base64_decode($request->carpermt));            
            }  
            if($request->profile_photo){
                $filename = md5($request->email).'_profile_photo'.$extension;
                Storage::disk('local')->put($filename, base64_decode($request->profile_photo));            
            }           

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

    public function login(Request $request)
    {
        $register = new Register();
        $where = ['user_email' => $request->email, 'password' => md5($request->password)];
        $count = $register::where($where)->count();
        
        if($count) {
            $res = [
                'success' => 'Logged in successfully',
                'error' => ''
            ];
        }else{
            $res = [
                'success' => '',
                'error' => 'Username or password is incorrect'
            ];
        }
        return json_encode($res);
    }

    public function forgot(Request $request)
    {
        $register = new Register();
        $where = ['user_email' => $request->email];
        $count = $register::where($where)->count();
        
        if($count) {
            $res = [
                'success' => 'Your password sent to your registered email address',
                'error' => ''
            ];
        }else{
            $res = [
                'success' => '',
                'error' => 'Email address not exits'
            ];
        }
        return json_encode($res);
    }

    public function citylist(Request $request)
    {        
        $city = new city();
        return $citylist = $city->pluck('city_name');   
    }
}
