<?php
require_once '../database.php';

$statement = $conn->prepare("SELECT s.MedicareCardNumber, f.FacilityID, ra.StartDate, ra.EndDate 
FROM Facilities f, Registered_At ra, Students s 
WHERE s.MedicareCardNumber = :MedicareCardNumber 
AND s.MedicareCardNumber = ra.MedicareCardNumber 
AND ra.FacilityID = f.FacilityID ;");

$statement->bindParam(":MedicareCardNumber", $_GET["MedicareCardNumber"]);
$statement->execute();
$registeredat = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["MedicareCardNumber"]) && isset($_POST["FacilityID"]) && isset($_POST["StartDate"]) && isset($_POST["EndDate"])) {
    $registeredat = $conn->prepare("UPDATE Registered_At
    SET FacilityID = :FacilityID, StartDate = :StartDate, EndDate=:EndDate
    WHERE MedicareCardNumber = :MedicareCardNumber;");
    $registeredat->bindParam(':MedicareCardNumber', $_POST["MedicareCardNumber"]);
    $registeredat->bindParam(':FacilityID', $_POST["FacilityID"]);
    $registeredat->bindParam(':StartDate', $_POST["StartDate"]);
    $registeredat->bindParam(':EndDate', $_POST["EndDate"]);
    if ($registeredat->execute()) {
        header("Location: showstudentregistration.php"); 
            exit;
    } else {
        echo "Error registering student.";
    }
}

?>


<!DOCTYPE html>
<html>
<body>

    <h1>Edit Student Registration</h1>
    <form action="registration-u.php">
        <br>
        Facility ID: <input type="text" name="FacilityID" value="<?= $registeredat["FacilityID"]?>"><br>
        Start Date: <input type="date" name="StartDate" value="<?= $registeredat["StartDate"]?>"><br>
        End Date: <input type="date" name="EndDate" value="<?= $registeredat["EndDate"]?>"><br>
        <input type="hidden" name="MedicareCardNumber" id="MedicareCardNumber" value="<?= $registeredat["MedicareCardNumber"]?>"> <br><br>
        <input type="submit">
    </form><br>
    <a href="../registration/index.php">Back to Registrations</a>

</body>
</html>

<?php

?>