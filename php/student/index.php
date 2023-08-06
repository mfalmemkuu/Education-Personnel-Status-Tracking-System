<!DOCTYPE html>
<html>
<body>
    <h1>List of Students</h1>
    <a href="student-c.php">Create a student</a>
    <table>
        <thead>
            <tr>
                <td>Medicare Card Number</td>
            </tr>
        </thead>
        
    </table>    
    <a href="../">Back to Homepage</a>

    

    <h1>Add a Student</h1>
    <form action="student-c.php">
        Medicare Number: <input type="text" name="medicareCardNumber"><br>
        FirstName: <input type="text" name="firstname"><br>
        LastName: <input type="text" name="lastname"><br>
        MedicareExpiryDate <input type="date" name="medicareExpiryDate"><br>
        PostalCode: <input type="text" name="postalCode"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <a href="../">Back to Students</a>

</body>
</html>

<?php

?>