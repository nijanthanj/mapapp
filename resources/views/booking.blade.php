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
                  <div class="dashboard_graph">
                    <div class="row x_title">
                      <div class="col-md-6">
                        <h3>Booking InfoSS</h3>
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
        </div>
@extends('footer');