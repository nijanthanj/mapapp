@extends('header');            
@extends('sidebar');            
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-world"></i>
        </div>
        <div class="header-title">
            <h1>Bdtask - Bootstrap Admin Template Dashboard</h1>
            <small>Very detailed & featured admin.</small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Dashboard</li>
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
                            <h2><span class="count-number">206</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> +28%</span></h2>
                            <div class="small">% New Sessions</div>
                            <div class="sparkline1 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number">321</span> <span class="slight"><i class="fa fa-play fa-rotate-90 c-white"> </i> +10%</span> </h2>
                            <div class="small">Total visitors</div>
                            <div class="sparkline2 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number">789</span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning"> </i> +29%</span></h2>
                            <div class="small">Total users</div>
                            <div class="sparkline3 text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                <div class="panel panel-bd">
                    <div class="panel-body">
                        <div class="statistic-box">
                            <h2><span class="count-number">171</span><span class="slight"><i class="fa fa-play fa-rotate-90 c-white"> </i> +24%</span></h2>
                            <div class="small">Bounce Rate</div>
                            <div class="sparkline4 text-center"></div>
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
                            <h4>Top 5 countries Azimuth users</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="map1"></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Messages</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="message_inner">
                            <div class="message_widgets">
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets/dist/img/avatar.png" class="img-circle" alt=""></div>
                                        <strong class="inbox-item-author">Naeem Khan</strong>
                                        <span class="inbox-item-date">-13:40 PM</span>
                                        <p class="inbox-item-text">Hey! there I'm available...</p>
                                        <span class="profile-status available pull-right"></span>
                                    </div>
                                </a> 
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets/dist/img/avatar2.png" class="img-circle" alt=""></div>
                                        <strong class="inbox-item-author">Sala Uddin</strong>
                                        <span class="inbox-item-date">-13:40 PM</span>
                                        <p class="inbox-item-text">Hey! there I'm available...</p>
                                        <span class="profile-status away pull-right"></span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets/dist/img/avatar3.png" class="img-circle" alt=""></div>
                                        <strong class="inbox-item-author">Mozammel Hoque</strong>
                                        <span class="inbox-item-date">-13:40 PM</span>
                                        <p class="inbox-item-text">Hey! there I'm available...</p>
                                        <span class="profile-status busy pull-right"></span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets/dist/img/avatar4.png" class="img-circle" alt=""></div>
                                        <strong class="inbox-item-author">Tanzil Ahmed</strong>
                                        <span class="inbox-item-date">-13:40 PM</span>
                                        <p class="inbox-item-text">Hey! there I'm available...</p>
                                        <span class="profile-status offline pull-right"></span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets/dist/img/avatar5.png" class="img-circle" alt=""></div>
                                        <strong class="inbox-item-author">Amir Khan</strong>
                                        <span class="inbox-item-date">-13:40 PM</span>
                                        <p class="inbox-item-text">Hey! there I'm available...</p>
                                        <span class="profile-status available pull-right"></span>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img"><img src="assets/dist/img/avatar.png" class="img-circle" alt=""></div>
                                        <strong class="inbox-item-author">Salman Khan</strong>
                                        <span class="inbox-item-date">-13:40 PM</span>
                                        <p class="inbox-item-text">Hey! there I'm available...</p>
                                        <span class="profile-status available pull-right"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
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
            <!-- Chat -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Chat</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <ul class="chat_list">
                            <li class="clearfix">
                                <div class="chat-avatar">
                                    <!--<a href="#" data-toggle="tooltip" data-placement="left" title="Hooray!"></a>-->
                                    <img src="assets/dist/img/avatar.png" alt="male">
                                    <i>10:00</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i>John Deo</i>
                                        <p>Hello! ✋</p>
                                    </div>
                                </div>
                            </li>
                            <li class="clearfix odd">
                                <div class="chat-avatar">
                                    <img src="assets/dist/img/avatar.png" alt="Female">
                                    <i>10:01</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i>Marco Lopes</i>
                                        <p>Hi, How are you?☺ What about our next meeting?😼</p>
                                    </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="chat-avatar">
                                    <img src="assets/dist/img/avatar.png" alt="male">
                                    <i>10:01</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i>John Deo</i>
                                        <p>Yeah everything is fine 👍</p>
                                    </div>
                                </div>
                            </li>
                            <li class="clearfix odd">
                                <div class="chat-avatar">
                                    <img src="assets/dist/img/avatar.png" alt="male">
                                    <i>10:02</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i>Marco Lopes</i>
                                        <p>Wow that's great 👏</p>
                                    </div>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="chat-avatar">
                                    <img src="assets/dist/img/avatar.png" alt="male">
                                    <i>10:01</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i>John Deo</i>
                                        <p>What can you do with HTML VIEWER ?</p>
                                    </div>
                                </div>
                            </li>
                            <li class="clearfix odd">
                                <div class="chat-avatar">
                                    <img src="assets/dist/img/avatar.png" alt="male">
                                    <i>10:02</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i>Marco Lopes</i>
                                        <p>It helps to beautify/format your HTML.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="clearfix odd">
                                <div class="chat-avatar">
                                    <img src="assets/dist/img/avatar.png" alt="male">
                                    <i>10:02</i>
                                </div>
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <i>Marco Lopes</i>
                                        <p>It helps to save and share HTML content and show the HTML output</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <div class="input-group">
                            <input type="text" class="form-control emojionearea" placeholder="Your Message. . . ">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button">Send</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- calender -->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <div class="panel panel-bd lobidisable">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Calender</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <!-- monthly calender -->
                        <div class="monthly_calender">
                            <div class="monthly" id="m_calendar"></div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        This is standard panel footer 
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
</div> <!-- /.content-wrapper -->
@extends('footer');