<?php require_once '../database.php';
if(isset($_POST["MedicareCardNumber"]) && isset($_POST["vaccineDate"]) && isset($_POST["vaccineType"]) &&
isset($_POST["doseNumber"])){
    $query = $conn->prepare("INSERT INTO Vaccinations(MedicareCardNumber, `Date`, `Type`, DoseNumber)
    VALUES(:MedicareCardNumber, :vaccineDate, :vaccineType ,:doseNumber);
    ");
    $query->bindParam(':MedicareCardNumber',$_POST["MedicareCardNumber"]);
    $query->bindParam(':vaccineDate',$_POST["vaccineDate"]);
    $query->bindParam(':vaccineType',$_POST["vaccineType"]);
    $query->bindParam(':doseNumber',$_POST["doseNumber"]);
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
    <h1>Add a Vaccination</h1>
    <form action="./create-view.php" method="post">
        <label for="MedicareCardNumber">Medicare Number: </label>
        <input type="text" name="MedicareCardNumber" id="MedicareCardNumber"> <br>
        <label for="vaccineDate">Vaccination Date: </label>
        <input type="date" name="vaccineDate" id="vaccineDate"> <br>
        <label for="vaccineType">Vaccination Type: </label>
        <input type="text" name="vaccineType" id="vaccineType"> <br>
        <label for="doseNumber">Dose Number: </label>
        <input type="text" name="doseNumber" id="doseNumber"> <br>        
        <br>
        <button type="submit">Submit</button>
    </form><br>
    <a href="../vaccination/index.php">Back to Vaccinations</a>
</body>
</html>