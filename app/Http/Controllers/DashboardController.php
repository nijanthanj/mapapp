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
        $trip_hist_model = new TripHistory();

    	return view('welcome', ['trip_hist' => $trip_hist_model->get()]);
    }

    public function welcomemap(Request $request)
    {
        $register = new Register();    
        $vehicle_model = new Vehicles();             
        $trip_model = new Trip();
           
        $driver_location = DB::table('vehicles')
            ->join('users', 'vehicles.user_id', '=', 'users.user_id')
            ->select('vehicles.*', 'users.user_fname', 'users.user_lname', 'users.mobile')            
            ->get();  

        return json_encode($driver_location);
    }


    public function dashboard(Request $request)
    {
        $register = new Register();    
        $vehicle_model = new Vehicles();     
        $trip_hist_model = new TripHistory();
        $trip_model = new Trip();

        $tot_rate = DB::select("SELECT sum(fare) as fare FROM trip where trip_status = 'dest_reached' AND DATE(end_date) = DATE(NOW())");

        $result = [             
            'en_route' => $trip_model::where(['trip_status' => 'accepted'])->count(), 
            'arrived' => $trip_model::where(['trip_status' => 'driver_arrived'])->count(), 
            'online_trip' => $vehicle_model::where(['vehicle_status' => 'ontrip'])->count(), 
            'cancelled_trip' => $trip_model::where(['trip_status' => 'cancelled_user'])->count(), 
            'online_vehicles' => $vehicle_model::where(['vehicle_status' => 'available'])->count(), 
            'offline_vehicles' => $vehicle_model::where(['vehicle_status' => 'notavailable'])->count(), 
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