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
use App\Rating;
use App\RateDescription;

class TripController extends Controller
{   

    public function booking($booking_status)
    {
        if($booking_status == 'accepted' || $booking_status == 'driver_arrived' || $booking_status == 'cancelled_user') {
            $where_veh = ['trip_status' => $booking_status]; 
            $trip_details = DB::table('trip')
                ->join('users', 'trip.user_id', '=', 'users.user_id')            
                ->select('trip.*', 'users.user_fname', 'users.user_lname', 'users.mobile')  
                ->where($where_veh) 
                ->orderby('trip.trip_id', 'desc')          
                ->get();  
        }else{
            $trip_details = DB::table('trip')
                ->join('users', 'trip.user_id', '=', 'users.user_id')            
                ->select('trip.*', 'users.user_fname', 'users.user_lname', 'users.mobile')  
                ->orderby('trip.trip_id', 'desc')          
                ->get(); 
        }    
        
        return view('booking', ['booking_list' =>  $trip_details]);        
    }

    public function vehicles($vehicle_status)
    {
        if($vehicle_status == 'available' || $vehicle_status == 'notavailable' || $vehicle_status == 'ontrip') {
            $where_veh = ['vehicle_status' => $vehicle_status]; 
            $trip_details = DB::table('vehicles')
            ->join('users', 'vehicles.user_id', '=', 'users.user_id')            
            ->select('vehicles.*', 'users.user_fname', 'users.user_lname', 'users.mobile') 
            ->where($where_veh) 
            ->orderby('vehicles.vehicle_id', 'desc')          
            ->get();
        }else{
            $trip_details = DB::table('vehicles')
            ->join('users', 'vehicles.user_id', '=', 'users.user_id')            
            ->select('vehicles.*', 'users.user_fname', 'users.user_lname', 'users.mobile')             
            ->orderby('vehicles.vehicle_id', 'desc')          
            ->get();
        }   
           
        
        return view('vehicles', ['vehicle_list' =>  $trip_details]);        
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
        $vehiclelist = [];
        foreach ($veh_list as $key => $value) {
            $vehiclelist[$value->vehicle_id] = $this->distance($request->autocomplete1, $value->address, "K");
        }   

        if(count($veh_list)){
            asort($vehiclelist);      
            $getvehicle = array_keys($vehiclelist);  
            $getkm = array_values($vehiclelist); 
            if($getkm[0] <= 3){                
                foreach ($veh_list as $key => $value) {
                   if($getvehicle[0] == $value->vehicle_id){
                     $final_driver = $value->user_id;
                   }
                }

                $where_driver = ['user_id' => $final_driver];
                $driverdetails = $register::where($where_driver)->get();
            }else{
                $res = [
                'km' => $vehiclelist,
                'success' => '',
                'error' => 'No vehicles near you now, Try after some time'
                ];
                return json_encode($res);
            }
        }else{
            $res = [
                'success' => '',
                'error' => 'No vehicles available now'
            ];
            return json_encode($res);
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
        
        
        if($trip_model->km > 1.8){
            $trip_model->fare = 25+round(($trip_model->km - 1.8)*10*1.20);
        }else{
            $trip_model->fare = 25;
        }        

        if($trip_model->save()){
            $where_up = ['user_id' => $final_driver];
            $vehicle_model::where($where_up)->update(['vehicle_status' => 'ontrip']);        
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
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);          
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        
        $data = curl_exec($ch);             
        $data = utf8_decode($data);
        $obj = json_decode($data);
        curl_close($ch);   
        
        if($mode == 'k' && $obj->rows[0]->elements[0]->status != 'NOT_FOUND'){
            $result = explode(' ', $obj->rows[0]->elements[0]->distance->text);
            return $result[0];            
        }else if($obj->rows[0]->elements[0]->status != 'NOT_FOUND'){            
            $result = explode(' ', $obj->rows[0]->elements[0]->duration->text);            
            return $result[0];            
        }else{
            $km = 1;
            return $km;
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
        if(count($trip_notify)){
            $trip_notify[0]->pickup = json_decode($trip_notify[0]->pickup);
            $trip_notify[0]->dropoff = json_decode($trip_notify[0]->dropoff);            
    	     $res = ['status' => 'success', 'data' => $trip_notify];
        }else{
            $res = ['status' => 'nodata', 'data' => $trip_notify];
        }
        return $res;
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
        if(count($trip_notify)){
            $trip_notify[0]->pickup = json_decode($trip_notify[0]->pickup);
            $trip_notify[0]->dropoff = json_decode($trip_notify[0]->dropoff);            
             $res = ['status' => 'success', 'data' => $trip_notify];
        }else{
            $res = ['status' => 'nodata', 'data' => $trip_notify];
        }
        return $res;
    }

    public function trip_status(Request $request)
    {
        $trip_model = new Trip();    
        $trip_hist_model = new TripHistory();  
        $vehicle_model = new Vehicles();  
        $register = new Register();
        
        $where = ['driver_id' => $request->driver_id,'trip_id' =>  $request->trip_id];
        $result = $trip_model::where($where)->update(['trip_status' => $request->trip_status]);
        $pickup_details = $trip_model::where(['trip_id' =>  $request->trip_id])->get();
            $trip_hist_model->his_type = 'trip_status';
            $trip_hist_model->trip_id = $request->trip_id;  
            $trip_hist_model->user_id = $request->driver_id;
            $trip_hist_model->his_msg = $request->trip_status;
            $trip_hist_model->save();
        if($result) {            
            if($request->trip_status == 'rejected_driver'){
                    $reject_list_full = DB::table('trip_history')            
                    ->select('user_id')
                    ->where(['his_msg' => 'rejected_driver','trip_id' =>  $request->trip_id])
                    ->get(); 

                    $reject_list = [];
                    foreach ($reject_list_full as $key => $value) {
                        $reject_list[] = $value->user_id;
                    }                                        
                    
                    $veh_list = DB::table('vehicles')                     
                    ->where('vehicle_status', '=', 'available')
                    ->whereNotIn('user_id', $reject_list)
                    ->get();                     
                    
                    $driverlist = [];
                    $vehiclelist = [];

                    foreach ($veh_list as $key => $value) {
                        $vehiclelist[$value->vehicle_id] = $this->distance(json_decode($pickup_details[0]->pickup)->address, $value->address, "K");
                    }   

                    if(count($veh_list)){
                        asort($vehiclelist);            
                        $getvehicle = array_keys($vehiclelist);
                        foreach ($veh_list as $key => $value) {
                           if($getvehicle[0] == $value->vehicle_id){
                             $final_driver = $value->user_id;
                           }
                        }

                        $where_driver = ['user_id' => $final_driver];
                        $driverdetails = $register::where($where_driver)->get();
                        $wheretrip = ['trip_id' =>  $request->trip_id];
                        $trip_model::where($wheretrip)->update(['vehicle_id' => $getvehicle[0] ,'driver_id' => $driverdetails[0]->user_id,'trip_status' => 'pending','driver_name' => $driverdetails[0]->user_fname.' '.$driverdetails[0]->user_lname,'driver_mobile' => $driverdetails[0]->mobile]);                        
                        $vehicle_model::where($where_driver)->update(['vehicle_status' => 'ontrip']);  
                        $trip_his_model = new TripHistory();  
                        $trip_his_model->his_type = 'trip_status';
                        $trip_his_model->trip_id = $request->trip_id;  
                        $trip_his_model->user_id = $driverdetails[0]->user_id;
                        $trip_his_model->his_msg = 'pending';
                        $trip_his_model->save();
                    }
            }      
            if($request->trip_status == 'dest_reached' || $request->trip_status == 'rejected_driver'){
                $where_up = ['user_id' => $request->driver_id];
                $vehicle_model::where($where_up)->update(['vehicle_status' => 'available']);  
            }
            if($request->trip_status == 'accepted'){
                $where_up = ['user_id' => $request->driver_id];
                $vehicle_model::where($where_up)->update(['vehicle_status' => 'ontrip']);  
            }
            if($request->trip_status == 'trip_started'){
                $trip_model::where($where)->update(['start_date' => date('Y-m-d H:i:s')]);
            }
            if($request->trip_status == 'driver_arrived'){
                $trip_model::where($where)->update(['fare' => 25]);
            }   
            if($request->trip_status == 'dest_reached'){
                $duration = round((strtotime(date('Y-m-d H:i:s'))-strtotime($pickup_details[0]->start_date)) / 60);
                $fare = $pickup_details[0]->fare + ($duration*0.5);
                $trip_model::where($where)->update(['end_date' => date('Y-m-d H:i:s'), 'duration' => $duration, 'fare' => round($fare)]);
            }  
            
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
    public function username($user_id){
        $register = new Register();        
        $where = ['user_id' => $user_id];
        $result = $register::where($where)->get();
        
        return $result['0']->user_fname.' '.$result['0']->user_lname;
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
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
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
        $result = $vehicle_model::where($where)->update(['lat' => $request->lat,'lon' => $request->lon, 'address' => $request->address]);
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
            ("SELECT fare,km,date(updated_at) as updated_at FROM trip WHERE driver_id = ".$request->driver_id." AND WEEKOFYEAR(created_at) >= WEEKOFYEAR(NOW())-2");
        $bar_rate = array();

        foreach ($bar_rate_full as $key => $value) {
                $some = DB::select("SELECT sum(fare) as fare,sum(km) as km FROM trip WHERE driver_id = ".$request->driver_id." AND updated_at >= '".$value->updated_at." 00:00:00' AND updated_at <= '".$value->updated_at." 23:59:59'");
                $bar_rate[$key]['fare'] = $some['0']->fare;
                $bar_rate[$key]['km'] = $some['0']->km;
                $bar_rate[$key]['date'] = $value->updated_at;
        }        

        $bar_rate['sum'] = DB::select          
            ("SELECT sum(fare) as fare,sum(km) as km FROM trip WHERE driver_id = ".$request->driver_id." AND WEEKOFYEAR(created_at) >= WEEKOFYEAR(NOW())-2");
        
        if(count($bar_rate)){            
             $res = ['status' => 'success', 'data' => $bar_rate];
        }else{
            $res = ['status' => 'nodata', 'data' => $bar_rate];
        }
        return $res;
    }

    public function weekly_report(Request $request)
    {
        $trip_model = new Trip();            
        $rating = new Rating();
        $bar_rate = array();    
        
        $bfr_pre_week =  DB::select          
            ("SELECT count(*) as count,sum(rate) as rate FROM rating WHERE rating_to = ".$request->driver_id." AND WEEKOFYEAR(created_at) = WEEKOFYEAR(NOW())-2 ");
            
        $prev_week = DB::select          
            ("SELECT count(*) as count,sum(rate) as rate FROM rating WHERE rating_to = ".$request->driver_id." AND WEEKOFYEAR(created_at) = WEEKOFYEAR(NOW())-1 ");
        
        $current_week = DB::select          
            ("SELECT count(*) as count,sum(rate) as rate FROM rating WHERE rating_to = ".$request->driver_id." AND WEEKOFYEAR(created_at) = WEEKOFYEAR(NOW())");

        if($current_week[0]->count){
            $bar_rate[0]['rate'] = round($current_week[0]->rate/$current_week[0]->count);
        }else{
            $bar_rate[0]['rate'] = 0;
        }
        $week_number  = date("W", strtotime('now'));        
        $prev_week_number  = $week_number -1;
        $bfr_pre_week_number  = $prev_week_number -1;
        $year_number  = date("o", strtotime('now'));
        if($week_number<=9)
        {
          $week_number= "0".$week_number; 
        }
        if($prev_week_number<=9)
        {
          $prev_week_number= "0".$prev_week_number; 
        }
        if($bfr_pre_week_number<=9)
        {
          $bfr_pre_week_number= "0".$bfr_pre_week_number; 
        }

        $lastmonday = $bar_rate['0']['from'] = date('Y-m-d', strtotime("$year_number-W$week_number"));         
        $bar_rate['0']['to'] = date("Y-m-d", strtotime("$lastmonday +6 days"));
        $bar_rate['0']['week'] = 'current_week';

        if($prev_week[0]->count){
            $bar_rate[1]['rate'] = round($prev_week[0]->rate/$prev_week[0]->count);
        }else{
            $bar_rate[1]['rate'] = 0;
        }
        $lastmonday = $bar_rate['1']['from'] = date('Y-m-d', strtotime("$year_number-W$prev_week_number"));         
        $bar_rate['1']['to'] = date("Y-m-d", strtotime("$lastmonday +6 days"));
        $bar_rate['1']['week'] = 'prev_week';

        if($bfr_pre_week[0]->count){
            $bar_rate[2]['rate'] = round($bfr_pre_week[0]->rate/$bfr_pre_week[0]->count);    
        }else{
            $bar_rate[2]['rate'] = 0;
        }
        $lastmonday = $bar_rate['2']['from'] = date('Y-m-d', strtotime("$year_number-W$bfr_pre_week_number"));         
        $bar_rate['2']['to'] = date("Y-m-d", strtotime("$lastmonday +6 days"));
        $bar_rate['2']['week'] = 'bfr_pre_week';

        if(count($bar_rate)){            
             $res = ['status' => 'success', 'data' => $bar_rate];
        }else{
            $res = ['status' => 'nodata', 'data' => $bar_rate];
        }

        return json_encode($res);
    }

    public function weekly_report_range(Request $request)
    {
        $trip_model = new Trip();            
        $rating = new Rating();
        $bar_rate = array();            
        
        $current_week = DB::select          
            ("SELECT count(*) as count,sum(rate) as rate FROM rating WHERE rating_to = ".$request->driver_id." AND created_at BETWEEN '".$request->from."' AND '".$request->to." 23:59:59'");
        $bar_rate[0]['from'] = $request->from;
        $bar_rate[0]['to'] = $request->to;
        $tot_trips = DB::select          
            ("SELECT count(*) as count FROM trip WHERE driver_id = ".$request->driver_id." AND created_at BETWEEN '".$request->from."' AND '".$request->to." 23:59:59'");
        $bar_rate[0]['tot_trips'] = $tot_trips['0']->count;
        $bar_rate[0]['rated_trips'] = $current_week[0]->count;

        $full_star_trips = DB::select          
            ("SELECT count(*) as count FROM rating WHERE rating_to = ".$request->driver_id." AND rate > 4");
        
        $bar_rate[0]['full_star_trips'] = $full_star_trips['0']->count;

        $bad_comments_res = array();
        $good_comments_res = array();
        $bad_comments = DB::select          
            ("SELECT rating_comment,rated_by,trip_id FROM rating WHERE rating_to = ".$request->driver_id." AND rate <= 2");
        foreach ($bad_comments as $key => $value) {
            $bad_comments_res[] = $this->username($value->rated_by).' commented as '.$value->rating_comment;
        }
        $bar_rate[0]['bad_comments'] = $bad_comments_res;

        $good_comments = DB::select          
            ("SELECT rating_comment,rated_by,trip_id FROM rating WHERE rating_to = ".$request->driver_id." AND rate >= 4");
        foreach ($good_comments as $key => $value) {
            $good_comments_res[] = $this->username($value->rated_by).' commented as '.$value->rating_comment;
        }
        $bar_rate[0]['good_comments'] = $good_comments_res;
        if($current_week[0]->count){
            $bar_rate[0]['rate'] = round($current_week[0]->rate/$current_week[0]->count);
        }else{
            $bar_rate[0]['rate'] = 0;
        }        

        if(count($bar_rate)){            
             $res = ['status' => 'success', 'data' => $bar_rate];
        }else{
            $res = ['status' => 'nodata', 'data' => $bar_rate];
        }

        return json_encode($res);
    }

    public function driver_trip_history(Request $request)
    {
        $trip_model = new Trip();    
        $where_ph = ['trip.driver_id' => $request->driver_id];
        $driver_trip_history = DB::table('trip')            
            ->select('trip_id','updated_at','fare')
            ->where($where_ph)
            ->get(); 
        if(count($driver_trip_history)){            
             $res = ['status' => 'success', 'data' => $driver_trip_history];
        }else{
            $res = ['status' => 'nodata', 'data' => $driver_trip_history];
        }
        
        return $res;
    }
}