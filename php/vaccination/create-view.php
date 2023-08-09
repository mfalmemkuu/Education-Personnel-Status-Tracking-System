<?php require_once '../database.php';

if(isset($_POST["MedicareCardNumber"]) && isset($_POST["Date"]) && isset($_POST["Type"]) && isset($_POST["DoseNumber"])){
    
    $query = $conn->prepare("INSERT INTO Vaccinations(MedicareCardNumber, `Date`, `Type`, DoseNumber)
    VALUES(:MedicareCardNumber, :Date, :Type ,:DoseNumber); ");
    $query->bindParam(':MedicareCardNumber',$_POST["MedicareCardNumber"]);
    $query->bindParam(':Date',$_POST["Date"]);
    $query->bindParam(':Type',$_POST["Type"]);
    $query->bindParam(':DoseNumber',$_POST["DoseNumber"]);
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
    <h1>Add a Vaccination</h1>
    <form action="./create-view.php" method="post">
        <label for="MedicareCardNumber">Medicare Number: </label>
        <input type="text" name="MedicareCardNumber" id="MedicareCardNumber"> <br>
        <label for="Date">Vaccination Date: </label>
        <input type="date" name="Date" id="Date"> <br>
        <label for="Type">Vaccination Type: </label>
        <input type="text" name="Type" id="Type"> <br>
        <label for="DoseNumber">Dose Number: </label>
        <input type="text" name="DoseNumber" id="DoseNumber"> <br>        
        <br>
        <button type="submit">Submit</button>
    </form><br>
    <a href="../vaccination/index.php">Back to Vaccinations</a>
</body>
</html>