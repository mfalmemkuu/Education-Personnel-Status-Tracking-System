<?php require_once '../database.php';


$query = $conn->prepare("SELECT * FROM persons, students WHERE persons.MedicareCardNumber = students.MedicareCardNumber AND students.MedicareCardNumber = :MedicareCardNumber");
$query->bindParam(":MedicareCardNumber" , $_GET["MedicareCardNumber"]);
$query-> execute();
$query = $query->fetch(PDO::FETCH_ASSOC);


if (isset($_POST["MedicareCardNumber"]) && isset($_POST["FirstName"]) && isset($_POST["LastName"]) &&
    isset($_POST["MedicareExpiryDate"]) && isset($_POST["DateOfBirth"]) && isset($_POST["TelephoneNumber"]) &&
    isset($_POST["Citizenship"]) && isset($_POST["PostalCode"]) && isset($_POST["EmailAddress"]) && isset($_POST["CurrentLevel"])) {

    // First, add the person details to the Persons table
    $person = $conn->prepare("UPDATE Students s
    SET S.CurrentLevel = :currentLevel
    WHERE S.MedicareCardNumber = :MedicareCardNumber;");

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
        
        $student = $conn->prepare("INSERT INTO Students (MedicareCardNumber, CurrentLevel)
            VALUES(:MedicareCardNumber, CurrentLevel);");

        $student->bindParam(':MedicareCardNumber', $_POST["MedicareCardNumber"]);
        $student->bindParam(':CurrentLevel', $_POST["CurrentLevel"]);

        if ($student->execute()) {
            header("Location: ./index.php"); // Redirect after successful insertion
            exit; // Terminate the script after the redirection
        } else {
            echo "Error editing student.";
        }
    } else {
        echo "Error editing person.";
    }
}

?>

<!DOCTYPE html>
<html>
<body>

    <h1>Edit Student</h1>
    <form action="edit-view.php">
        FOR Medicare Number: <input type="text" value="<?php $_REQUEST['MedicareCardNumber']; ?>" name="MedicareCardNumber" disabled><br>
        <br>
        First Name: <input type="text" name="firstname"><br>
        Last Name: <input type="text" name="lastname"><br>
        Medicare Expiry Date: <input type="date" name="medicareExpiryDate"><br>
        Telephone Number: <input type="text" name="telephoneNumber"><br>
        Citizenship: <input type="text" name="citizenship"><br>
        PostalCode: <input type="text" name="postalCode"><br>
        E-mail: <input type="text" name="email"><br>
        Current Grade Level: <input type="text" name="CurrentLevel"><br>
        <br>
        <input type="submit">
    </form><br>
    <a href="../student/index.php">Back to Students</a>

</body>
</html>

<?php

?>