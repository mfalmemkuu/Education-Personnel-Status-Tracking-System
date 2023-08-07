<?php require_once '../database.php';
if(isset($_POST["MedicareCardNumber"]) && isset($_POST["infectionDate"]) && isset($_POST["infectionType"])){
    $query = $conn->prepare("INSERT INTO Infections(MedicareCardNumber, `DATE`, `Type`)
    VALUES (:MedicareCardNumber, :infectionDate, :infectionType);
    ");
    $query->bindParam(':MedicareCardNumber',$_POST["MedicareCardNumber"]);
    $query->bindParam(':infectionDate',$_POST["infectionDate"]);
    $query->bindParam(':infectionType',$_POST["infectionType"]);
    if($query->execute())
    header("Location: .");
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
        <label for="MedicareCardNumber">Medicare number: </label>
        <input type="text" name="MedicareCardNumber" id="MedicareCardNumber"> <br>
        <label for="infectionDate">Infection Date: </label>
        <input type="date" name="infectionDate" id="infectionDate"> <br>
        <label for="infectionType">Infection Type: </label>
        <input type="text" name="infectionType" id="infectionType"> <br>
        <br>
        <button type="submit">Submit</button>
    </form><br>
    <a href="../infection/index.php">Back to Infections</a>
</body>
</html>