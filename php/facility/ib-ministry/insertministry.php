<?php require_once '../database.php';
if(isset($_POST["MinistryID"]) && isset($_POST["Name"]) ){
    try {
    $ministry = $conn->prepare("INSERT INTO a1.ministries(MinistryID, Name)
                                VALUES(:MinistryID , :Name);");
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
    <h1>Add a ministry</h1>
    <form action="./insertministry.php" method="post">
        <label for="MinistryID">ID</label><br>
        <input type="number" name="MinistryID" id="MinistryID"> <br>
        <label for="Name">Name</label><br>
        <input type="text" name="Name" id="Name"> <br>
        <button type="submit">add</button>
    </form>
    <a href="./showfacility.php">back to facilities</a>
</body>
</html>