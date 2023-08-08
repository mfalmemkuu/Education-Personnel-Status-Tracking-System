<?php
require_once '../database.php';
$statement = $conn->prepare('SELECT * 
                             FROM a1.Ministries
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
    if($ministry->execute())
    header("Location: showministry.php");
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
    <title>insert person</title>
</head>
<body>
    <h1>edit a ministry</h1>
    <form action="./editministry.php" method="post">
        <label for="Name">First name</label><br>
        <input type="text" name="Name" id="Name" value="<?= $ministry["Name"]?>"> <br>
        <input type="hidden" name="MinistryID" id="MinistryID" value="<?= $ministry["MinistryID"]?>"> <br>
        <button type="submit">edit</button>
    </form>
    <a href="./showfacility.php">back to facilities</a>
</body>
</html>