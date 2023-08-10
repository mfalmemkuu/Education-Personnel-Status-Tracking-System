<?php
require_once '../database.php';
if (isset($_POST["FacilityID"]) && isset($_POST["Name"]) && isset($_POST["PresidentMedicareNumber"]) &&
    isset($_POST["WebAddress"]) && isset($_POST["Capacity"]) && isset($_POST["PostalCode"]) &&
    isset($_POST["PhoneNumber"]) && isset($_POST["StartDate"]) ) {
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
            $managementfacility = $conn->prepare("INSERT INTO ManagementFacilities (FacilityID, PresidentMedicareNumber)
                                                VALUES(:FacilityID , :PresidentMedicareNumber);");

            $managementfacility->bindParam(':FacilityID', $_POST["FacilityID"]);
            $managementfacility->bindParam(':PresidentMedicareNumber', $_POST["PresidentMedicareNumber"]);

            if ($managementfacility->execute()) {
                $works_at = $conn->prepare("INSERT INTO Works_at(MedicareCardNumber, FacilityID, StartDate, Role)
                                        VALUES(:PresidentMedicareNumber, :FacilityID, :StartDate, 'President');");
                $works_at->bindParam(':PresidentMedicareNumber',$_POST["PresidentMedicareNumber"]);
                $works_at->bindParam(':FacilityID', $_POST["FacilityID"]);
                $works_at->bindParam(':StartDate', $_POST["StartDate"]);

                if($works_at->execute()) {
                    $headoffice = $conn->prepare("INSERT INTO HeadOfficeFacilities(FacilityID)
                                                    VALUES(:FacilityID);");
                    $headoffice->bindParam(':FacilityID', $_POST["FacilityID"]);
                    if ($headoffice->execute()) {
                        header("Location: ../facility/index.php"); 
                        exit; 
                    }
                    else{
                        echo "Error adding head office";
                    }
                }
                else{
                    echo "Error adding works at";
                }
            } else {
                echo "Error adding management facility.";
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
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <h1>Add a Head Office</h1>
    <form action="hofacility-create.php" method="post">
        <label for="Name">FacilityID: </label>
        <input type="number" name="FacilityID" id="FacilityID"> <br>
        <label for="Name">Name: </label>
        <input type="text" name="Name" id="Name"> <br>
        <label for="PresidentMedicareNumber">President Medicare Number: </label>
        <input type="text" name="PresidentMedicareNumber" id="PresidentMedicareNumber"> <br>
        <label for="WebAddress">Web Address: </label>
        <input type="text" name="WebAddress" id="WebAddress"> <br>
        <label for="Capacity">Capacity: </label>
        <input type="number" name="Capacity" id="Capacity"> <br>
        <label for="PostalCode">PostalCode: </label>
        <input type="text" name="PostalCode" id="PostalCode"> <br>
        <label for="PhoneNumber">Phone Number:</label>
        <input type="text" name="PhoneNumber" id="PhoneNumber"> <br>
        <label for="StartDate">President Start Date: </label>
        <input type="date" name="StartDate" id="StartDate"> <br><br>
        <input type="submit">
    </form><br>
    <a href="../facility/index.php">Back to Facilities</a>

</body>
</html>