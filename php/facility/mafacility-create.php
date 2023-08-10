<?php
require_once '../database.php';
if (isset($_POST["FacilityID"]) && isset($_POST["Name"]) && isset($_POST["PresidentMedicareNumber"]) &&
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
            $works_at = $conn->prepare("INSERT INTO Works_At(MedicareCardNumber, FacilityID, StartDate, Role)
            VALUES(:PresidentMedicareNumber, :FacilityID, NOW(), 'President');");
            $works_at->bindParam(':PresidentMedicareNumber',$_POST["PresidentMedicareNumber"]);
            $works_at->bindParam(':FacilityID', $_POST["FacilityID"]);
            if($works_at->execute()) {
                $mafacility = $conn->prepare("INSERT INTO ManagementFacilities (FacilityID, PresidentMedicareNumber)
                VALUES(:FacilityID , :PresidentMedicareNumber);");
                $mafacility->bindParam(':FacilityID', $_POST["FacilityID"]);
                $mafacility->bindParam(':PresidentMedicareNumber', $_POST["PresidentMedicareNumber"]);
                echo "" . $mafacility->fetch();

                if ($mafacility->execute() ) {
                    header("Location: ../facility/index.php"); // Redirect after successful insertion
                    exit; // Terminate the script after the redirection
                } else {
                    echo "Error adding management facility. Make sure the president is an existing person.";
                }    
            } else {
                echo "error creating works_at record";
            } 
            
        } else {
            echo "Error creating facility.";
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

    <h1>Add a Facility</h1>
    <form action="mafacility-create.php" method="post">
        <label for="FacilityID">FacilityID: </label>
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
        <input type="text" name="PhoneNumber" id="PhoneNumber"> <br><br>
        <input type="submit">
    </form><br>
    <a href="../facility/index.php">Back to Facilities</a>

</body>
</html>
