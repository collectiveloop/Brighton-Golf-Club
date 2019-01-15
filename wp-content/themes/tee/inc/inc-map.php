<?php
/**
 * The template for displaying map shortcode
 */
?>
<div id="map" style="height: <?php echo $height_final;?>px;"></div>
<!-- ONLY FOR THE EVENT SINGLE PAGE : MAP SCRIPT -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
<script>
	function initialize() {
	  var myLatlng = new google.maps.LatLng(<?php echo $gps_final;?>); 
	  //http://itouchmap.com/latlong.html
	  var mapOptions = {
	    zoom: 15,
	    center: myLatlng
	  }
	  var map = new google.maps.Map(document.getElementById('map'), mapOptions);
	
	  var marker = new google.maps.Marker({
	      position: myLatlng,
	      map: map,
	      title: 'Hello World!'
	  });
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
	
</script>