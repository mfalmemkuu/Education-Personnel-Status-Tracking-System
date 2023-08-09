<?php
require_once '../database.php';
$statement = $conn->prepare('SELECT * 
                             FROM Ministries
                             WHERE MinistryID=:MinistryID;');
$statement->bindParam(":MinistryID", $_GET["MinistryID"]);
$statement->execute(); 
$ministry = $statement->fetch(PDO::FETCH_ASSOC);
if(isset($_POST["MinistryID"]) && isset($_POST["Name"]) ){
    try {
    $ministry = $conn->prepare("UPDATE Ministries m
                                SET m.Name=:Name
                                WHERE m.MinistryID =:MinistryID");
    $ministry->bindParam(':MinistryID',$_POST["MinistryID"]);
    $ministry->bindParam(':Name',$_POST["Name"]);
    if($ministry->execute()) {
        header("Location: ./index.php");
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
    <title>insert </title>
</head>
<body>
    <h1>Edit a Ministry</h1>
    <form action="./ministry-edit.php" method="post">
        <label for="Name">Ministry Name: </label>
        <input type="text" name="Name" id="Name" value="<?= $ministry["Name"]?>"> <br>
        <input type="hidden" name="MinistryID" id="MinistryID" value="<?= $ministry["MinistryID"]?>"> <br>
        <button type="submit">Submit</button>
    </form><br>
    <a href="../facility/index.php">Back to Facilities</a>
</body>
</html>