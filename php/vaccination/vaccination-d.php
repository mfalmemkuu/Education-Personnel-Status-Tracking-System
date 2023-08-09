<?php
require_once '../database.php';

// Start output buffering to capture any output
ob_start();

$sql = "DELETE 
FROM Vaccinations 
WHERE MedicareCardNumber = :MedicareCardNumber;";

$vaccination = $conn->prepare($sql);
$vaccination->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

if ($vaccination->execute()) {
    ob_end_clean(); // Clear the output buffer
    header("Location: ./index.php");
    exit; // Terminate the script
} else {
    ob_end_clean(); // Clear the output buffer
    echo "Error deleting vaccination.";
}

// End output buffering and flush any captured output to the browser
ob_end_flush();
?>