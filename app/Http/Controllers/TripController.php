<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\DB;
use App\Trip;
use App\TripHistory;

class TripController extends Controller
{   

    public function booking(Request $request)
    {
        $trip_model = new Trip();    
        
        return view('booking', ['booking_list' =>  $trip_model->get()]);
        
    }


	public function trip_notify(Request $request)
    {
    	$trip_model = new Trip();    
        $where_ph = ['trip.trip_id' => $request->trip_id];
    	$trip_notify = DB::table('trip')
            ->join('users', 'trip.user_id', '=', 'users.user_id')
            ->select('trip.*', 'users.user_fname', 'users.user_lname', 'users.mobile')
            ->where($where_ph)
            ->get(); 
    	
    	return $trip_notify;
    }

    public function trip_notify_driver(Request $request)
    {
        $trip_model = new Trip();    
        $where_ph = ['trip.driver_id' => $request->driver_id];
        $trip_notify = DB::table('trip')
            ->join('users', 'trip.user_id', '=', 'users.user_id')
            ->select('trip.*', 'users.user_fname', 'users.user_lname', 'users.mobile')
            ->where($where_ph)
            ->get(); 
        
        return $trip_notify;
    }

    public function trip_status(Request $request)
    {
        $trip_model = new Trip();    
        $trip_hist_model = new TripHistory();    
        
        $where = ['driver_id' => $request->driver_id,'trip_id' =>  $request->trip_id];
        $result = $trip_model::where($where)->update(['trip_status' => $request->trip_status]);

        if($result) {
            $trip_hist_model->his_type = 'trip_status';
            $trip_hist_model->user_id = $request->driver_id;
            $trip_hist_model->his_msg = $request->trip_status;
            $trip_hist_model->save();
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
}