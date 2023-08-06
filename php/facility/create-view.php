<!DOCTYPE html>
<html>
<body>

    <h1>Add a Facility</h1>
    <form action="facility-c.php">
        Name: <input type="text" name="fname"><br>        
        Capacity: <input type="text" name="capacity"><br>       
        Address: <input type="text" name="adress"><br>
        City: <input type="text" name="city"><br>
        PostalCode: <input type="text" name="postalCode"><br>
        Province: <input type="text" name="province"><br>
        Phone Number: <input type="text" name="phoneNumber"><br>
        Web Address: <input type="text" name="webaddress"><br>
        Facility Type: <select name="type">
                <option value="generalManagementFacilities">General Management Facility</option>
                <option value="headOfficeFacilities">Head Office Facility</option>
                <option value="primarySchools">Primary School</option>
                <option value="middleSchools">Middle School</option>
                <option value="highSchools">High School</option>
            </select>
        Ministry Name: <input type="text" name="ministryName"><br>    
        <br>
        <br>
        <input type="submit">
    </form><br>
    <a href="../facility/index.php">Back to Facilities</a>

</body>
</html>

<?php

?>