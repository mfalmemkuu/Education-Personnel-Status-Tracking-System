<!DOCTYPE html>
<html>
<body>

    <h1>Edit a Student</h1>
    <form action="student-u.php">
        FOR Medicare Number: <input type="text" value="<?php $_REQUEST['medicareCardNumber']; ?>" name="medicareCardNumber" disabled><br>
        <br>
        First Name: <input type="text" name="firstname"><br>
        Last Name: <input type="text" name="lastname"><br>
        Medicare Expiry Date: <input type="date" name="medicareExpiryDate"><br>
        Telephone Number: <input type="text" name="telephoneNumber"><br>
        Citizenship: <input type="text" name="citizenship"><br>
        Address: <input type="text" name="adress"><br>
        City: <input type="text" name="city"><br>
        PostalCode: <input type="text" name="postalCode"><br>
        Province: <input type="text" name="province"><br>
        E-mail: <input type="text" name="email"><br>
        Grade Level: <input type="text" name="currentLevel"><br>
        <br>
        <input type="submit">
    </form><br>
    <a href="../student/index.php">Back to Students</a>

</body>
</html>

<?php

?>