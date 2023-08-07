<!DOCTYPE html>
<html>
<body>

    <h1>Edit Employee</h1>
    <form action="employee-u.php">
        FOR Medicare Number: <input type="text" value="<?php $_REQUEST['medicareCardNumber']; ?>" name="medicareCardNumber" disabled><br>
        <br>
        First Name: <input type="text" name="firstname"><br>
        Last Name: <input type="text" name="lastname"><br>
        Medicare Expiry Date: <input type="date" name="medicareExpiryDate"><br>
        Telephone Number: <input type="text" name="telephoneNumber"><br>
        Citizenship: <input type="text" name="citizenship"><br>
        PostalCode: <input type="text" name="postalCode"><br>
        E-mail: <input type="text" name="email"><br>
        Grade Level: <input type="text" name="currentLevel"><br>
        <br>
        <input type="submit">
    </form><br>
    <a href="../employee/index.php">Back to Employees</a>

</body>
</html>

<?php

?>