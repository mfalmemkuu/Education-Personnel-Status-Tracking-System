

<?php
require_once '../database.php';

$sql = "DELETE FROM Vaccinations WHERE MedicareCardNumber =:MedicareCardNumber ; ";

$vaccination = $conn->prepare($sql);
$vaccination->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

if($vaccination->execute()) {
    header("Location: ./index.php");
}
else {
    echo "Error deleting vaccination.";
}

?>

