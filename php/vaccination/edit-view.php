<?php
require_once '../database.php';

$statement = $conn->prepare('SELECT v.MedicareCardNumber, v.Date, v.Type, v.DoseNumber  FROM Vaccinations v
WHERE v.MedicareCardNumber = :MedicareCardNumber;');
$statement->bindParam(":MedicareCardNumber", $_GET["MedicareCardNumber"]);
$statement->execute();
$vaccination = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["MedicareCardNumber"]) && isset($_POST["Date"]) && isset($_POST["Type"]) &&  isset($_POST["DoseNumber"]) ) {

    // First, add the person details to the Persons table
    try {
        $vaccination = $conn->prepare("UPDATE Vaccinations v
        SET v.`Date` = :Date, v.`Type` = :Type, v.DoseNumber =:DoseNumber
        WHERE v.MedicareCardNumber = :MedicareCardNumber; ");
    
        $vaccination->bindParam(':MedicareCardNumber',$_POST["MedicareCardNumber"]);
        $vaccination->bindParam(':Date',$_POST["Date"]);
        $vaccination->bindParam(':Type',$_POST["Type"]);
        $vaccination->bindParam(':DoseNumber',$_POST["DoseNumber"]);
    
        if ($vaccination->execute()) {

            header("Location: ./index.php"); // Redirect after successful update
            
            exit; // Terminate the script after the redirection
            
        } else {
            echo "Error updating vaccination.";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    
}

?>

<!DOCTYPE html>
<html>
<body>

    <h1>Edit Vaccination</h1>
    <form action="./edit-view.php" method="post">
        <label for="Date">Vaccination Date: </label>
        <input type="date" name="Date" id="Date" value="<?= $vaccination["Date"]?>"> <br>
        <label for="Type">Vaccination Type: </label>
        <input type="text" name="Type" id="Type" value="<?= $vaccination["Type"]?>"> <br>
        <label for="DoseNumber">Dose Number: </label>
        <input type="text" name="DoseNumber" id="DoseNumber" value="<?= $vaccination["DoseNumber"]?>"> <br>     
        <input type="hidden" name="MedicareCardNumber" id="MedicareCardNumber" value="<?= $vaccination["MedicareCardNumber"]?>">   
        <br>
        <button type="submit">Submit</button>
    </form><br><br>
    <a href="../vaccination/index.php">Back to Vaccinations</a>

</body>
</html>

<?php

?>