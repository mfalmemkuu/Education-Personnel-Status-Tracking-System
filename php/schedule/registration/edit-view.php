<!DOCTYPE html>
<html>
<body>

    <h1>Edit Student Registration</h1>
    <form action="registration-u.php">
        FOR Medicare Number: <input type="text" value="<?php $_REQUEST['medicareCardNumber']; ?>" name="medicareCardNumber" disabled><br>
        <br>
        Facility ID: <input type="text" name="facilityID"><br>
        Start Date: <input type="date" name="startDate"><br>
        End Date: <input type="date" name="endDate"><br>
        <br>
        <input type="submit">
    </form><br>
    <a href="../registration/index.php">Back to Registrations</a>

</body>
</html>

<?php

?>