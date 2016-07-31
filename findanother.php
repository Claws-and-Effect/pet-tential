<?php
require 'header.php';
?>
 	<div class="container-fluid">
    	<div id="underMap" class="content">
			<div id="mapContainer" class="content">
			</div>
			<!--i Modal Select breed or name-->
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
		<nav class="navbar navbar-default">
      		<div class="container">
       			<div class="navbar-header">
         				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
           				<span class="sr-only">Toggle navigation</span>
           				<span class="icon-bar"></span>
           				<span class="icon-bar"></span>
           				<span class="icon-bar"></span>
         				</button>
       			</div>
       			<div id="navbar" class="collapse navbar-collapse">
           			<button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#myModal">Breed or Name</button>
					<button id="DogAttacksBtn" type="button" class="btn btn-primary navbar-btn">Dog Attacks</button>
       				<button id="NoiseComplaintsBtn" type="button" class="btn btn-primary navbar-btn">Noise Complaints</button>
					<button id="WalkingAreasBtn" type="button" class="btn btn-primary navbar-btn">Dog Walking Areas</button>
				</div><!--/.nav-collapse -->
      		</div>
		</nav>
		</div>
	</div>
    <script>
    var map;
	var Circles = [];
	var Content = [];
	var InfoWindows = [];
	var Markers = [];
	function initMap() {
    	map = new google.maps.Map(document.getElementById('mapContainer'), {
        center: {lat: -38.143543, lng: 144.359831},
        zoom: 11
        });
    }
	function remove_circle(circle) {
    	// remove event listers
    	google.maps.event.clearListeners(circle, 'click_handler_name');
    	google.maps.event.clearListeners(circle, 'drag_handler_name');
    	circle.setRadius(0);
    	circle.setMap(null);
	}	
	var choices = document.getElementsByClassName("choice");
	for(var i = 0; i < choices.length; i++){
		choices[i].addEventListener("click", function(message){
			document.getElementById("breedOrName").placeholder = this.innerHTML;	
		});
	}
	//Add event listeners to buttons
	document.getElementById("Searcherino").addEventListener("click", function(){
		var input = document.getElementById("breedOrName").value;		
		get("data.php?action=findanother&param="+document.getElementById("choiceSelector").value+"&input="+input,findanotherCallback)
	});    
	document.getElementById("DogAttacksBtn").addEventListener("click", function(){
		get("data.php?action=dogattacks",showDogAttacks);
	});
	document.getElementById("NoiseComplaintsBtn").addEventListener("click", function(){
        get("data.php?action=noisecomplaints",showNoiseComplaints);
    });
	document.getElementById("WalkingAreasBtn").addEventListener("click", function(){
        get("data.php?action=walkingareas",showWalkingAreas);
    });
	//AJAXin'
	function findanotherCallback(reply){
		if(reply.trim()  == "0 results"){
			alert("No results found for '"+document.getElementById("breedOrName").value+"'");
			document.getElementById("breedOrName").value = "";
			document.getElementById("breedOrName").focus();
			return;
		}
		clearMap();
		var Data = JSON.parse(reply);
		for(var counter = 0; counter < Data.results.length; counter++){
			var lat = parseFloat(Data.results[counter].lat);
			var lng = parseFloat(Data.results[counter].lng);
			var circle = new google.maps.Circle({
            	strokeColor: '#00FF00',
            	strokeOpacity: 0.8,
            	strokeWeight: 2,
            	fillColor: '#00FF00',
            	fillOpacity: 0.35,
            	map: map,
            	center: {lat: lat, lng: lng},
            	radius: Math.sqrt(Data.results[counter].count) * 100
          	});
			circle.addListener('click', function(){
				var index = Circles.indexOf(this);
				var content = Content[index];
				var infowindow = new google.maps.InfoWindow({
					content: content,
					position: {lat: this.center.lat(), lng: this.center.lng()}
				});
				InfoWindows.push(infowindow);
				infowindow.open(map);
			});
			var doggo = document.getElementById("breedOrName").value;
			if(doggo == ""){
				Content.push("All dogs in "+Data.results[counter].suburb+": "+Data.results[counter].count);
			}else{
				Content.push("Number of '"+doggo+"s' in "+Data.results[counter].suburb+": "+Data.results[counter].count);
			}
			Circles.push(circle);
		}
		$("#myModal").modal("hide");
	}
	function clearMap(){
		//Clean up map from last stuff
        for(var i = 0; i < Circles.length; i++){
            remove_circle(Circles[i]);
        }
        for(var i = 0; i < InfoWindows.length; i++){
            InfoWindows[i].close();
        }
		for(var i = 0; i < Markers.length; i++){
			Markers[i].setMap(null);
			Markers[i] = null;
		}
        Circles = [];
        Content = [];
        InfoWindows = [];
		Markers = [];
	}
	//AJAXin'
	function showDogAttacks(reply){
		if(reply.trim()  == "0 results"){
            alert("No results found");
            return;
        }
        clearMap();
        var Data = JSON.parse(reply);
		for(var counter = 0; counter < Data.results.length; counter++){
            var lat = parseFloat(Data.results[counter].lat);
            var lng = parseFloat(Data.results[counter].lng);
            var circle = new google.maps.Circle({
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35,
                map: map,
                center: {lat: lat, lng: lng},
                radius: Math.sqrt(Data.results[counter].count) * 100
            });
            circle.addListener('click', function(){
                var index = Circles.indexOf(this);
                var content = Content[index];
                var infowindow = new google.maps.InfoWindow({
                    content: content,
                    position: {lat: this.center.lat(), lng: this.center.lng()}
                });
                InfoWindows.push(infowindow);
                infowindow.open(map);
            });
            Content.push(Data.results[counter].suburb+" has "+Data.results[counter].count+" dog attacks");
            Circles.push(circle);
        }
	}
	function showNoiseComplaints(reply){
		if(reply.trim()  == "0 results"){
            alert("No results found");
            return;
        }
        clearMap();
        var Data = JSON.parse(reply);
        for(var counter = 0; counter < Data.results.length; counter++){
            var lat = parseFloat(Data.results[counter].lat);
            var lng = parseFloat(Data.results[counter].lng);
            var circle = new google.maps.Circle({
                strokeColor: '#0000FF',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#0000FF',
                fillOpacity: 0.35,
                map: map,
                center: {lat: lat, lng: lng},
                radius: Math.sqrt(Data.results[counter].count) * 100
            });
            circle.addListener('click', function(){
                var index = Circles.indexOf(this);
                var content = Content[index];
                var infowindow = new google.maps.InfoWindow({
                    content: content,
                    position: {lat: this.center.lat(), lng: this.center.lng()}
                });
                InfoWindows.push(infowindow);
                infowindow.open(map);
            });
            Content.push(Data.results[counter].suburb+" has "+Data.results[counter].count+" noise complaints");
            Circles.push(circle);
        }

	}
	function showWalkingAreas(reply){
		if(reply.trim()  == "0 results"){
            alert("No results found");
            return;
        }
        clearMap();
        var Data = JSON.parse(reply);
        for(var counter = 0; counter < Data.results.length; counter++){
            var lat = parseFloat(Data.results[counter].lat);
            var lng = parseFloat(Data.results[counter].lng);
            var marker = new google.maps.Marker({
                map: map,
                position: {lat: lat, lng: lng},
            });
            marker.addListener('click', function(){
                var index = Markers.indexOf(this);
                var content = Content[index];
                var infowindow = new google.maps.InfoWindow({
                    content: content,
                });
                InfoWindows.push(infowindow);
                infowindow.open(map, this);
            });
			var rlt = Data.results[counter];
			var stats = rlt.status;
			if(stats.trim() == "no"){
				stats = "onleash";
			}
            Content.push("Name: "+rlt.name+"<br>Location: "+rlt.suburb+", "+rlt.postcode+"<br>Comment: "+rlt.comment+"<br>Status: "+stats+"<br>Duration: "+rlt.start+" - "+rlt.finish);
            Markers.push(marker);
        }
	}
	</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYtR7QeOqFggI_F_cYu3ObacfijTq3pAI&callback=initMap"
    async defer></script>
<?php
require 'footer.php';

?>


