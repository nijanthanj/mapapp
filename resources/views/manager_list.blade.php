@include('header');
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="dashboard_graph">
                    <div class="row x_title">
                      <div class="col-md-6">
                        <h3>Manger List</h3>
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
@include('footer');

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