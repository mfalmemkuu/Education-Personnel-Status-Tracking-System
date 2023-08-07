<?php
require_once '../database.php';

$statement = $conn->prepare('SELECT p.MedicareCardNumber, p.FirstName, p.LastName, s.CurrentLevel, p.MedicareExpiryDate
, p.DateOfBirth, p.TelephoneNumber, p.Citizenship, p.PostalCode, p.EmailAddress
FROM students s, persons p
WHERE s.MedicareCardNumber = p.MedicareCardNumber AND s.MedicareCardNumber = :MedicareCardNumber;');
$statement->bindParam(":MedicareCardNumber", $_GET["MedicareCardNumber"]);
$statement->execute();
$person = $statement->fetch(PDO::FETCH_ASSOC);
if (isset($_POST["MedicareCardNumber"]) && isset($_POST["FirstName"]) && isset($_POST["LastName"]) &&
    isset($_POST["MedicareExpiryDate"]) && isset($_POST["DateOfBirth"]) && isset($_POST["TelephoneNumber"]) &&
    isset($_POST["Citizenship"]) && isset($_POST["PostalCode"]) && isset($_POST["EmailAddress"]) &&
    isset($_POST["CurrentLevel"])) {

    // First, add the person details to the Persons table
    try {
        $person = $conn->prepare("UPDATE Persons p
            SET p.FirstName = :FirstName, p.LastName = :LastName, 
                p.MedicareExpiryDate = :MedicareExpiryDate, p.DateOfBirth = :DateOfBirth,
                p.TelephoneNumber = :TelephoneNumber, p.Citizenship = :Citizenship, 
                p.PostalCode = :PostalCode, p.EmailAddress = :EmailAddress
            WHERE p.MedicareCardNumber = :MedicareCardNumber;
        ");
    
        $person->bindParam(':MedicareCardNumber', $_POST["MedicareCardNumber"]);
        $person->bindParam(':FirstName', $_POST["FirstName"]);
        $person->bindParam(':LastName', $_POST["LastName"]);
        $person->bindParam(':MedicareExpiryDate', $_POST["MedicareExpiryDate"]);
        $person->bindParam(':DateOfBirth', $_POST["DateOfBirth"]);
        $person->bindParam(':TelephoneNumber', $_POST["TelephoneNumber"]);
        $person->bindParam(':Citizenship', $_POST["Citizenship"]);
        $person->bindParam(':PostalCode', $_POST["PostalCode"]);
        $person->bindParam(':EmailAddress', $_POST["EmailAddress"]);
    
        if ($person->execute()) {
            // If the person is successfully updated, now update the student in the Students table
            $student = $conn->prepare("UPDATE Students s
                                       SET s.CurrentLevel = :CurrentLevel
                                       WHERE s.MedicareCardNumber = :MedicareCardNumber;
                                       ");
    
            $student->bindParam(':MedicareCardNumber', $_POST["MedicareCardNumber"]);
            $student->bindParam(':CurrentLevel', $_POST["CurrentLevel"]);
    
            if ($student->execute()) {
                header("Location: ./index.php"); // Redirect after successful update
                exit; // Terminate the script after the redirection
            } else {
                echo "Error updating student.";
            }
        } else {
            echo "Error updating person.";
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
    <title>edit a student</title>
</head>
<body>
    <h1>Edit a Student</h1>
    <form action="./edit-view.php" method="post">
        <label for="FirstName">First name: </label>
        <input type="text" name="FirstName" id="FirstName" value="<?= $person["FirstName"]?>"> <br>
        <label for="LastName">Last name: </label>
        <input type="text" name="LastName" id="LastName" value="<?= $person["LastName"]?>"> <br>
        <label for="CurrentLevel">Current Grade Level: </label>
        <input type="text" name="CurrentLevel" id="CurrentLevel" value="<?= $person["CurrentLevel"]?>"> <br>
        <label for="MedicareExpiryDate">Medicare Expiry Date: </label>
        <input type="date" name="MedicareExpiryDate" id="MedicareExpiryDate" value="<?= $person["MedicareExpiryDate"]?>"> <br>
        <label for="DateOfBirth">Date of Birth: </label>
        <input type="date" name="DateOfBirth" id="DateOfBirth" value="<?= $person["DateOfBirth"]?>"> <br>
        <label for="TelephoneNumber">Telephone Number: </label>
        <input type="text" name="TelephoneNumber" id="TelephoneNumber" value="<?= $person["TelephoneNumber"]?>"> <br>
        <label for="Citizenship">Citizenship: </label>
        <input type="text" name="Citizenship" id="Citizenship" value="<?= $person["Citizenship"]?>"> <br>
        <label for="PostalCode">Postal Code: </label>
        <input type="text" name="PostalCode" id="PostalCode" value="<?= $person["PostalCode"]?>"> <br>
        <label for="EmailAddress">Email: </label>
        <input type="text" name="EmailAddress" id="EmailAddress" value="<?= $person["EmailAddress"]?>"> <br>
        <input type="hidden" name="MedicareCardNumber" id="MedicareCardNumber" value="<?= $person["MedicareCardNumber"]?>"> <br>
        <button type="submit">Update</button>
    </form><br>
    <a href="./index.php">Back to Students</a>
</body>
</html>