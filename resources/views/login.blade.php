<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <title>Admin Template Dashboard</title>

        <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/dist/css/styleBD.css" rel="stylesheet" type="text/css"/>
        <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
        <!-- jquery-ui --> 
        <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</head>
    <body class="col-md-12">    	
        <div class="login-wrapper">            
            <div class="container-center">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="view-header">
                            <div class="header-icon">
                                <i class="pe-7s-unlock"></i>
                            </div>
                            <div class="header-title">
                                <h3>Login</h3>
                                <small><strong>Please enter your credentials to login.</strong></small>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="loginForm" novalidate>
                            <div class="form-group">
                                <label class="control-label" for="username">Email</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you username" required="" value="" name="username" id="username" class="form-control">
                                <span class="help-block small">Your unique email to app</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                                <span class="help-block small">Your strong password</span>
                            </div>
                            <div>
                                <button id="login" class="btn">Login</button>
                                <!-- <a class="btn btn-warning" href="#">Forgot password ?</a> -->
                                <p id="err_msg" class="clear">Username or password is incorrect</p>            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

<script type="text/javascript">
$('#err_msg').hide();
$('#login').click( function(event) {    
    event.preventDefault();
	$('#err_msg').hide();
	var email = $.trim($('#username').val());
	var password_str = $.trim($('#password').val());
    var successurl = '<?php echo URL::to('/');?>'+'/welcome';
    var apiurl = '<?php echo URL::to('/');?>'+'/login';
    var data = {user_email : email, password : password_str};
    $.ajax({
      url: apiurl,
      method: "POST",
      data: data,            
      success: function(response){  
            var response = JSON.parse(response);                     
            if(response.error){
                $('#err_msg').show();
            }else if(response.success){                
                location.href = successurl;
            }
        }
    });    
});
</script>