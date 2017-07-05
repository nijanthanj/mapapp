@include('header');
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="dashboard_graph">      
      <div class="row x_title">
        <div class="col-md-6">
          <h3>Driver Activities <small>Vehicle Current location</small></h3>
          <button onclick="initMap();" class="pull-right btn fa fa-refresh"></button>
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
     
  function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: {lat: 11.0210, lng: 76.9663}
        }); 
      var apiurl = '<?php echo URL::to('/');?>'+'/welcomemap';    
      $.ajax({
        url: apiurl,
        method: "GET",
        success: function(response){  
            var response = JSON.parse(response);  
            myLatLng = response;      
            for (var i = 0; i < myLatLng.length; i++) {
                var myobj = {};
                myobj.lat = myLatLng[i].lat;
                myobj.lng = myLatLng[i].lon;  
                var detail = myLatLng[i].user_fname+' '+myLatLng[i].user_lname+' '+myLatLng[i].vehicle_reg_no+' '+myLatLng[i].mobile;
                var icon = "<?php echo url('/').'/images/'; ?>"+myLatLng[i].vehicle_status+'.png';                
                createMarker(myobj,detail,icon);
            }      
          }
      });                
      
      function createMarker(place,detail,icon) {               
        var marker = new google.maps.Marker({
          position: place,
          map: map,
          icon: icon,
          title: detail
        });
     }
  }
  initMap();
      // window.setInterval(function(){
      //   initMap();
      // }, 10000);
</script>