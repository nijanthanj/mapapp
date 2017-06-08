@extends('header');            
@extends('sidebar');
<script src="https://maps.googleapis.com/maps/api/js?key= AIzaSyBlrdksW4BHONkIuE4Cs0dMucG-uQiQHxk&libraries=places&callback=initAutocomplete"
        async defer></script>
<div class="content-wrapper">
	<div class="col-md-6" name="booking">
        <label>First Name</label>
        <input type="text" class="form-control" class="fname" name="fname">
        <label>Last Name</label>
        <input type="text" class="form-control" class="lname" name="lname">
        <label>Mobile</label>
        <input type="number" class="form-control" class="mobile" name="mobile">
        <label>From Address</label>
        <input id="autocomplete1" class="form-control geo_complete" placeholder="Enter From Address"
             onFocus="geolocate()" type="text" value="" autocomplete="on"></input>
        <label>Destiation Address</label>
        <input id="autocomplete2" class="form-control geo_complete" placeholder="Enter To Address"
             onFocus="geolocate()" type="text" value="" autocomplete="on"></input>
        <p><br/><button class="pull-right btn btn-active" id="book">Book</button></p>
    </div>
</div>
@extends('footer');
<script type="text/javascript">
	
	function geolocate(){				
		initialize();
		google.maps.event.addDomListener(window, 'load', initialize); 					
	}

	function initialize() {
		var options = {
		  types: ['(cities)'],
		};
		var input = document.getElementById('autocomplete1');
		var autocomplete = new google.maps.places.Autocomplete(input, options);
	}
</script>

