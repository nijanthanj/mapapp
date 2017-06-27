<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\DB;
use App\Register;
use App\Trip;
use App\TripHistory;
use App\Vehicles;
use App\RateDescription;

class DashboardController extends Controller
{	
	public function welcome(Request $request)
    {
    	$register = new Register();    
        $vehicle_model = new Vehicles();     
        $trip_hist_model = new TripHistory();
        $trip_model = new Trip();
           
        $driver_location = DB::table('vehicles')
            ->join('users', 'vehicles.user_id', '=', 'users.user_id')
            ->select('vehicles.*', 'users.user_fname', 'users.user_lname', 'users.mobile')            
            ->get();  

    	return view('welcome', ['driver_location' =>  $driver_location,'trip_hist' => $trip_hist_model->get()]);
    }


    public function dashboard(Request $request)
    {
        $register = new Register();    
        $vehicle_model = new Vehicles();     
        $trip_hist_model = new TripHistory();
        $trip_model = new Trip();

        $tot_rate = DB::select("SELECT sum(fare) as fare FROM trip where trip_status = 'dest_reached' ");

        $result = [             
            'en_route' => $trip_model::where(['trip_status' => 'accepted'])->count(), 
            'arrived' => $trip_model::where(['trip_status' => 'driver_arrived'])->count(), 
            'online_trip' => $trip_model::where(['trip_status' => 'trip_started'])->count(), 
            'cancelled_trip' => $trip_model::where(['trip_status' => 'cancelled_user'])->count(), 
            'online_driver' => $register::where(['user_type' => 'driver', 'online_status' => 'online', 'status' => 'approved'])->count(), 
            'offline_driver' => $register::where(['user_type' => 'driver', 'online_status' => 'offline', 'status' => 'approved'])->count(), 
            'tot_rate' => $tot_rate[0]->fare,
            'veh_count' => count($vehicle_model->get())
        ];
        return json_encode($result);
    }

	public function login(Request $request)
    {
    	$register = new Register();     
    	
    	return view('login');
    }
}