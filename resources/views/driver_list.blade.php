@include('header');
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
                                        <th>VIEW</th>
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
                                                    <i title="Approve" id="callmodal" data-email="<?php echo $user_list->user_email; ?>" data-toggle="modal" data-target="#myModal" class="btn btn-success fa fa-check"></i>
                                                    <i title="Reject" onclick="approve('<?php echo $user_list->user_email; ?>','rejected');" class="btn btn-danger fa fa-times"></i>
                                                @endif
                                                @if ($user_list->status == 'approved')
                                                    <i title="Block" onclick="approve('<?php echo $user_list->user_email; ?>','blocked');" class="btn btn-danger fa fa-ban"></i>
                                                @endif
                                                @if ($user_list->status == 'blocked')
                                                    <span class="upper badge bg-red">Blocked</span>
                                                @endif 
                                                @if ($user_list->status == 'rejected')
                                                    <span class="upper badge bg-red">Rejected</span>
                                                @endif                            
                                            </td> 
                                            <td class="upper">
                                                <a href="<?php echo url('/').'/users_profile/'; ?>{{$user_list->user_id}}"> <i class="btn btn-success fa fa-eye"></i></a>
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter vehicle details</h4>
      </div>
      <div class="modal-body">
        <label>Reg number</label>      
        <input type="hidden" class="form-control" name="regno" id="email" />  
        <input type="text" class="form-control" name="regno" id="regno" />
        <label>Vehicle type</label>
        <select class="form-control">
            <option val="auto">AUTO</option>
        </select>
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-success" onclick="approve($('.modal-body #email').val(),'approved');">Approve</button>
        <button type="button" class="close btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@include('footer');

<script type="text/javascript"> 
$(document).on("click", "#callmodal", function () {
     var emailId = $(this).data('email');
     $(".modal-body #email").val( emailId );
});
    function approve(email,status){
        var reg_no = $.trim($('#regno').val());
        if(status == 'approved'){            
            if(!reg_no ) {alert('Please provide reg number');}
        }else if(status != 'approved'){
            var reg_no = 'some';
        }
        if(reg_no){            
            var con = confirm("Are you sure to do the action");
            if(con == true){    
            $('.close').click();    
            var successurl = '<?php echo URL::to('/');?>'+'/drivers';
                var apiurl = '<?php echo URL::to('/');?>'+'/aprrove';
                var data = {email : email,
                            status : status,
                            reg_no : reg_no
                           };
                $.ajax({
                  url: apiurl,
                  method: "POST",
                  data: data,            
                  success: function(response){  
                    location.href = successurl;                    
                    }
                });
            }else{
                $('.close').click();
            }
        }
    }    
</script>