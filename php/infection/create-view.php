<?php require_once '../database.php';


if(isset($_POST["MedicareCardNumber"]) && isset($_POST["Date"]) && isset($_POST["Type"])){
    $query = $conn->prepare("INSERT INTO Infections(MedicareCardNumber, `Date`, `Type`)
    VALUES (:MedicareCardNumber, :Date, :Type);
    ");
    $query->bindParam(':MedicareCardNumber',$_POST["MedicareCardNumber"]);
    $query->bindParam(':Date',$_POST["Date"]);
    $query->bindParam(':Type',$_POST["Type"]);
    if($query->execute()) {
        header("Location: ./index.php");
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h1>Add an Infection</h1>
    <form action="./create-view.php" method="post">
        <label for="MedicareCardNumber">Medicare number: </label> <input type="text" name="MedicareCardNumber" id="MedicareCardNumber"> <br>
        <label for="Date">Infection Date: </label> <input type="date" name="Date" id="Date"> <br>
        <label for="Type">Infection Type: </label> <input type="text" name="Type" id="Type"> <br>
        <br>
        <button type="submit">Submit</button>
    </form><br>
    <a href="../infection/index.php">Back to Infections</a>
</body>
</html>