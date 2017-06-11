@extends('header');            
@extends('sidebar');            
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Admin Template Dashboard</h1>
            <small>Very detailed & featured admin.</small>
            <ol class="breadcrumb">
                <li><a href="<?php echo URL::to('/');?>/newbooking"><i class="pe-7s-home"></i> New Booking</a></li>
                
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number">10</span></h2>
                            <div class="small">Online Drivers</div>
                            <div class="sparkline1 text-center" style="overflow: hidden;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number">20</span></h2>
                            <div class="small">Total Drivers</div>
                            <div class="sparkline2 text-center" style="overflow: hidden;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number">30</span></h2>
                            <div class="small">Total users</div>
                            <div class="sparkline3 text-center" style="overflow: hidden;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number">20</span></h2>
                            <div class="small">Online Trips</div>
                            <div class="sparkline4 text-center" style="overflow: hidden;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- datamap -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 ">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Drivers current location</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="map1" style="overflow: hidden;"></div>
                    </div>
                </div>
            </div>            
            <!-- Activities -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Recent Activities</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul class="activity-list list-unstyled">
                            <li class="activity-purple">
                                <small class="text-muted">9 minutes ago</small>
                                <p>You <span class="label label-success label-pill">recommended</span> Karen Ortega</p>
                            </li>
                            <li class="activity-danger">
                                <small class="text-muted">15 minutes ago</small>
                                <p>You followed Olivia Williamson</p>
                            </li>
                            <li class="activity-warning">
                                <small class="text-muted">22 minutes ago</small>
                                <p>You <span class="text-danger">subscribed</span> to Harold Fuller</p>
                            </li>
                            <li class="activity-primary">
                                <small class="text-muted">30 minutes ago</small>
                                <p>You updated your profile picture</p>
                            </li>
                            <li>
                                <small class="text-muted">35 minutes ago</small>
                                <p>You deleted homepage.psd</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                <div class="panel panel-bd lobidrag">                    
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Contacts</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table  class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contactlist as $contacts)
                                        <tr>
                                            <td>{{$contacts->user_fname}}</td>
                                            <td>{{$contacts->user_lname}}</td>
                                            <td>{{$contacts->user_email}}</td>
                                            <td>{{$contacts->mobile}}</td>
                                            <td>{{$contacts->city}}</td>
                                            <td><button class="primary">VIEW</button></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6 col-lg-4 hidden-sm hidden-md">
                <div class="social-widget">
                    <ul>
                        <li>
                            <div class="fb_inner">
                                <i class="fa fa-facebook"></i>
                                <span class="sc-num">5,791</span>
                                <small>Fans</small>
                            </div>
                        </li>
                        <li>
                            <div class="twitter_inner">
                                <i class="fa fa-twitter"></i>
                                <span class="sc-num">691</span>
                                <small>Followers</small>
                            </div>
                        </li>
                        <li>
                            <div class="g_plus_inner">
                                <i class="fa fa-google-plus"></i>
                                <span class="sc-num">147</span>
                                <small>Followers</small>
                            </div>
                        </li>
                        <li>
                            <div class="dribble_inner">
                                <i class="fa fa-dribbble"></i>
                                <span class="sc-num">3,485</span>
                                <small>Followers</small>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div> <!-- /.row -->
    </section> <!-- /.content -->
</div>
@extends('footer');