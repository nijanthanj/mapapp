@extends('header')           

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo url('/').'/welcome'; ?>" class="site_title"><i class="fa fa-taxi"></i> <span>UNGAL AUTO</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo url('/').'/images/Dummy.jpg'; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>Super Admin</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">                
                <ul class="nav side-menu">
                  <li><a href="<?php echo url('/').'/welcome'; ?>"><i class="fa fa-home"></i> Home</span></a>                   
                  </li>
                  <li><a href="<?php echo url('/').'/newbooking'; ?>"><i class="fa fa-edit"></i> New Booking</a>                    
                  </li>
                  <li><a href="#"><i class="fa fa-edit"></i> Add manager</a>                    
                  </li>
                  <li><a href="<?php echo url('/').'/booking'; ?>"><i class="fa fa-taxi"></i> Bookings</span></a>                   
                  </li>
                  <li><a href="<?php echo url('/').'/users'; ?>"><i class="fa fa-user"></i>Users</a>                    
                  </li>
                  <li><a><i class="fa fa-file"></i>Reports</a>                    
                  </li>     
                </ul>
              </div>      
            </div>           
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo url('/').'/images/Dummy.jpg'; ?>" alt="">Super Admin
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="upper badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="<?php echo url('/'); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>                
              </ul>
            </nav>
          </div>
        </div>      
        <div class="right_col" role="main"> 
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="col-md-5">
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
    <div class="col-md-7">
        <div id="map" style="height:500px;width:100%;"></div>
    </div>    
</div>
@extends('footer');
<script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>        
<script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlrdksW4BHONkIuE4Cs0dMucG-uQiQHxk&libraries=places&callback=initMap"
        async defer></script>
<script type="text/javascript"> 
    jQuery('#error').hide();
    var book_clear = 'false';
    function book(){
        $('#book').attr('disabled','disabled');
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
            $('#book').removeAttr('disabled');
        }else{        
            $('#book').attr('disabled','disabled');    
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
                    if(response.error){
                        alert(response.error);
                        $('#book').removeAttr('disabled');
                    }else if(response.success){    
                        alert(response.success);      
                        $('#book').removeAttr('disabled');      
                        location.href = successurl;
                    }
                }
            });
        }
    }    

  function geolocate(idspecific){       
    initialize(idspecific);        
    google.maps.event.addDomListener(window, 'load', initialize);           
  }

  function initialize(idspecific) {
    var cityBounds = new google.maps.LatLngBounds(
  new google.maps.LatLng(25.341233, 68.289986),
  new google.maps.LatLng(25.450715, 68.428345));

    var options = {     
          bounds: cityBounds,
          types: ['geocode'],          
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