@include('header');
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="dashboard_graph">
			<div class="row x_title">
			  <div class="col-md-6">
			    <h3>User Deatils</h3>
			  </div>                  
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">				
				<div class="profile_pic">
					@if ($user_data->profile_photo)
                		<img src="{{$user_data->profile_photo}}" alt="..." class="img-circle profile_img">
                	@endif   
                	@if (!$user_data->profile_photo)
                		<img src="<?php echo url('/').'/images/Dummy.jpg'; ?>" alt="..." class="img-circle profile_img">
                	@endif   
              	</div>
				<table style="text-transform:uppercase;">
					<tr>
						<b><td class="col-md-2">Name</td><b/>
						<td class="col-md-8">{{$user_data->user_fname}} {{$user_data->user_lname}}</td>						
					</tr>
					<tr>
						<b><td class="col-md-2">User Type</td><b/>
						<td class="col-md-8">{{$user_data->user_type}}</td>						
					</tr>
					<tr>
						<b><td class="col-md-2">Email</td><b/>
						<td class="col-md-8">{{$user_data->user_email}}</td>						
					</tr>
					<tr>
						<b><td class="col-md-2">Mobile</td><b/>
						<td class="col-md-8">{{$user_data->mobile}}</td>						
					</tr>
					<tr>
						<b><td class="col-md-2">city</td><b/>
						<td class="col-md-8">{{$user_data->city}}</td>						
					</tr>
					<tr>
						<b><td class="col-md-2">status</td><b/>
						<td class="col-md-8">{{$user_data->status}}</td>						
					</tr>
					<tr>
						<b><td class="col-md-2">online status</td><b/>
						<td class="col-md-8">{{$user_data->online_status}}</td>						
					</tr>
				</table>
				<div class="clearfix"></div>

			</div>                    
			<div class="clearfix"></div>
			<div class="row x_title">
			  <div class="col-md-6">
			    <h3>Trip Deatils</h3>
			  </div>                  
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">								
				<div class="table-responsive">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th>Trip ID</th>                                                                    
                                  <th>Pickup</th>
                                  <th>Drop-off</th>
                                  <th>No. of pas</th>
                                  <th>KM</th>
                                  <th>FARE</th>
                                  <th>Trip status</th>                                        
                              </tr>
                          </thead>
                          <tbody>                       	
                             @foreach ($trip_details as $trip_data)                                 
                      			     <tr>                                            
                                      <td>{{$trip_data->trip_id}}</td>                                      
                                      <td>{{$trip_data->pickup->address}}</td>
                                      <td>{{$trip_data->dropoff->address}}</td>
                                      <td>{{$trip_data->no_of_pas}}</td>
                                      <td>{{$trip_data->km}}</td>                                                        
                                      <td>&#8377;{{$trip_data->fare}}</td>     
                                      <td>
                                          @if ($trip_data->trip_status == 'pending')
                                              <span class="upper badge bg-darkbluebg">{{$trip_data->trip_status}}</span>
                                          @endif
                                          @if ($trip_data->trip_status == 'accepted')
                                              <span class="upper badge bg-yellow">{{$trip_data->trip_status}}</span>
                                          @endif
                                          @if ($trip_data->trip_status == 'driver_arrived')
                                              <span class="upper badge bg-orange">Trip started</span>
                                          @endif
                                          @if ($trip_data->trip_status == 'dest_reached')
                                              <span class="upper badge bg-green">Completed</span>
                                          @endif
                                          @if ($trip_data->trip_status == 'cancelled_user')
                                              <span class="upper badge bg-red">Cancelled</span>
                                          @endif
                                          @if ($trip_data->trip_status == 'rejected_driver')
                                              <span class="upper badge bg-red">Rejected</span>
                                          @endif                               
                                      </td>                                         
                                 </tr>
                              @endforeach 
                          </tbody>
                      </table>
                  </div>
			</div> 
		</div>
	</div>
</div>
@include('footer');