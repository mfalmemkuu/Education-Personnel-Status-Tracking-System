<?php
$sql = "DELETE FROM Registered_At 
WHERE MedicareCardNumber = :MedicareCardNumber;";
$registration = $conn->prepare($sql);

$registration->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

if ($registration->execute()) {
    header("Location: ./index.php");
}else {
    echo "Error deleting registration.";
}
?>