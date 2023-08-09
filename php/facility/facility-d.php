<?php
require_once '../database.php';
$statement = $conn->prepare('DELETE FROM Facilities 
WHERE FacilityID = :FacilityID;');
$statement->bindParam(':FacilityID',$_GET["FacilityID"]);
if($statement->execute()) {
    header("Location: ./index.php");
}
else {
    echo "error deleting facility.";
}


?>