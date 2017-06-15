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
                        <span class="badge bg-red pull-right">50%</span>
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
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div id="field" data-field-id="{{$driver_location}}" ></div>
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count">{{$contact_count}}</div>              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Online Drivers</span>
              <div class="count">{{$online_driver}}</div>              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Drivers</span>
              <div class="count">{{$online_driver}}</div>              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Online Trips</span>
              <div class="count">{{$tot_driver}}</div>              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Total Collections</span>
              <div class="count">&#8377;{{$tot_rate}}</div>              
            </div>            
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

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
          <br />
          </div>
        </div>
        <!-- /page content -->
@extends('footer');
<script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>        
<script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
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
</script>