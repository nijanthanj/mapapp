@extends('header');            
@extends('sidebar');
<div class="content-wrapper">    
    <div class="col-md-12">
        <div class="table-responsive">
            <table  class="table table-striped">
                <thead>
                    <tr>
                        <th>Trip ID</th>
                        <th>Driver ID</th>
                        <th>Pickup</th>
                        <th>Drop-off</th>
                        <th>Trip status</th>                                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($booking_list as $booking_list)
                        <tr>
                            <td>{{$booking_list->trip_id}}</td>
                            <td>{{$booking_list->driver_id}}</td>
                            <td>{{$booking_list->pickup}}</td>
                            <td>{{$booking_list->dropoff}}</td>
                            <td>{{$booking_list->trip_status}}</td>                                            
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@extends('footer');