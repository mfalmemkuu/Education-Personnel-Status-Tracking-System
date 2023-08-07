<!DOCTYPE html>
<html>
<body>

    <h1>Edit Vaccination</h1>
    <form action="vaccination-u.php">
        FOR Medicare Number: <input type="text" value="<?php $_REQUEST['medicareCardNumber']; ?>" name="medicareCardNumber" disabled><br>
        <br>
        Vaccination Date: <input type="date" name="vaccineDate"><br>
        Vaccination Type: <input type="text" name="vaccineType"><br>
        Dose Number: <input type="text" name="doseNumber"><br>
        <br>
        <input type="submit">
    </form><br>
    <a href="../vaccination/index.php">Back to Vaccinations</a>

</body>
</html>

<?php

?>