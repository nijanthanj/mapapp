<br />
          </div>
        </div>        
        <!-- footer content -->
        <footer>
          <div class="pull-right">
            UNGAL AUTO Admin Template</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo url('/'); ?>/jsvendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo url('/'); ?>/jsvendors/bootstrap/dist/js/bootstrap.min.js"></script>    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo url('/'); ?>/build/js/custom.js"></script>
    <script src="<?php echo url('/'); ?>/assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>        
<script src="<?php echo url('/'); ?>/assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>

  </body>
</html>

<script type="text/javascript">
      function dashboard() {        
        var apiurl = '<?php echo URL::to('/');?>'+'/dashboard';    
          $.ajax({
            url: apiurl,
            method: "GET",
            success: function(response){  
                var response = JSON.parse(response);                 
                  $('.en_route').html(response.en_route);
                
                  $('.arrived').html(response.arrived);
                
                  $('.online_trip').html(response.online_trip);
                
                  $('.cancelled_trip').html(response.cancelled_trip);
                
                  $('.online_vehicles').html(response.online_vehicles);
                
                  $('.offline_vehicles').html(response.offline_vehicles);
                                
                  $('.tot_rate').html(response.tot_rate);
                
                  $('.veh_count').html(response.veh_count);
                
              }
          });  
      }
      dashboard();
      window.setInterval(function(){
        dashboard();
      }, 10000);
      
</script>
