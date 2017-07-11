@include('header');
<div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">
              <div class="row x_title">
                <div class="col-md-6">
                  <h3>Vehicles Info</h3>
                </div>                  
              </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="table-responsive">
                      <table  class="table table-striped">
                          <thead>
                              <tr>
                                  <th>Vehicle ID</th>
                                  <th>Reg No</th>
                                  <th>Driver</th>
                                  <th>Mobile</th>
                                  <th>Type</th>
                                  <th>No of seats</th>
                                  <th>Min pas</th>
                                  <th>Max pas</th>
                                  <th>Address</th>                                  
                                  <th>Vehicle status</th>                                        
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($vehicle_list as $vehicle_list)
                                  <tr>              
                                      <td>{{$vehicle_list->vehicle_id}}</td>
                                      <td>{{$vehicle_list->vehicle_reg_no}}</td>
                                      <td>{{$vehicle_list->user_fname}}</td>
                                      <td>{{$vehicle_list->mobile}}</td>
                                      <td>{{$vehicle_list->vehicle_type}}</td>
                                      <td>{{$vehicle_list->no_of_seats}}</td>
                                      <td>{{$vehicle_list->min_passenger}}</td>
                                      <td>{{$vehicle_list->max_passenger}}</td>
                                      <td>{{$vehicle_list->address}}</td>                                      
                                      <td>
                                          @if ($vehicle_list->vehicle_status == 'available')
                                              <span class="upper badge bg-green">{{$vehicle_list->vehicle_status}}</span>                                          
                                          @elseif ($vehicle_list->vehicle_status == 'ontrip')
                                              <span class="upper badge bg-orange">On Trip</span>                                          
                                          @elseif ($vehicle_list->vehicle_status == 'notavailable')
                                              <span class="upper badge bg-red">Not Available</span>
                                          @else 
                                              <span class="upper badge bg-blue">{{$vehicle_list->vehicle_status}}</span>
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