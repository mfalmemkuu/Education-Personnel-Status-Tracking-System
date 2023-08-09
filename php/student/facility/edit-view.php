<!DOCTYPE html>
<html>
<body>

    <h1>Edit Facility</h1>
    <form action="facility-u.php">
        FOR facility id: <input type="text" value="<?php $_REQUEST['facilityID']; ?>" name="facilityID" disabled><br>
        Name: <input type="text" name="fname"><br>        
        Capacity: <input type="text" name="capacity"><br>    
        PostalCode: <input type="text" name="postalCode"><br>
        Phone Number: <input type="text" name="phoneNumber"><br>
        Web Address: <input type="text" name="webaddress"><br>
        <br>
        <input type="submit">
    </form><br>
    <a href="../facility/index.php">Back to Facilities</a>

</body>
</html>

<?php

?>