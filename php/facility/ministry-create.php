<?php require_once '../database.php';
if(isset($_POST["MinistryID"]) && isset($_POST["Name"]) ){
    try {
        $ministry = $conn->prepare("INSERT INTO Ministries(MinistryID, Name)
                                    VALUES(:MinistryID , :Name);");
        $ministry->bindParam(':MinistryID',$_POST["MinistryID"]);
        $ministry->bindParam(':Name',$_POST["Name"]);
        if($ministry->execute()) {
            header("Location: ./index.php");
        }
    } catch (PDOException $e) {
        die("Error adding ministry: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert</title>
</head>
<body>
    <h1>Add a Ministry</h1>
    <form action="./ministry-create.php" method="post">
        <label for="MinistryID">Ministry ID: </label>
        <input type="number" name="MinistryID" id="MinistryID"> <br>
        <label for="Name">Name: </label>
        <input type="text" name="Name" id="Name"> <br><br>
        <button type="submit">Submit</button>
    </form>
    <br>
    <a href="../facility/index.php">Back to Facilities</a>
</body>
</html>