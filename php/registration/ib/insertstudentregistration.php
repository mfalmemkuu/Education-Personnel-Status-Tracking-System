<?php
require_once '../database.php';

if (isset($_POST["MedicareCardNumber"]) && isset($_POST["FacilityID"]) ) {
    $registeredat = $conn->prepare("INSERT INTO Registered_At (MedicareCardNumber, FacilityID, StartDate)
                              VALUES(:MedicareCardNumber, :FacilityID, :StartDate);");

    $registeredat->bindParam(':MedicareCardNumber', $_POST["MedicareCardNumber"]);
    $registeredat->bindParam(':FacilityID', $_POST["FacilityID"]);
    $registeredat->bindParam(':StartDate', $_POST["StartDate"]);
    if ($registeredat->execute()) {
        header("Location: showstudentregistration.php"); 
            exit;
    } else {
        echo "Error registering student.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a student to an educational facility</title>
</head>
<body>
    <h1>Add a student to an educational facility</h1>
    <form action="./insertstudentregistration.php" method="post">
        <label for="MedicareCardNumber">Medicare card</label><br>
        <input type="text" name="MedicareCardNumber" id="MedicareCardNumber"> <br>
        <label for="FacilityID">Facility ID</label><br>
        <input type="number" name="FacilityID" id="FacilityID"> <br>
        <label for="StartDate">Start Date</label><br>
        <input type="date" name="StartDate" id="StartDate"> <br>
        <button type="submit">add</button>
    </form>
    <a href="./showstudentregistration.php">back to alumni</a>
</body>
</html>