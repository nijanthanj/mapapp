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

class TripController extends Controller
{   

    public function booking(Request $request)
    {
        $trip_details = DB::table('trip')
            ->join('users', 'trip.user_id', '=', 'users.user_id')            
            ->select('trip.*', 'users.user_fname', 'users.user_lname', 'users.mobile')            
            ->get();   
      
        return view('booking', ['booking_list' =>  $trip_details]);        
    }

    public function newbooking(Request $request)
    {   
        $vehicle_model = new Vehicles();       
        $where_veh = ['vehicle_status' => 'available'];        
        $driver_location = DB::table('vehicles')
            ->join('users', 'vehicles.user_id', '=', 'users.user_id')
            ->select('vehicles.*', 'users.user_fname', 'users.user_lname', 'users.mobile')
            ->where($where_veh)
            ->get();         
        return view('newbooking', ['driver_location' =>  $driver_location]);        
    }
    public function createbooking(Request $request)
    {        
        $trip_model = new Trip();   
        $register = new Register();    
        $trip_hist_model = new TripHistory(); 
        $vehicle_model = new Vehicles();
        $rate_desc = new RateDescription();

        $where_ph = ['mobile' => $request->mobile];
        $old_user = $register::where($where_ph)->pluck('user_id');

        if(count($old_user) && $old_user[0]){
            $trip_model->user_id = $old_user[0]; 
            $trip_hist_model->user_id = $old_user[0]; 
        }else{
            $register->user_fname = $request->fname;   
            $register->user_lname = $request->lname;      
            $newpass= rand(100000,10000000);      
            $register->password = md5($newpass); 
            $register->mobile =$request->mobile;
            $register->user_email =$request->fname.$newpass.'.@gmail.com';
            $register->city = 'coimbatore';     
            $register->user_type = 'rider';
            $register->status = 'approved';

            if($register->save()){  
                $trip_model->user_id = $register->id; 
                $trip_hist_model->user_id = $register->id; 
            }            
        } 

        $where_veh = ['vehicle_status' => 'available'];
        $veh_list = $vehicle_model::where($where_veh)->get();  
        $driverlist = [];

        foreach ($veh_list as $key => $value) {
            $vehiclelist[$value->vehicle_id] = $this->distance($request->autocomplete1, $value->address, "K");
        }   

        if(count($vehiclelist)){
            asort($vehiclelist);            
            $getvehicle = array_keys($vehiclelist);
            foreach ($veh_list as $key => $value) {
               if($getvehicle[0] == $value->vehicle_id){
                 $final_driver = $value->user_id;
               }
            }

            $where_driver = ['user_id' => $final_driver];
            $driverdetails = $register::where($where_driver)->get();
        }
        
        if($driverdetails[0]->user_id){
            $trip_model->driver_id = $driverdetails[0]->user_id;
            $trip_model->vehicle_id = $getvehicle[0]; 
            $trip_model->driver_name = $driverdetails[0]->user_fname.' '.$driverdetails[0]->user_lname;
            $trip_model->driver_mobile = $driverdetails[0]->mobile;   
        }
       
        $trip_model->pickup = json_encode(['lat' => $request->autocomplete1_lat,'lon' => $request->autocomplete1_lon,'address' => $request->autocomplete1]);         
        $trip_model->dropoff = json_encode(['lat' => $request->autocomplete2_lat,'lon' => $request->autocomplete2_lon,'address' => $request->autocomplete2]);         
        $trip_model->no_of_pas = $request->passenger; 
        $trip_model->km = $this->distance($request->autocomplete1, $request->autocomplete2, "k");
        $trip_model->duration = $this->distance($request->autocomplete1, $request->autocomplete2, "d");
        $trip_model->trip_status = 'pending';
        
        //$where_rate = ['user_id' => $final_driver];
        //$ratedetails = $rate_desc::where($where_rate)->get();
        if($trip_model->km > 1.8){
            $trip_model->fare = 25+round(($trip_model->km - 1.8)*100*1.20);
        }else{
            $trip_model->fare = 25;
        }        

        if($trip_model->save()){
            $where_up = ['user_id' => $final_driver];
            $vehicle_model::where($where_up)->update(['status' => 'ontrip']);        
            $trip_hist_model->his_type = 'trip_status';
            $trip_hist_model->trip_id = $trip_model->id;            
            $trip_hist_model->his_msg = 'pending';
            $trip_hist_model->save();
            $this->sms($request->mobile,'Booking done successfully, Driver '.$driverdetails[0]->user_fname.' call: '.$driverdetails[0]->mobile);
            $res = [
                'success' => 'Booking done successfully',
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

    public function distance($origin, $destination, $mode) {
          
        $url = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&mode=driving&key=AIzaSyBlrdksW4BHONkIuE4Cs0dMucG-uQiQHxk&origins='.str_replace(' ', '', $origin).'&destinations='.str_replace(' ', '', $destination);
        $data = file_get_contents($url);
        $data = utf8_decode($data);
        $obj = json_decode($data);
        if($mode == 'k'){
            $result = explode(' ', $obj->rows[0]->elements[0]->distance->text);
            return $result[0];            
        }else{
            $result = explode(' ', $obj->rows[0]->elements[0]->duration->text);            
            return $result[0];            
        }        
        
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
        $where_ph = ['trip.driver_id' => $request->driver_id, 'trip.trip_status' => 'pending'];
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
        $vehicle_model = new Vehicles();  
        
        $where = ['driver_id' => $request->driver_id,'trip_id' =>  $request->trip_id];
        $result = $trip_model::where($where)->update(['trip_status' => $request->trip_status]);

        if($result) {
            if($request->trip_status == 'dest_reached'){
                $where_up = ['user_id' => $request->driver_id];
                $vehicle_model::where($where_up)->update(['status' => 'available']);  
            }      
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

    public function sendsms(Request $request){
        return $this->sms($request->number,$request->msg);
    }

    public function sms($number, $msg)
    {
        $url = 'http://bhashsms.com/api/sendmsg.php';

        $fields = array(
            'user'      => "cclenq",
            'pass'      => "123",
            'sender'    => "cclenq",
            'phone'     => $number,
            'text'      => $msg,
            'priority'  => 'ndnd',
            'type'      => 'normal'
        );

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));

        //execute post
        $result = curl_exec($ch);

        //close connection
        curl_close($ch);

        return;
    }

    public function vehicle_coords(Request $request)
    {
        $vehicle_model = new Vehicles();
        $where = ['user_id' => $request->driver_id];
        $result = $vehicle_model::where($where)->update(['lat' => $request->lat,'lon' => $request->lon]);
        if($result){
        $res = [
                'success' => 'coords updated successfully',
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

    public function weekbar(Request $request)
    {
        $trip_model = new Trip();            
        $bar_rate_full = DB::select          
            ("SELECT fare,km,date(updated_at) as updated_at FROM trip WHERE driver_id = ".$request->driver_id." AND WEEKOFYEAR(created_at) = WEEKOFYEAR(NOW())");
        $bar_rate = array();

        foreach ($bar_rate_full as $key => $value) {
                $bar_rate[$value->updated_at] = DB::select("SELECT sum(fare) as fare,sum(km) as km FROM trip WHERE driver_id = ".$request->driver_id." AND updated_at >= '".$value->updated_at." 00:00:00' AND updated_at <= '".$value->updated_at." 23:59:59'");
        }
        
        $bar_rate['sum'] = DB::select          
            ("SELECT sum(fare) as fare,sum(km) as km FROM trip WHERE driver_id = ".$request->driver_id." AND WEEKOFYEAR(created_at) = WEEKOFYEAR(NOW())");
                
        return $bar_rate;
    }

    public function driver_trip_history(Request $request)
    {
        $trip_model = new Trip();    
        $where_ph = ['trip.driver_id' => $request->driver_id];
        $driver_trip_history = DB::table('trip')            
            ->select('trip_id','updated_at','fare')
            ->where($where_ph)
            ->get(); 
        
        return $driver_trip_history;
    }
}