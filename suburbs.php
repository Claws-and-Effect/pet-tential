<?php
require 'header.php';
require 'DB.php';
?>
          <div class="container">
              <div class="page-header">
                  <h1>Compare your suburb!</h1>
              </div>
              <p>See how your suburb stacks up against the rest of Geelong! Select your suburb below to start exploring the data!</p>
              <div class="row">
                  <div class="col-sm-6">
                      <select id="suburb1" class="form-control" onchange="suburb1lookup(this)">
                          <option value="all">All of Geelong</option>
<?php
$results = $conn->query("SELECT DISTINCT(suburb) as suburb FROM RegisteredPets where type='Dog' ORDER BY suburb ASC");
while($row = $results->fetch_assoc()) {
	echo '<option id="'.$row["suburb"].'">'.$row["suburb"].'</option>';
}
?>
                      </select>
                  <div id="suburb1results"></div>
<script>
function suburb1lookup(element) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			document.getElementById("suburb1results").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("GET", "suburbdata.php?action=suburb&suburb="+element.value, true);
	xhttp.send();
}
</script>
                  </div>
                  <div class="col-sm-6">
                      <select id="suburb2" class="form-control" onchange="suburb2lookup(this)">
                          <option value="all">All of Geelong</option>
<?php
$results = $conn->query("SELECT DISTINCT(suburb) as suburb FROM RegisteredPets where type='Dog' ORDER BY suburb ASC");
while($row = $results->fetch_assoc()) {
    echo '<option id="'.$row["suburb"].'">'.$row["suburb"].'</option>';
}
$conn->close();
?>
                      </select>
                  <div id="suburb2results"></div>
<script>
function suburb2lookup(element) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("suburb2results").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "suburbdata.php?action=suburb&suburb="+element.value, true);
    xhttp.send();
}
</script>
</div>
              </div>
          </div>
<?php
require 'footer.php'
?>
