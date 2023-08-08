<?php require_once '../database.php';
$ministry = $conn->prepare('SELECT * FROM a1.Ministries;');
$ministry->execute();
$statement = $conn->prepare('SELECT * FROM Facilities;');
$statement->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>display facilities</title>
</head>
<body>
<h1>list of ministries</h1>
    <a href="./insertministry.php">add a ministry</a>
    <table>
        <thead>
            <tr>
                <td>MinistryID</td>
                <td>Name</td>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $ministry->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["MinistryID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td>
                    <a href="./displayministry.php?MinistryID=<?=$row["MinistryID"] ?>">display</a>
                    <a href="./editministry.php?MinistryID=<?=$row["MinistryID"] ?>">edit</a>
                    <a href="./deleteministry.php?MinistryID=<?=$row["MinistryID"] ?>">delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>
    <br>
    <h1>list of facilities</h1>
    <a href="./insertfacility.php">add a facility</a>
    <table>
        <thead>
            <tr>
                <td>FacilityID</td>
                <td>Name</td>
                <td>WebAddress</td>
                <td>Capacity</td>
                <td>PostalCode</td>
                <td>PhoneNumber</td>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["FacilityID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["WebAddress"] ?></td>
                <td><?= $row["Capacity"] ?></td>
                <td><?= $row["PostalCode"] ?></td>
                <td><?= $row["PhoneNumber"] ?></td>
                <td>
                    <a href="./displayfacility.php?FacilityID=<?=$row["FacilityID"] ?>">display</a>
                    <a href="./editfacility.php?FacilityID=<?=$row["FacilityID"] ?>">edit</a>
                    <a href="./deletefacility.php?FacilityID=<?=$row["FacilityID"] ?>">delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>
</body>
</html>