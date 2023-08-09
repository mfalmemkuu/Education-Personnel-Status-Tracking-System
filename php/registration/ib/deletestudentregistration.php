<?php
require_once '../database.php';
$statement = $conn->prepare('DELETE FROM Registered_At
                             WHERE MedicareCardNumber = :MedicareCardNumber;');
$statement->bindParam('MedicareCardNumber',$_GET["MedicareCardNumber"]);
$statement->execute();
header("Location: showstudentregistration.php");
?>