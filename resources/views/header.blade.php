<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>UNGAL AUTO</title>

    <!-- Bootstrap -->
    <link href="<?php echo url('/'); ?>/jsvendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo url('/'); ?>/jsvendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
   
    <!-- Custom Theme Style -->
    <link href="<?php echo url('/'); ?>/build/css/custom.css" rel="stylesheet">
  </head>

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
            @include('sidebar');        
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
          <div class="row tile_count">
            <a href="<?php echo url('/').'/vehicles/all'; ?>">
              <div class="col-md-1 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Total</span>
                <div class="count veh_count">0</div>              
              </div>
            </a>
            <a href="<?php echo url('/').'/vehicles/available'; ?>">
              <div class="col-md-1 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Available</span>
                <div class="count online_vehicles">0</div>              
              </div>
            </a>
            <a href="<?php echo url('/').'/vehicles/notavailable'; ?>">
              <div class="col-md-1 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Unavailable </span>
                <div class="count offline_vehicles">0</div>              
              </div>
            </a>
            <a href="<?php echo url('/').'/vehicles/ontrip'; ?>">
              <div class="col-md-1 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Ontrip</span>
                <div class="count online_trip">0</div>              
              </div>
            </a>
            <a href="<?php echo url('/').'/booking/accepted'; ?>">
              <div class="col-md-1 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Enroute</span>
                <div class="count en_route">0</div>              
              </div>
            </a>
            <a href="<?php echo url('/').'/booking/driver_arrived'; ?>">
              <div class="col-md-1 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Arrived</span>
                <div class="count arrived">0</div>              
              </div>
            </a>            
            <a href="<?php echo url('/').'/booking/cancelled_user'; ?>">
              <div class="col-md-2 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Cancelled Trips</span>
                <div class="count online_trip">0</div>              
              </div>
            </a>            
            <div class="col-md-2 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Today's Collections</span>
              <div class="count">&#8377;<span class="count tot_rate">0</span></div>              
            </div>            
          </div>
          <!-- /top tiles -->