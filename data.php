<?php
require 'DB.php';//Creates $conn object with connection details.
switch ($_GET["action"]){
	case "felineshelter":
		$result = $conn->query("SELECT * FROM IncomingFelines");

		if($result->num_rows > 0){
     		// output data of each row
    		echo '{"results":['."\n";
			while($row = $result->fetch_assoc()) {
				echo '{"IncomingFelines":'.'"'.$row["IncomingFelines"].'"}';
				echo '{"NumberFelines":'.'"'.$row["NumberFelines"].'"}';
        		echo '{"PercentageFelines":'.'"'.$row["PercentageFelines"]."\"},\n";
	    			
			}
			echo ']}';
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
