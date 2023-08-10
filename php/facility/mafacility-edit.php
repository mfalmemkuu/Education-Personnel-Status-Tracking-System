<?php
require_once '../database.php';
$statement = $conn->prepare("SELECT e.FacilityID, e.PresidentMedicareNumber, f.Name, 
                            CONCAT(p.FirstName, ' ', p.LastName) AS PresidentName,
                            f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber, wa.StartDate
                            FROM Facilities f
                            JOIN ManagementFacilities e ON e.FacilityID = f.FacilityID
                            JOIN Persons p ON e.PresidentMedicareNumber = p.MedicareCardNumber
                            JOIN Works_At wa ON f.FacilityID = wa.FacilityID
                            AND e.PresidentMedicareNumber = wa.MedicareCardNumber
                            WHERE e.FacilityID =:FacilityID;");
$statement->bindParam(":FacilityID", $_GET["FacilityID"]);
$statement->execute();
$statement = $statement->fetch(PDO::FETCH_ASSOC);
if (isset($_POST["FacilityID"]) && isset($_POST["Name"]) && isset($_POST["PresidentMedicareNumber"]) &&
    isset($_POST["WebAddress"]) && isset($_POST["Capacity"]) && isset($_POST["PostalCode"]) &&
    isset($_POST["PhoneNumber"])) {
        try {
    $facility = $conn->prepare("UPDATE Facilities f
                                SET f.Name=:Name, f.WebAddress =:WebAddress, f.Capacity = :Capacity,
                                f.PostalCode=:PostalCode, f.PhoneNumber =:PhoneNumber
                                WHERE f.FacilityID =:FacilityID;");
$facility->bindParam(':FacilityID',$_POST["FacilityID"]);
$facility->bindParam(':Name',$_POST["Name"]);
$facility->bindParam(':WebAddress',$_POST["WebAddress"]);
$facility->bindParam(':Capacity',$_POST["Capacity"]);
$facility->bindParam(':PostalCode',$_POST["PostalCode"]);
$facility->bindParam(':PhoneNumber',$_POST["PhoneNumber"]);

    if ($facility->execute()) {
        $mafacility = $conn->prepare("UPDATE ManagementFacilities e
                                               SET e.PresidentMedicareNumber =:PresidentMedicareNumber
                                               WHERE e.FacilityID = :FacilityID;");
        $mafacility->bindParam(':FacilityID', $_POST["FacilityID"]);
        $mafacility->bindParam(':PresidentMedicareNumber', $_POST["PresidentMedicareNumber"]);
        $works_at = $conn->prepare("UPDATE Works_at wa
                                    SET wa.MedicareCardNumber =:MedicareCardNumber,
                                    wa.StartDate = :StartDate
                                    WHERE wa.FacilityID = :FacilityID;");
        $works_at->bindParam(':MedicareCardNumber',$_POST["PresidentMedicareNumber"]);
        $works_at->bindParam(':FacilityID', $_POST["FacilityID"]);
        $works_at->bindParam(':StartDate', $_POST["StartDate"]);
        $works_at->execute();
        if ($mafacility->execute()) {
            header("Location: ../facility/index.php"); 
            exit; 
        } else {
            echo "Error editing management facility.";
        }
    } else {
        echo "Error editing facility.";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Edit Management Facility</h1>
    <form action="./mafacility-edit.php" method="post">
        <label for="Name">Name: </label>
        <input type="text" name="Name" id="Name" value="<?= $statement["Name"]?>"> <br>
        <label for="PresidentMedicareNumber">President Medicare Number: </label>
        <input type="text" name="PresidentMedicareNumber" id="PresidentMedicareNumber" value="<?= $statement["PresidentMedicareNumber"]?>"> <br>
        <label for="WebAddress">Web Address: </label>
        <input type="text" name="WebAddress" id="WebAddress" value="<?= $statement["WebAddress"]?>"> <br>
        <label for="Capacity">Capacity: </label>
        <input type="number" name="Capacity" id="Capacity" value="<?= $statement["Capacity"]?>"> <br>
        <label for="PostalCode">Postal Code: </label>
        <input type="text" name="PostalCode" id="PostalCode" value="<?= $statement["PostalCode"]?>"> <br>
        <label for="PhoneNumber">Phone Number: </label>
        <input type="text" name="PhoneNumber" id="PhoneNumber" value="<?= $statement["PhoneNumber"]?>"> <br>
        <label for="StartDate">Start Date: </label>
        <input type="date" name="StartDate" id="StartDate" value="<?= $statement["StartDate"]?>"> <br>
        <input type="hidden" name="FacilityID" id="FacilityID" value="<?= $statement["FacilityID"]?>"> <br><br>
        <button type="submit">Submit</button>
    </form><br>
    <a href="../facility/index.php">Back to Facilities</a>
</body>
</html>
