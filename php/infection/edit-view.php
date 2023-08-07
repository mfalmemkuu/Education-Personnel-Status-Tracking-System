<?php
require_once '../database.php';

$statement = $conn->prepare('SELECT i.MedicareCardNumber, i.Date, i.Type  FROM Infections i
WHERE i.MedicareCardNumber = :MedicareCardNumber;');
$statement->bindParam(":MedicareCardNumber", $_GET["MedicareCardNumber"]);
$statement->execute();
$infection = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["MedicareCardNumber"]) && isset($_POST["Date"]) && isset($_POST["Type"]) ) {

    // First, add the person details to the Persons table
    try {
        $infection = $conn->prepare("UPDATE Infections i
        SET i.`Date` = :Date, i.`Type` = :Type 
        WHERE MedicareCardNumber = :MedicareCardNumber; ");
    
        $infection->bindParam(':MedicareCardNumber',$_POST["MedicareCardNumber"]);
        $infection->bindParam(':Date',$_POST["Date"]);
        $infection->bindParam(':Type',$_POST["Type"]);
    
        if ($infection->execute()) {

            header("Location: ../infection/index.php"); // Redirect after successful update
            
            exit; // Terminate the script after the redirection
            
        } else {
            echo "Error updating infection.";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    
}

?>


<!DOCTYPE html>
<html>
<body>

    <h1>Edit Infection</h1>
    <form action="edit-view.php" method="post">
        Infection Date: <input type="date" name="Date" id="Date" value="<?= $infection["Date"]?>"><br>
        Infection Type: <input type="text" name="Type" id="Type" value="<?= $infection["Type"]?>"><br>
        <input type="hidden" name="MedicareCardNumber" id="MedicareCardNumber" value="<?= $infection["MedicareCardNumber"]?>">
        <br>
        <input type="submit">
    </form><br>
    <a href="../infection/index.php">Back to Infections</a>

</body>
</html>
