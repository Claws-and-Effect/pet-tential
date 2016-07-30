<?php
require 'DB.php';//Creates $conn object with connection details.
//Takes a results object from a mysqli query and returns a JSON string
function JSONify($results){
	$output = "";
	$counter = 0;
	$output .= '{"results":['."\n";
	while($row = $results->fetch_assoc()) {
 		$output .= json_encode($row);
		$counter++;
        if($counter == $results->num_rows){
        	$output .= "\n";
        }else{
        	$output .= ','."\n";
        }
	}
    $output .= ']}';
	return $output;
}
switch ($_GET["action"]){
	case "felineshelter":
		$result = $conn->query("SELECT * FROM IncomingFelines");
		if($result->num_rows > 0){
			echo JSONify($result);
		}else{
    		echo "0 results";
		}
		break;
	case "suburblist":
		$result = $conn->query("SELECT DISTINCT(suburb) as suburb FROM RegisteredPets where type='Dog' ORDER BY suburb ASC");
        if($result->num_rows > 0){
            echo JSONify($result);
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
