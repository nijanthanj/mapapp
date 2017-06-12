@extends('header');            
@extends('sidebar');
<div class="content-wrapper">    
    <div class="col-md-12">
        <div class="table-responsive">
            <table  class="table table-striped">
                <thead>
                    <tr>
                        <th>Trip ID</th>
                        <th>Driver</th>
                        <th>User</th>
                        <th>User Mobile</th>
                        <th>Pickup</th>
                        <th>Drop-off</th>
                        <th>No. of pas</th>
                        <th>KM</th>
                        <th>Trip status</th>                                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($booking_list as $booking_list)
                        <tr>              
                            <td>{{$booking_list->trip_id}}</td>
                            <td>{{$booking_list->driver_name}}</td>
                            <td>{{$booking_list->user_fname}}</td>
                            <td>{{$booking_list->mobile}}</td>
                            <td>{{$booking_list->pickup}}</td>
                            <td>{{$booking_list->dropoff}}</td>
                            <td>{{$booking_list->no_of_pas}}</td>
                            <td>{{$booking_list->km}}</td>
                            <td>{{$booking_list->trip_status}}</td>                                         
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@extends('footer');