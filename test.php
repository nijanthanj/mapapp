if($request->trip_status == 'dest_reached'){
                $duration = round((strtotime(date('Y-m-d H:i:s'))-strtotime($pickup_details[0]->start_date)) / 60);
                $original_distance = $this->distance($pickup_details[0]->pickup, $value->address, "K");
                
                if($original_distance > 1.8){
                    $original_fare = 25+round(($original_distance - 1.8)*10*1.20);
                }else{
                    $original_fare = 25;
                }

                $fare = $original_fare + ($duration*0.5);
                $trip_model::where($where)->update(['end_date' => date('Y-m-d H:i:s'), 'duration' => $duration, 'fare' => round($fare)]);
            } 