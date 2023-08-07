<!DOCTYPE html>
<html>
<body>

    <h1>Edit Infection</h1>
    <form action="infection-u.php">
        FOR Medicare Number: <input type="text" value="<?php $_REQUEST['medicareCardNumber']; ?>" name="medicareCardNumber" disabled><br>
        <br>
        Infection Date: <input type="date" name="infectionDate"><br>
        Infection Type: <input type="text" name="type"><br>
        <br>
        <input type="submit">
    </form><br>
    <a href="../infection/index.php">Back to Infections</a>

</body>
</html>

<?php

?>