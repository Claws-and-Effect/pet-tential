<?php
require 'header.php';
?>
 	<div class="container-fluid">
    	<div id="underMap" class="content">
			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
      					<div class="modal-header">
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        					<h4 class="modal-title" id="myModalLabel">Choose an option to display on map</h4>
      					</div>
      					<div class="modal-body">
						<select id="choiceSelector" class="form-control">
                    		<option class="choice">Breed</option>
                    		<option class="choice">Name</option>
                		</select>
						<input type="text" class="form-control" id="breedOrName" placeholder="Breed or Name">
						<br>
					</div>
      				<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      					<button id="Searcherino" type="button" class="btn btn-primary">Search</button>
					</div>
    			</div>
  			</div>
		</div>
		<div id="mapContainer" class="content"></div>
		<!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="float:right;">
        	Display Breed or Name on map
        </button>
		
	</div>
    <script>
    var map;
    function initMap() {
    	map = new google.maps.Map(document.getElementById('mapContainer'), {
        center: {lat: -38.143543, lng: 144.359831},
        zoom: 13
        });
    }
	var choices = document.getElementsByClassName("choice");
	for(var i = 0; i < choices.length; i++){
		choices[i].addEventListener("click", function(message){
			document.getElementById("breedOrName").placeholder = this.innerHTML;	
		});
	}
	document.getElementById("Searcherino").addEventListener("click", function(){
		var input = document.getElementById("breedOrName").value;		
		get("data.php?action=findanother&param="+document.getElementById("choiceSelector").value+"&input="+input,findanotherCallback)
	});    
	function findanotherCallback(reply){
		alert(reply);
		var marker = new google.maps.Marker({
		position: {lat: 35.55555, lng: 145.2123123},
		map: map,
		title: "testerino!"
		});
	}
	
	</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYtR7QeOqFggI_F_cYu3ObacfijTq3pAI&callback=initMap"
    async defer></script>
<?php
require 'footer.php';

?>


