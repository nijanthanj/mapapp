<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Storage;
use League\Flysystem\Filesystem;
use App\Register;

class DashboardController extends Controller
{	
	public function welcome(Request $request)
    {
    	$register = new Register();     
    	
    	return view('welcome', ['contactlist' =>  $register->get(),'contact_count' => count($register->get())]);
    }

	public function login(Request $request)
    {
    	$register = new Register();     
    	
    	return view('login');
    }
}