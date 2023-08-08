<?php
require_once '../database.php';
$statement1 = $conn->prepare('DELETE FROM Works_at WHERE FacilityID = :FacilityID ;');
$statement1->bindParam('FacilityID',$_GET["FacilityID"]);
$statement1->execute();
$statement2 = $conn->prepare("DELETE FROM EducationalFacilities WHERE FacilityID = :FacilityID ;");
$statement2->bindParam('FacilityID',$_GET["FacilityID"]);
$statement2->execute();
$statement3 = $conn->prepare("DELETE FROM Facilities WHERE FacilityID = :FacilityID ;");
$statement3->bindParam('FacilityID',$_GET["FacilityID"]);
$statement3->execute();
header("Location: showeducationalfacility.php");
?>