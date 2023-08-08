<?php
require_once '../database.php';
$statement = $conn->prepare("SELECT e.FacilityID, e.PrincipalMedicareNumber, f.Name, 
                            CONCAT(p.FirstName, ' ', p.LastName) AS Principal_name,
                            f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber, wa.StartDate
                            FROM facilities f
                            JOIN educationalfacilities e ON e.FacilityID = f.FacilityID
                            JOIN persons p ON e.PrincipalMedicareNumber = p.MedicareCardNumber
                            JOIN works_at wa ON f.FacilityID = wa.FacilityID
                            AND e.PrincipalMedicareNumber = wa.MedicareCardNumber
                            WHERE e.FacilityID =:FacilityID;");
$statement->bindParam(":FacilityID", $_GET["FacilityID"]);
$statement->execute();
$statement = $statement->fetch(PDO::FETCH_ASSOC);
if (isset($_POST["FacilityID"]) && isset($_POST["Name"]) && isset($_POST["PrincipalMedicareNumber"]) &&
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
        $educationalfacility = $conn->prepare("UPDATE EducationalFacilities e
                                               SET e.PrincipalMedicareNumber =:PrincipalMedicareNumber
                                               WHERE e.FacilityID = :FacilityID;");
        $educationalfacility->bindParam(':FacilityID', $_POST["FacilityID"]);
        $educationalfacility->bindParam(':PrincipalMedicareNumber', $_POST["PrincipalMedicareNumber"]);
        $works_at = $conn->prepare("UPDATE Works_at wa
                                    SET wa.MedicareCardNumber =:MedicareCardNumber,
                                    wa.StartDate = :StartDate
                                    WHERE wa.FacilityID = :FacilityID;");
        $works_at->bindParam(':MedicareCardNumber',$_POST["PrincipalMedicareNumber"]);
        $works_at->bindParam(':FacilityID', $_POST["FacilityID"]);
        $works_at->bindParam(':StartDate', $_POST["StartDate"]);
        $works_at->execute();
        if ($educationalfacility->execute()) {
            header("Location: showeducationalfacility.php"); 
            exit; 
        } else {
            echo "Error adding educational facility.";
        }
    } else {
        echo "Error adding facility.";
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
    <title>edit an educational facility</title>
</head>
<body>
    <h1>edit an educational facility</h1>
    <form action="./editeducationalfacility.php" method="post">
        <label for="Name">Name</label><br>
        <input type="text" name="Name" id="Name" value="<?= $statement["Name"]?>"> <br>
        <label for="PrincipalMedicareNumber">Principal Medicare Number</label><br>
        <input type="text" name="PrincipalMedicareNumber" id="PrincipalMedicareNumber" value="<?= $statement["PrincipalMedicareNumber"]?>"> <br>
        <label for="WebAddress">WebAddress</label><br>
        <input type="text" name="WebAddress" id="WebAddress" value="<?= $statement["WebAddress"]?>"> <br>
        <label for="Capacity">Capacity</label><br>
        <input type="number" name="Capacity" id="Capacity" value="<?= $statement["Capacity"]?>"> <br>
        <label for="PostalCode">Postal Code</label><br>
        <input type="text" name="PostalCode" id="PostalCode" value="<?= $statement["PostalCode"]?>"> <br>
        <label for="PhoneNumber">telephone number</label><br>
        <input type="text" name="PhoneNumber" id="PhoneNumber" value="<?= $statement["PhoneNumber"]?>"> <br>
        <label for="StartDate">Start Date</label><br>
        <input type="date" name="StartDate" id="StartDate" value="<?= $statement["StartDate"]?>"> <br>
        <input type="hidden" name="FacilityID" id="FacilityID" value="<?= $statement["FacilityID"]?>"> <br>
        <button type="submit">edit</button>
    </form>
    <a href="./showeducationalfacility.php">back to educational facilities</a>
</body>
</html>