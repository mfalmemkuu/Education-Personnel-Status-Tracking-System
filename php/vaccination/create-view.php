<?php require_once '../database.php';

if(isset($_POST["MedicareCardNumber"]) && isset($_POST["VaccinationDate"]) && isset($_POST["VaccinationType"]) && isset($_POST["DoseNumber"])){
    
    $query = $conn->prepare("INSERT INTO Vaccinations(MedicareCardNumber, `Date`, `Type`, DoseNumber)
    VALUES(:MedicareCardNumber, :VaccinationDate, :VaccinationType ,:DoseNumber); ");
    $query->bindParam(':MedicareCardNumber',$_POST["MedicareCardNumber"]);
    $query->bindParam(':VaccinationDate',$_POST["VaccinationDate"]);
    $query->bindParam(':VaccinationType',$_POST["VaccinationType"]);
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
        <label for="VaccinationDate">Vaccination Date: </label>
        <input type="date" name="VaccinationDate" id="VaccinationDate"> <br>
        <label for="VaccinationType">Vaccination Type: </label>
        <input type="text" name="VaccinationType" id="VaccinationType"> <br>
        <label for="DoseNumber">Dose Number: </label>
        <input type="text" name="DoseNumber" id="DoseNumber"> <br>        
        <br>
        <button type="submit">Submit</button>
    </form><br>
    <a href="../vaccination/index.php">Back to Vaccinations</a>
</body>
</html>