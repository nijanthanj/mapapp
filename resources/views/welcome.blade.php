@include('header');
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="dashboard_graph">
      <div id="field" data-field-id="{{$driver_location}}" ></div>
      <div class="row x_title">
        <div class="col-md-6">
          <h3>Driver Activities <small>Vehicle Current location</small></h3>
        </div>                  
      </div>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <div id="map" style="height:500px;width:100%;"></div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
        <div class="x_panel">
            <div class="x_title">
              <h2>Recent Activities</h2>                  
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <div class="dashboard-widget-content">                    
                <ul class="list-unstyled timeline widget">
                  <li>
                    <div class="block">
                      <div class="block_content">
                        <h2 class="title">
                           <a>New trip booked</a>
                        </h2>
                        <div class="byline">
                          <span>1 hours ago</span> by <a>Jane Smith</a>
                        </div>
                        <p class="excerpt">From Coimbatore to Mettupalayam</a>
                        </p>
                      </div>
                    </div>
                  </li>                      
                </ul>
              </div>
            </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>                 
@include('footer');
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlrdksW4BHONkIuE4Cs0dMucG-uQiQHxk&libraries=places&callback=initMap"
        async defer></script>
<script type="text/javascript">
  var myLatLng = $('#field').data();   
     
  function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: {lat: 11.0210, lng: 76.9663}
      });     
      for (var i = 0; i < myLatLng.fieldId.length; i++) {
          var myobj = {};
          myobj.lat = myLatLng.fieldId[i].lat;
          myobj.lng = myLatLng.fieldId[i].lon;  
          var detail = myLatLng.fieldId[i].user_fname+' '+myLatLng.fieldId[i].user_lname+' '+myLatLng.fieldId[i].vehicle_reg_no+' '+myLatLng.fieldId[i].mobile;
          createMarker(myobj,detail);
      }
      function createMarker(place,detail) {
        console.log(place);
        var marker = new google.maps.Marker({
          position: place,
          map: map,
          title: detail
        });
     }
  }
</script>