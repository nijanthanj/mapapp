<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Storage;
use League\Flysystem\Filesystem;
use App\Register;
use App\City;
use Mail;

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
            $data = ['fname' => $request->fname];
            Mail::send('register', $data , function($message) use ($request){
                $message->to($request->email)
                ->subject('Registered successfully');
            });
            //$this->sms($request->mobile,'Your account registered successfully, Check your mail for more details.');
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
        $register = new Register();
        $where_email = ['user_email' => $request->email];
        $count_email = $register::where($where_email)->count();

        $where_ph = ['mobile' => $request->mobile];
        $count_ph = $register::where($where_ph)->count();

        if($count_email && $count_ph) {
            $res = [
            'error' => 'Email and phone number already exists',
            'success' => ''
            ];
        }else if($count_email) {
            $res = [
            'error' => 'Email already exists',
            'success' => ''
            ];
        }else if($count_ph) {
            $res = [
            'error' => 'Phone number already exists',
            'success' => ''
            ];
        }else{
            $res = [
                'success' => 'Email and phone number validated successfully',
                'error' => ''
            ];
        }        
        
       	return json_encode($res);
    }

    public function login(Request $request)
    {                   
        $register = new Register();        
        $where = ['user_email' => $request->user_email, 'password' => md5($request->password)];
        $result = $register::where($where)->get();  
        
        if(count($result) && $result[0]->user_id) {
            $res = [
                'success' => 'Logged in successfully',
                'driver_id' => $result[0]->user_id,
                'error' => ''
            ];
        }else{
            $res = [
                'success' => '',
                'driver_id' => 0,
                'error' => 'Username or password is incorrect'
            ];
        }
        return json_encode($res);
    }

    public function forgot(Request $request)
    {
        $register = new Register();
        $where = ['user_email' => $request->email];
        $result = $register::where($where)->get();
        
        if(count($result) && $result[0]->user_email) {
            $newpass = rand(100000,10000000);
            $passreset = $register::where($where)->update(['password' => md5($newpass)]);
            $data = ['password' => $newpass, 'fname' => $result[0]->fname];
            Mail::send('mail', $data , function($message) use ($result){
                $message->to($result[0]->user_email)
                ->subject('Your application password');
            });
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

    public function status(Request $request)
    {        
        $register = new Register();
        $where = ['user_email' => $request->email];
        $result = $register::where($where)->update(['online_status' => $request->online_status]);

        if($result) {
            $res = [
                'success' => 'Status updated successfully',
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

    public function aprrove(Request $request)
    {        
        $register = new Register();
        $where = ['user_email' => $request->email];
        $stat = $register::where($where)->update(['status' => $request->status]);        
        
        if($request->status == 'approved'){
            $result = $register::where($where)->get();
        }
        if(count($result) && $result[0]->user_email) {
            $newpass = rand(100000,10000000);
            $passreset = $register::where($where)->update(['password' => md5($newpass)]);
            $data = ['password' => $newpass, 'fname' => $result[0]->fname];
            Mail::send('mail', $data , function($message) use ($result){
                $message->to($result[0]->user_email)
                ->subject('Your application password');
            });
        }
        if($stat){
        $res = [
                'success' => 'Status updated successfully',
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

    public function userlist(Request $request)
    {
        $register = new Register();        
        $result = $register->get();
        return view('user_list', ['user_list' =>  $result]);        
    }

    public function user_account_details(Request $request)
    {
        $register = new Register();        
        $where = ['user_id' => $request->user_id];
        $result = $register::where($where)->get();        
        $custom_url =  str_replace('public','storage',url('/'));
        $result[0]->reg_cert = $custom_url.'/app/'.$result[0]->reg_cert;
        $result[0]->insurance = $custom_url.'/app/'.$result[0]->insurance;
        $result[0]->permit = $custom_url.'/app/'.$result[0]->permit;
        $result[0]->license = $custom_url.'/app/'.$result[0]->license;
        $result[0]->profile_photo = $custom_url.'/app/'.$result[0]->profile_photo;
        return $result;
    }
}
