<?php
require_once '../database.php';
$sql = $conn->prepare("DELETE FROM Registered_At 
WHERE MedicareCardNumber = :MedicareCardNumber;");
$sql->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);
if ($sql->execute()) {
    header("Location: ./index.php");
}else {
    echo "Error deleting registration.";
}
?>