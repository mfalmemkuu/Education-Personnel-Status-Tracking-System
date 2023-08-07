<?php require_once '../database.php';


$query = $conn->prepare("SELECT p.MedicareCardNumber, p.FirstName, p.LastName, s.CurrentLevel, p.MedicareExpiryDate
, p.DateOfBirth, p.TelephoneNumber, p.Citizenship, p.PostalCode, p.EmailAddress
FROM students s, persons p
WHERE s.MedicareCardNumber = p.MedicareCardNumber AND s.MedicareCardNumber = :MedicareCardNumber;");
$query->bindParam(":MedicareCardNumber" , $_GET["MedicareCardNumber"]);
$query-> execute();

$person = $query->fetch(PDO::FETCH_ASSOC);


if (isset($_POST["MedicareCardNumber"]) && isset($_POST["FirstName"]) && isset($_POST["LastName"]) &&
    isset($_POST["MedicareExpiryDate"]) && isset($_POST["DateOfBirth"]) && isset($_POST["TelephoneNumber"]) &&
    isset($_POST["Citizenship"]) && isset($_POST["PostalCode"]) && isset($_POST["EmailAddress"]) && isset($_POST["CurrentLevel"])) {
    
    try{
        // First, add the person details to the Persons table
        $person = $conn->prepare("UPDATE Persons p
        SET p.FirstName = :FirstName, p.LastName = :LastName, 
            p.MedicareExpiryDate = :MedicareExpiryDate, p.DateOfBirth = :DateOfBirth,
            p.TelephoneNumber = :TelephoneNumber, p.Citizenship = :Citizenship, 
            p.PostalCode = :PostalCode, p.EmailAddress = :EmailAddress
        WHERE p.MedicareCardNumber = :MedicareCardNumber;");

        $person->bindParam(':MedicareCardNumber', $_POST["MedicareCardNumber"]);
        $person->bindParam(':FirstName', $_POST["FirstName"]);
        $person->bindParam(':LastName', $_POST["LastName"]);
        $person->bindParam(':MedicareExpiryDate', $_POST["MedicareExpiryDate"]);
        $person->bindParam(':DateOfBirth', $_POST["DateOfBirth"]);
        $person->bindParam(':TelephoneNumber', $_POST["TelephoneNumber"]);
        $person->bindParam(':Citizenship', $_POST["Citizenship"]);
        $person->bindParam(':Postalcode', $_POST["Postalcode"]);
        $person->bindParam(':EmailAddress', $_POST["EmailAddress"]);

        if ($person->execute()) {
            
            $student = $conn->prepare("UPDATE Students s
            SET S.CurrentLevel = :CurrentLevel
            WHERE S.MedicareCardNumber = :MedicareCardNumber;");

            $student->bindParam(':MedicareCardNumber', $_POST["MedicareCardNumber"]);
            $student->bindParam(':CurrentLevel', $_POST["CurrentLevel"]);

            if ($student->execute()) {
                header("Location: ../student/index.php"); // Redirect after successful 
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
<html>
<body>

    <h1>Edit Student</h1>
    <form action="./edit-view.php" method="post">
        <br>
        First Name: <input type="text" name="FirstName" id="FirstName" value="<?= $person["FirstName"]?>"><br>
        Last Name: <input type="text" name="LastName"  id="LastName" value="<?= $person["LastName"]?>"><br>
        Medicare Expiry Date: <input type="date" name="MedicareExpiryDate" id="MedicareExpiryDate" value="<?= $person["MedicareExpiryDate"]?>"><br>
        Date of Birth: <input type="date" name="DateOfBirth" id="DateOfBirth" value="<?= $person["DateOfBirth"]?>"><br>
        Telephone Number: <input type="text" name="TelephoneNumber" id="TelephoneNumber" value="<?= $person["TelephoneNumber"]?>"><br>
        Citizenship: <input type="text" name="Citizenship" id="Citizenship" value="<?= $person["Citizenship"]?>"><br>
        PostalCode: <input type="text" name="Postalcode" id="PostalCode" value="<?= $person["PostalCode"]?>"><br>
        E-mail: <input type="text" name="EmailAddress" id="EmailAddress" value="<?= $person["EmailAddress"]?>"><br>
        Current Grade Level: <input type="text" name="CurrentLevel" id="CurrentLevel" value="<?= $person["CurrentLevel"]?>"><br>
        <br>
        <input type="submit">
    </form><br>
    <a href="../student/index.php">Back to Students</a>

</body>
</html>

<?php

?>