<?php require_once '../database.php';

if (isset($_POST["MedicareCardNumber"]) && isset($_POST["FirstName"]) && isset($_POST["LastName"]) &&
    isset($_POST["MedicareExpiryDate"]) && isset($_POST["DateOfBirth"]) && isset($_POST["TelephoneNumber"]) &&
    isset($_POST["Citizenship"]) && isset($_POST["PostalCode"]) && isset($_POST["EmailAddress"]) && isset($_POST["FacilityID"]) && isset($_POST["StartDate"]) && isset($_POST["Role"])) {

    // First, add the person details to the Persons table
    $person = $conn->prepare("INSERT INTO Persons (MedicareCardNumber, FirstName, LastName, MedicareExpiryDate, DateOfBirth, TelephoneNumber, Citizenship, PostalCode, EmailAddress)
        VALUES(:MedicareCardNumber, :FirstName, :LastName, :MedicareExpiryDate, :DateOfBirth, :TelephoneNumber, :Citizenship, :PostalCode, :EmailAddress);");

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
        
        $employee = $conn->prepare("INSERT INTO Employees (MedicareCardNumber)
            VALUES(:MedicareCardNumber);");

        $employee->bindParam(':MedicareCardNumber', $_POST["MedicareCardNumber"]);

        if ($employee->execute()) { 
            $works_at = $conn->prepare("INSERT INTO Works_At(MedicareCardNumber, FacilityID, StartDate, Role)
                                    VALUES(:MedicareCardNumber, :FacilityID, :StartDate, :Role);");
            $works_at->bindParam(':MedicareCardNumber',$_POST["MedicareCardNumber"]);
            $works_at->bindParam(':FacilityID', $_POST["FacilityID"]);
            $works_at->bindParam(':StartDate', $_POST["StartDate"]);
            $works_at->bindParam(':Role', $_POST["Role"]);
            if($works_at->execute()){
                header("Location: ./index.php"); 
                exit;   
            }
            else{
                echo "error adding works at";
            }
        } else {
            echo "Error adding employee.";
        }
    } else {
        echo "Error adding person.";
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
    <h1>Add an Employee</h1>
    <form action="./create-view.php" method="post">
        <label for="MedicareCardNumber">Medicare card: </label>
        <input type="text" name="MedicareCardNumber" id="MedicareCardNumber"> <br>
        <label for="FirstName">First Name: </label>
        <input type="text" name="FirstName" id="FirstName"> <br>
        <label for="LastName">Last Name: </label>
        <input type="text" name="LastName" id="LastName"> <br>
        <label for="FacilityID">FacilityID: </label>
        <input type="number" name="FacilityID" id="FacilityID"> <br>
        <label for="Role">Role: </label>
        <input type="text" name="Role" id="Role"> <br>
        <label for="StartDate">Start Date: </label>
        <input type="date" name="StartDate" id="StartDate"> <br>
        <label for="MedicareExpiryDate">Medicare expiry date: </label>
        <input type="date" name="MedicareExpiryDate" id="MedicareExpiryDate"> <br>
        <label for="DateOfBirth">Date of Birth: </label>
        <input type="date" name="DateOfBirth" id="DateOfBirth"> <br>
        <label for="TelephoneNumber">Telephone Number: </label>
        <input type="text" name="TelephoneNumber" id="TelephoneNumber"> <br>
        <label for="Citizenship">Citizenship: </label>
        <input type="text" name="Citizenship" id="Citizenship"> <br>
        <label for="PostalCode">Postal Code: </label>
        <input type="text" name="PostalCode" id="PostalCode"> <br>
        <label for="EmailAddress">Email: </label>
        <input type="text" name="EmailAddress" id="EmailAddress"> <br>
        <br>
        <button type="submit">Submit</button>
    </form><br>
    <a href="../employee/index.php">Back to Employees</a>
</body>
</html>