<?php
require 'header.php'
?>
	<div class="container-fluid">
    	<div class="row">
    		<div class="col-12">
				<div id="mapContainer" style="height:100%;"></div>
			</div>
		</div>
    </div>
	<script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('mapContainer'), {
          center: {lat: -38.143543, lng: 144.359831},
          zoom: 13
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYtR7QeOqFggI_F_cYu3ObacfijTq3pAI&callback=initMap"
    async defer></script>

<?php
require 'footer.php'
?>
