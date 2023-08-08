<?php
require_once '../database.php';
$statement = $conn->prepare('SELECT * 
                             FROM Ministries
                             WHERE MinistryID=:MinistryID;');
$statement->bindParam(":MinistryID", $_GET["MinistryID"]);
$statement->execute(); 
$ministry = $statement->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $ministry["Name"]?></title>
</head>
<body>
    <h1><?= $ministry["Name"]?></h1>
    <a href="./showfacility.php">back to facilities</a>
</body>
</html>