<?php
require_once '../database.php';

$sql = "DELETE FROM Infections WHERE MedicareCardNumber =:MedicareCardNumber ; ";

$vaccination = $conn->prepare($sql);
$vaccination->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

if($vaccination->execute()) {
    header("Location: ./index.php");
}
else {
    echo "Error deleting infection.";
}

?>

