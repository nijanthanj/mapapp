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

        $where_veh = ['vehicle_status' => 'available'];        
        $driver_location = DB::table('vehicles')
            ->join('users', 'vehicles.user_id', '=', 'users.user_id')
            ->select('vehicles.*', 'users.user_fname', 'users.user_lname', 'users.mobile')
            ->where($where_veh)
            ->get();                        
    	
        $where = ['trip_status' => 'trip_started'];

        $tot_rate = DB::select("SELECT sum(fare) as fare FROM trip");
        
        $where_online = ['user_type' => 'driver', 'online_status' => 'online'];        
        $where_driver = ['user_type' => 'driver'];        
    	return view('welcome', ['driver_location' =>  $driver_location,'trip_hist' => $trip_hist_model->get(), 'online_trip' => $trip_model::where($where)->count(), 'online_driver' => $register::where($where_online)->count(), 'tot_driver' => $register::where($where_driver)->count(), 'tot_rate' => $tot_rate[0]->fare,'contact_count' => count($register->get())]);
    }

	public function login(Request $request)
    {
    	$register = new Register();     
    	
    	return view('login');
    }
}