@include('header');
<div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">
              <div class="row x_title">
                <div class="col-md-6">
                  <h3>Booking Info</h3>
                </div>                  
              </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="table-responsive">
                      <table  class="table table-striped">
                          <thead>
                              <tr>
                                  <th>Trip ID</th>
                                  <th>Driver</th>
                                  <th>User</th>
                                  <th>User Mobile</th>
                                  <!-- <th>Pickup</th>
                                  <th>Drop-off</th> -->
                                  <th>No. of pas</th>
                                  <th>KM</th>
                                  <th>FARE</th>
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
                                      <!-- <td>{{$booking_list->pickup}}</td>
                                      <td>{{$booking_list->dropoff}}</td> -->
                                      <td>{{$booking_list->no_of_pas}}</td>
                                      <td>{{$booking_list->km}}</td>                                                        
                                      <td>&#8377;{{$booking_list->fare}}</td>     
                                      <td>
                                          @if ($booking_list->trip_status == 'pending')
                                              <span class="upper badge bg-darkbluebg">{{$booking_list->trip_status}}</span>
                                          @endif
                                          @if ($booking_list->trip_status == 'accepted')
                                              <span class="upper badge bg-yellow">{{$booking_list->trip_status}}</span>
                                          @endif
                                          @if ($booking_list->trip_status == 'driver_arrived')
                                              <span class="upper badge bg-orange">Trip started</span>
                                          @endif
                                          @if ($booking_list->trip_status == 'dest_reached')
                                              <span class="upper badge bg-green">Completed</span>
                                          @endif
                                          @if ($booking_list->trip_status == 'cancelled_user')
                                              <span class="upper badge bg-red">Cancelled</span>
                                          @endif
                                          @if ($booking_list->trip_status == 'rejected_driver')
                                              <span class="upper badge bg-red">Rejected</span>
                                          @endif                               
                                      </td>                                         
                                  </tr>
                              @endforeach

                          </tbody>
                      </table>
                  </div>
                </div>                    
              <div class="clearfix"></div>
            </div>
          </div>
</div>
@include('footer');