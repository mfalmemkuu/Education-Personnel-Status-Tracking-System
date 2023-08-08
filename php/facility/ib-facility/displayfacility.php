<?php
require_once '../database.php';
$statement = $conn->prepare('SELECT * 
                             FROM Facilities
                             WHERE FacilityID=:FacilityID;');
$statement->bindParam(":FacilityID", $_GET["FacilityID"]);
$statement->execute(); 
$facility = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $facility["Name"]?></title>
</head>
<body>
    <h1><?= $facility["Name"]?></h1>
    <p>web address: <?= $facility["WebAddress"]?></p>
    <p>capacity: <?= $facility["Capacity"]?></p>
    <p>postal code: <?= $facility["PostalCode"]?></p>
    <p>phone line: <?= $facility["PhoneNumber"]?></p>
    <a href="./showfacility.php">back to facilities</a>
</body>
</html>