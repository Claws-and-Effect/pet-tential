<?php
require 'DB.php';//Creates $conn object with connection details.
switch ($_GET["action"]){
	case "suburb":
		$suburb = $_GET["suburb"];
		if ($suburb=="all") {
			$search = "suburb LIKE '%'";
		} else {
			$search = "suburb='".$suburb."'";
		}
		echo '<table class="table">
<thead><tr><th>Statistic</th><th>Result</th><th>Count</th></tr></thead>';
        $result = $conn->query("SELECT suburb, COUNT(*) AS magnitude FROM RegisteredPets where type='Dog' AND ".$search." GROUP BY suburb ORDER BY magnitude DESC LIMIT 1");
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            echo "<tr><td>Total dogs</td><td></td><td>".$row["magnitude"]."</td></tr>";
        }else{
            echo "";
        }
		$result = $conn->query("SELECT animal_name, COUNT(*) AS magnitude FROM RegisteredPets where type='Dog' AND ".$search." GROUP BY animal_name ORDER BY magnitude DESC LIMIT 1");
        if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			echo "<tr><td>Most popular name</td><td>".$row["animal_name"]."</td><td>".$row["magnitude"]."</td></tr>";
        }else{
            echo "";
        }
        $result = $conn->query("SELECT breed, COUNT(*) AS magnitude FROM RegisteredPets where type='Dog' AND ".$search." GROUP BY breed ORDER BY magnitude DESC LIMIT 1");
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            echo "<tr><td>Most popular breed</td><td>".$row["breed"]."</td><td>".$row["magnitude"]."</td></tr>";
        }else{
            echo "";
        }
        $result = $conn->query("SELECT colour, COUNT(*) AS magnitude FROM RegisteredPets where type='Dog' AND ".$search." GROUP BY colour ORDER BY magnitude DESC LIMIT 1");
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            echo "<tr><td>Most popular colour</td><td>".$row["colour"]."</td><td>".$row["magnitude"]."</td></tr>";
        }else{
            echo "";
        }
		echo '</table>';
        break;
	default:
		echo "Invalid action";
		break;
}
$conn->close();
?>
