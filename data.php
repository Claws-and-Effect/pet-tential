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
	case "findanother":
		if($_GET["param"] == "Breed"){
			$conn->set_charset('utf8');
			//$breed = $_GET["input"];
			$breed = $conn->real_escape_string($_GET["input"]);
			$result = $conn->query("SELECT COUNT(RegisteredPets.breed) as count, RegisteredPets.suburb, Suburbs.lat, Suburbs.lon as lng FROM RegisteredPets INNER JOIN Suburbs ON RegisteredPets.suburb=Suburbs.suburb WHERE type='Dog' AND breed like '%".$breed."%' GROUP BY suburb ORDER BY COUNT(breed) DESC");
			if($result->num_rows > 0){
				echo JSONify($result);
			}else{
				echo "0 results";
			}
		}elseif($_GET["param"] == "Name"){
			$conn->set_charset('utf8');
            //$breed = $_GET["input"];
            $name = $conn->real_escape_string($_GET["input"]);
            $result = $conn->query("SELECT COUNT(RegisteredPets.animal_name) as count, RegisteredPets.suburb, Suburbs.lat, Suburbs.lon as lng FROM RegisteredPets INNER JOIN Suburbs ON RegisteredPets.suburb=Suburbs.suburb WHERE type='Dog' AND animal_name LIKE '%".$name."%' GROUP BY suburb ORDER BY COUNT(animal_name) DESC");
            if($result->num_rows > 0){
                echo JSONify($result);
            }else{
                echo "0 results";
            }		
		}
		break;
	case "dogattacks":
		$result = $conn->query("SELECT DogAttacks.suburb, COUNT(DogAttacks.suburb) as count,Suburbs.lat as lat, Suburbs.lon as lng 
								FROM `DogAttacks` 
								INNER JOIN `Suburbs` ON DogAttacks.suburb=Suburbs.suburb 
								GROUP BY Suburb DESC 
								ORDER BY count DESC");
        if($result->num_rows > 0){
            echo JSONify($result);
        }else{
            echo "0 results";
        }
		break;
	case "noisecomplaints":
		 $result = $conn->query("SELECT NoiseComplaints.suburb, SUM(NoiseComplaints.number) as count,Suburbs.lat as lat, Suburbs.lon as lng 
								FROM `NoiseComplaints` 
								INNER JOIN `Suburbs` ON NoiseComplaints.suburb=Suburbs.suburb 
								GROUP BY Suburb DESC 
								ORDER BY count DESC");
        if($result->num_rows > 0){
            echo JSONify($result);
        }else{
            echo "0 results";
        }
		break;
	case "walkingareas":
		$result = $conn->query("SELECT name, lat, lon as lng, suburb, postcode, comment, status, start, finish FROM `WalkingArea`");
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

