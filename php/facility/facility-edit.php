<?php
require_once '../database.php';
$statement = $conn->prepare('SELECT * 
                             FROM Facilities
                             WHERE FacilityID=:FacilityID;');
$statement->bindParam(":FacilityID", $_GET["FacilityID"]);
$statement->execute(); 
$facility = $statement->fetch(PDO::FETCH_ASSOC);
if(isset($_POST["FacilityID"]) && isset($_POST["Name"]) && isset($_POST["WebAddress"])
&& isset($_POST["Capacity"]) && isset($_POST["PostalCode"]) && isset($_POST["PhoneNumber"]) ){
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
        if($facility->execute()) {
            header("Location: ./index.php");
        }    
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html>
<body>

    <h1>Edit Facility</h1>
    <form action="facility-edit.php" method="post">        
        <label for="Name">Name: </label>
        <input type="text" name="Name" id="Name" value="<?= $facility["Name"]?>"> <br>
        <label for="WebAddress">Web Address: </label>
        <input type="text" name="WebAddress" id="WebAddress" value="<?= $facility["WebAddress"]?>"> <br>
        <label for="Capacity">Capacity: </label>
        <input type="number" name="Capacity" id="Capacity" value="<?= $facility["Capacity"]?>"> <br>
        <label for="PostalCode">PostalCode: </label>
        <input type="text" name="PostalCode" id="PostalCode" value="<?= $facility["PostalCode"]?>"> <br>
        <label for="PhoneNumber">Phone Number: </label>
        <input type="text" name="PhoneNumber" id="PhoneNumber" value="<?= $facility["PhoneNumber"]?>"> <br>
        <input type="hidden" name="FacilityID" id="FacilityID" value="<?= $facility["FacilityID"]?>"> <br>
        <input type="submit">
    </form><br>
    <a href="../facility/index.php">Back to Facilities</a>

</body>
</html>

<?php

?>