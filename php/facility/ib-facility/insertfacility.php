<?php require_once '../database.php';
if(isset($_POST["FacilityID"]) && isset($_POST["Name"]) && isset($_POST["WebAddress"])
&& isset($_POST["Capacity"]) && isset($_POST["PostalCode"]) && isset($_POST["PhoneNumber"]) ){
    try {
    $facility = $conn->prepare("INSERT INTO Facilities(FacilityID, Name, WebAddress, Capacity, PostalCode, PhoneNumber)
                                VALUES(:FacilityID, :Name, :WebAddress, :Capacity, :PostalCode, :PhoneNumber);");
    $facility->bindParam(':FacilityID',$_POST["FacilityID"]);
    $facility->bindParam(':Name',$_POST["Name"]);
    $facility->bindParam(':WebAddress',$_POST["WebAddress"]);
    $facility->bindParam(':Capacity',$_POST["Capacity"]);
    $facility->bindParam(':PostalCode',$_POST["PostalCode"]);
    $facility->bindParam(':PhoneNumber',$_POST["PhoneNumber"]);
    if($facility->execute())
    header("Location: showfacility.php");
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
    <title>insert facility</title>
</head>
<body>
    <h1>Add a facility</h1>
    <form action="./insertfacility.php" method="post">
        <label for="FacilityID">ID</label><br>
        <input type="number" name="FacilityID" id="FacilityID"> <br>
        <label for="Name">Name</label><br>
        <input type="text" name="Name" id="Name"> <br>
        <label for="WebAddress">WebAddress</label><br>
        <input type="text" name="WebAddress" id="WebAddress"> <br>
        <label for="Capacity">Capacity</label><br>
        <input type="number" name="Capacity" id="Capacity"> <br>
        <label for="PostalCode">PostalCode</label><br>
        <input type="text" name="PostalCode" id="PostalCode"> <br>
        <label for="PhoneNumber">PhoneNumber</label><br>
        <input type="text" name="PhoneNumber" id="PhoneNumber"> <br>
        <button type="submit">add</button>
    </form>
    <a href="./showfacility.php">back to facilities</a>
</body>
</html>