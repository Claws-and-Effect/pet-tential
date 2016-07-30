<?php
require 'DB.php';//Creates $conn object with connection details.
switch ($_GET["action"]){
	case "felineshelter":
		$result = $conn->query("SELECT * FROM IncomingFelines");

		if($result->num_rows > 0){
     		// output data of each row
    		while($row = $result->fetch_assoc()) {
        		echo "Incoming Felines: ".$row["IncomingFelines"].",Number of Felines: ".$row["NumberFelines"].",Percentage of Felines: ";
        		echo $row["PercentageFelines"]. "<br>";
    		}
		}else{
    		echo "0 results";
		}
		break;
	default:
		echo "Invalid action";
		break;
}
$conn->close();
?>
