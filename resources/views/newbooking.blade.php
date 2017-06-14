
<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- jquery-ui --> 
        <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlrdksW4BHONkIuE4Cs0dMucG-uQiQHxk&libraries=places&callback=initMap"
        async defer></script>
<div class="content-wrapper">
	<div class="col-md-6">
        <label>First Name</label>        
        <div id="field" data-field-id="{{$driver_location}}" ></div>
        <input type="text" class="form-control" id="fname" name="fname">
        <label>Last Name</label>
        <input type="text" class="form-control" id="lname" name="lname">
        <label>Mobile</label>
        <input type="number" class="form-control" id="mobile" name="mobile">
        <label>Number of passengers</label>
        <input type="number" class="form-control" id="passenger" name="passenger">
        <label>From Address</label>
        <input id="autocomplete1" class="form-control geo_complete" placeholder="Enter From Address"
             onFocus="geolocate('autocomplete1');" type="text" value="" autocomplete="on"></input>
        <input type="text" value="" class="hide form-control" id="autocomplete1_lat">
        <input type="text" value="" class="hide form-control" id="autocomplete1_lon">
        <label>Destiation Address</label>
        <input id="autocomplete2" class="form-control geo_complete" placeholder="Enter To Address"
             onFocus="geolocate('autocomplete2');" type="text" value="" autocomplete="on"></input>
        <input type="text" value="" class="hide form-control" id="autocomplete2_lat">
        <input type="text" value="" class="hide form-control" id="autocomplete2_lon">
        <p><br/><button onclick="book()" class="pull-right btn btn-active" id="book">Book</button></p>
        <p id="error">Please enter valid inputs<p>        
    </div>
    <div class="col-md-6">
        <div id="map" style="height:500px;width:600px;"></div>
    </div>    
</div>

<script type="text/javascript">	
    jQuery('#error').hide();
    var book_clear = 'false';
    function book(){
        $('#error').hide();
        var book_clear = 'false';
        var fname = $.trim($('#fname').val());
        var lname = $.trim($('#lname').val());
        var mobile = $.trim($('#mobile').val());
        var passenger = $.trim($('#passenger').val());
        var autocomplete1 = $.trim($('#autocomplete1').val());
        var autocomplete1_lat = $.trim($('#autocomplete1_lat').val());
        var autocomplete1_lon = $.trim($('#autocomplete1_lon').val());
        var autocomplete2 = $.trim($('#autocomplete2').val());
        var autocomplete2_lat = $.trim($('#autocomplete2_lat').val());
        var autocomplete2_lon = $.trim($('#autocomplete2_lon').val());

        if(!fname || !lname || !mobile || !passenger || !autocomplete1 || !autocomplete1_lat || !autocomplete1_lon || !autocomplete2 || !autocomplete2_lat || !autocomplete2_lon){
            $('#error').show();
            book_clear = 'false';
        }else{            
            var successurl = '<?php echo URL::to('/');?>'+'/booking';
            var apiurl = '<?php echo URL::to('/');?>'+'/createbooking';
            var data = {fname : fname,
                        lname : lname,
                        mobile: mobile,
                        passenger: passenger,
                        autocomplete1 : autocomplete1,
                        autocomplete1_lat: autocomplete1_lat,
                        autocomplete1_lon : autocomplete1_lon,
                        autocomplete2: autocomplete2,
                        autocomplete2_lat : autocomplete2_lat,
                        autocomplete2_lon: autocomplete2_lon
                        };
            $.ajax({
              url: apiurl,
              method: "POST",
              data: data,            
              success: function(response){  
                location.href = successurl;
                    //var response = response.split(" ");
                    //response = JSON.parse(response[1]);                     
                    // if(response.error){
                    //     $('#err_msg').show();
                    // }else if(response.success){                
                    //     location.href = successurl;
                    // }
                }
            });
        }
    }    

	function geolocate(idspecific){				
		initialize(idspecific);        
		google.maps.event.addDomListener(window, 'load', initialize); 					
	}

	function initialize(idspecific) {
		var options = {		  
          types: ['address'],          
          componentRestrictions: {country: 'in'}
		};
		var input = document.getElementById(idspecific);
		var autocomplete = new google.maps.places.Autocomplete(input, options);        
        google.maps.event.addListener(autocomplete, 'place_changed',
           function() {            
              var place = autocomplete.getPlace();
              var lat = place.geometry.location.lat();
              var lng = place.geometry.location.lng();              
              var latid = '#'+idspecific+'_lat';
              var lonid = '#'+idspecific+'_lon';              
              $(latid).val(lat);
              $(lonid).val(lng);
              initMap();
           }
        );
	}
    
    function initMap() {    
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: {lat: 11.0210, lng: 76.9663}
        });
        directionsDisplay.setMap(map);

        calculateAndDisplayRoute(directionsService, directionsDisplay);        

        var myLatLng = $('#field').data();
        
        for (var i = 0; i < myLatLng.fieldId.length; i++) {
            var myobj = {};
            myobj.lat = myLatLng.fieldId[i].lat;
            myobj.lng = myLatLng.fieldId[i].lat;  
            var detail = myLatLng.fieldId[i].user_fname+' '+myLatLng.fieldId[i].user_lname+' '+myLatLng.fieldId[i].vehicle_reg_no+' '+myLatLng.fieldId[i].mobile;
            createMarker(myobj,detail);
        }
        function createMarker(place,detail) {            
          var marker = new google.maps.Marker({
            position: place,
            map: map,
            title: detail
          });
       }
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var selectedMode = 'DRIVING';
        if($('#autocomplete1_lat').val() && $('#autocomplete2_lat').val()){
            var originpathobj = {};
            originpathobj.lat = parseFloat($('#autocomplete1_lat').val());
            originpathobj.lng = parseFloat($('#autocomplete1_lon').val());
            var destpathobj = {};
            destpathobj.lat = parseFloat($('#autocomplete2_lat').val());
            destpathobj.lng = parseFloat($('#autocomplete2_lon').val());
            console.log(originpathobj);
            directionsService.route({            
              origin: originpathobj,
              destination: destpathobj,  
              travelMode: google.maps.TravelMode[selectedMode]
            }, function(response, status) {
              if (status == 'OK') {
                directionsDisplay.setDirections(response);
              } else {
                window.alert('Directions request failed due to ' + status);
              }
            });
        }
      }
</script>