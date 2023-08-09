<?php
require_once '../database.php';
$statement = $conn->prepare("SELECT s.MedicareCardNumber, f.FacilityID, ra.StartDate, ra.EndDate 
                             FROM Facilities f, Registered_At ra, Students s 
                             WHERE s.MedicareCardNumber = :MedicareCardNumber AND s.MedicareCardNumber = ra.MedicareCardNumber 
                             AND ra.FacilityID = f.FacilityID ;");
$statement->bindParam(":MedicareCardNumber", $_GET["MedicareCardNumber"]);
$statement->execute();
$registeredat = $statement->fetch(PDO::FETCH_ASSOC);
if (isset($_POST["MedicareCardNumber"]) && isset($_POST["FacilityID"]) ) {
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit a student's registration</title>
</head>
<body>
    <h1>edit a student's registration</h1>
    <form action="./editstudentregistration.php" method="post"> 
        <label for="FacilityID">Facility ID</label><br>
        <input type="number" name="FacilityID" id="FacilityID" value="<?= $registeredat["FacilityID"]?>"> <br>
        <label for="StartDate">Start Date</label><br>
        <input type="date" name="StartDate" id="StartDate" value="<?= $registeredat["StartDate"]?>"> <br>
        <label for="EndDate">End Date</label><br>
        <input type="date" name="EndDate" id="EndDate" value="<?= $registeredat["EndDate"]?>"> <br>
        <input type="hidden" name="MedicareCardNumber" id="MedicareCardNumber" value="<?= $registeredat["MedicareCardNumber"]?>"> <br>
        <button type="submit">edit</button>
    </form>
    <a href="./showstudentregistration.php">back to alumni</a>
</body>
</html>