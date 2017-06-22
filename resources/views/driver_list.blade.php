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
                        <h3>Drivers List</h3>
                      </div>                  
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                       <div class="table-responsive">
                             <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>TYPE</th>                        
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_list as $user_list)
                                        <tr>                            
                                            <td class="upper">{{$user_list->user_fname}} {{$user_list->user_lname}}</td>
                                            <td> <a href="mailto:{{$user_list->user_email}}">{{$user_list->user_email}}</a></td>
                                            <td class="upper">{{$user_list->mobile}}</td>                                                                                               
                                            <td class="upper">{{$user_list->user_type}}</td> 
                                            <td class="upper">{{$user_list->status}}</td> 
                                            <td class="upper">
                                                @if ($user_list->status == 'pending')
                                                    <i title="Approve" onclick="approve('<?php echo $user_list->user_email; ?>','approved');" class="fa fa-check"></i>
                                                    <i title="Reject" onclick="approve('<?php echo $user_list->user_email; ?>','rejected');" class="fa fa-times"></i>
                                                @endif
                                                @if ($user_list->status == 'approved')
                                                    <i title="Block" onclick="approve('<?php echo $user_list->user_email; ?>','blocked');" class="fa fa-ban"></i>
                                                @endif
                                                @if ($user_list->status == 'blocked')
                                                    <span class="upper badge bg-red">Blocked</span>
                                                @endif 
                                                @if ($user_list->status == 'rejected')
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

<script type="text/javascript"> 
    function approve(email,status){
        var con = confirm("Are you sure to do the action");
        if(con == true){
        var successurl = '<?php echo URL::to('/');?>'+'/user';
            var apiurl = '<?php echo URL::to('/');?>'+'/aprrove';
            var data = {email : email,
                        status : status
                       };
            $.ajax({
              url: apiurl,
              method: "POST",
              data: data,            
              success: function(response){  
                location.href = successurl;                    
                }
            });
        }
    }    
</script>