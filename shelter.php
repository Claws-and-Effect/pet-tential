<?php
require "header.php";
?>
<script>
get("data.php?action=felineshelter",function(reply){document.getElementById("sidebar").innerHTML = reply;});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.0/Chart.bundle.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<nav class="navbar navbar-default container">
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

<div class="container">
	<div class="row">
		<div id="chartContainer">
			<canvas id="myChart"></canvas>
		</div>
		
	</div>
	<div id="secondchartContainer">
		<canvas id="Chart2"></canvas>
	</div>
</div>
<script>
var ctx = document.getElementById("myChart");
var ctx2 = document.getElementById("Chart2");
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
		maintainAspectRatio: false,
    	responsive: true
	}
});
var Chart2 = new Chart(ctx2, {
   type: 'pie',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        maintainAspectRatio: false,
        responsive: true
    }
});

</script>
<?php
require "footer.php";
?>
