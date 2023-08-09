<?php require_once '../database.php';

if (isset($_POST["MedicareCardNumber"]) && isset($_POST["FacilityID"]) && isset($_POST["StartDate"]) && isset($_POST["EndDate"])) {

    // First, add the person details to the Persons table
    $reg = $conn->prepare("INSERT INTO Registered_at (MedicareCardNumber, FacilityID, StartDate, EndDate)
    VALUES(:MedicareCardNumber, :FacilityID, :StartDate, :EndDate);");

    $reg->bindParam(':MedicareCardNumber', $_POST["MedicareCardNumber"]);
    $reg->bindParam(':FacilityID', $_POST["FacilityID"]);
    $reg->bindParam(':StartDate', $_POST["StartDate"]);
    $reg->bindParam(':EndDate', $_POST["EndDate"]);

    if($reg->execute()) {
        header("Location: ../registration/index.php"); 
    }
    else {
        echo "Error registering student.";
    }
}

?>

<!DOCTYPE html>
<html>
<body>

    <h1>Add a Student Registration</h1>
    <form action="create-view.php" method="post">
        Medicare Number: <input type="text" name="MedicareCardNumber"><br>
        FacilityID: <input type="text" name="FacilityID"><br>
        Start Date: <input type="date" name="StartDate"><br>
        End Date: <input type="date" name="EndDate"><br>
        <br>
        <input type="submit">
    </form><br>
    <a href="../registration/index.php">Back to Registrations</a>

</body>
</html>

<?php

?>