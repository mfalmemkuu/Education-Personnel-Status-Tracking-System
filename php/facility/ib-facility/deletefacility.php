<?php
require_once '../database.php';
$statement = $conn->prepare('DELETE FROM Facilities WHERE FacilityID = :FacilityID ;');
$statement->bindParam('FacilityID',$_GET["FacilityID"]);
$statement->execute();
header("Location: showfacility.php");
?>