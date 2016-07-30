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
                      <select id="suburb1" class="form-control">
                          <option id="*">All of Geelong</option>
<?php
$results = $conn->query("SELECT DISTINCT(suburb) as suburb FROM RegisteredPets where type='Dog' ORDER BY suburb ASC");
while($row = $results->fetch_assoc()) {
	echo '<option id="'.$row["suburb"].'">'.$row["suburb"].'</option>';
}
?>
                      </select>
                  </div>
                  <div class="col-sm-6">
                      <select id="suburb2" class="form-control">
                          <option id="*">All of Geelong</option>
<?php
$results = $conn->query("SELECT DISTINCT(suburb) as suburb FROM RegisteredPets where type='Dog' ORDER BY suburb ASC");
while($row = $results->fetch_assoc()) {
    echo '<option id="'.$row["suburb"].'">'.$row["suburb"].'</option>';
}
$conn->close();
?>
                      </select>
                  </div>
              </div>
          </div>
<?php
require 'footer.php'
?>
