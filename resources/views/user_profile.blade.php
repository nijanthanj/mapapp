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
						<b><td class="col-md-2">City</td><b/>
						<td class="col-md-8">{{$user_data->city}}</td>						
					</tr>
					<tr>
						<b><td class="col-md-2">Status</td><b/>
						<td class="col-md-8">{{$user_data->status}}</td>						
					</tr>
					<tr>
						<b><td class="col-md-2">Driver status</td><b/>
						<td class="col-md-8">{{$user_data->online_status}}</td>						
					</tr>
				</table>
				<div class="clearfix"></div>
        @if ($user_data->user_type == 'driver')
              <div class="row x_title">
                <div class="col-md-6">
                  <h3>Trip Deatils</h3>
                </div>                  
              </div>
              <div class="col-md-12">	
                  @if ($user_data->reg_cert)
          				  <img class="myImg_rc col-md-3 padd-5" onclick="viewmodal('{{$user_data->reg_cert}}');" src="{{$user_data->reg_cert}}" alt="Registration Certificate" width="300" height="200" />
                  @endif
                  @if ($user_data->permit)
          				<img class="myImg_per col-md-3 padd-5" onclick="viewmodal('{{$user_data->permit}}');" src="{{$user_data->permit}}" alt="Permit" width="300" height="200" />
                  @endif
                  @if ($user_data->license)
          				<img class="myImg_lic col-md-3 padd-5" onclick="viewmodal('{{$user_data->license}}');" src="{{$user_data->license}}" alt="License" width="300" height="200" />
                  @endif
                  @if ($user_data->insurance)
          				<img class="myImg_ins col-md-3 padd-5" onclick="viewmodal('{{$user_data->insurance}}');" src="{{$user_data->insurance}}" alt="Insurance" width="300" height="200" />
                  @endif
            </div>
        @endif
<!-- The Modal -->
<div class="modal" id="myModal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
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

<script>
// Get the modal

var modal = document.getElementById('myModal');
    var img = document.getElementById('myImg');
    var modalImg = document.getElementById('img01');    
function viewmodal(srcurl){      
    modal.style.display = "block";
    modalImg.src = srcurl;
    //captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>

<style>
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>