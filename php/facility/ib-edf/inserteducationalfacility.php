<?php
require_once '../database.php';
if (isset($_POST["FacilityID"]) && isset($_POST["Name"]) && isset($_POST["PrincipalMedicareNumber"]) &&
    isset($_POST["WebAddress"]) && isset($_POST["Capacity"]) && isset($_POST["PostalCode"]) &&
    isset($_POST["PhoneNumber"])) {
        try {
    $facility = $conn->prepare("INSERT INTO Facilities(FacilityID, Name, WebAddress, Capacity, PostalCode, PhoneNumber)
                                VALUES(:FacilityID, :Name, :WebAddress, :Capacity, :PostalCode, :PhoneNumber);");
$facility->bindParam(':FacilityID',$_POST["FacilityID"]);
$facility->bindParam(':Name',$_POST["Name"]);
$facility->bindParam(':WebAddress',$_POST["WebAddress"]);
$facility->bindParam(':Capacity',$_POST["Capacity"]);
$facility->bindParam(':PostalCode',$_POST["PostalCode"]);
$facility->bindParam(':PhoneNumber',$_POST["PhoneNumber"]);

    if ($facility->execute()) {
        $educationalfacility = $conn->prepare("INSERT INTO EducationalFacilities (FacilityID, PrincipalMedicareNumber)
                                               VALUES(:FacilityID , :PrincipalMedicareNumber);");

        $educationalfacility->bindParam(':FacilityID', $_POST["FacilityID"]);
        $educationalfacility->bindParam(':PrincipalMedicareNumber', $_POST["PrincipalMedicareNumber"]);
        $works_at = $conn->prepare("INSERT INTO Works_at(MedicareCardNumber, FacilityID, StartDate, Role)
                                    VALUES(:PrincipalMedicareNumber, :FacilityID, :StartDate, 'Principal');");
        $works_at->bindParam(':PrincipalMedicareNumber',$_POST["PrincipalMedicareNumber"]);
        $works_at->bindParam(':FacilityID', $_POST["FacilityID"]);
        $works_at->bindParam(':StartDate', $_POST["StartDate"]);
        $works_at->execute();
        if ($educationalfacility->execute()) {
            header("Location: showeducationalfacility.php"); // Redirect to showstudents.php after successful insertion
            exit; // Terminate the script after the redirection
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
    <title>insert educational facility</title>
</head>
<body>
    <h1>Add an educational facility</h1>
    <form action="./inserteducationalfacility.php" method="post">
        <label for="FacilityID">FacilityID</label><br>
        <input type="number" name="FacilityID" id="FacilityID"> <br>
        <label for="Name">Name</label><br>
        <input type="text" name="Name" id="Name"> <br>
        <label for="PrincipalMedicareNumber">Principal Medicare Number</label><br>
        <input type="text" name="PrincipalMedicareNumber" id="PrincipalMedicareNumber"> <br>
        <label for="WebAddress">WebAddress</label><br>
        <input type="text" name="WebAddress" id="WebAddress"> <br>
        <label for="Capacity">Capacity</label><br>
        <input type="number" name="Capacity" id="Capacity"> <br>
        <label for="PostalCode">Postal Code</label><br>
        <input type="text" name="PostalCode" id="PostalCode"> <br>
        <label for="PhoneNumber">telephone number</label><br>
        <input type="text" name="PhoneNumber" id="PhoneNumber"> <br>
        <label for="StartDate">Start Date</label><br>
        <input type="date" name="StartDate" id="StartDate"> <br>
        <button type="submit">add</button>
    </form>
    <a href="./showeducationalfacility.php">back to educational facilities</a>
</body>
</html>