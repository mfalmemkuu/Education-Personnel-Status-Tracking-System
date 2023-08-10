<?php
require_once '../database.php';
$statement = $conn->prepare("SELECT e.FacilityID, f.Name, CONCAT(p.FirstName, ' ', p.LastName) AS PrincipalName, f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber
                             FROM Facilities f
                             JOIN EducationalFacilities e ON e.FacilityID = f.FacilityID
                             JOIN HighSchools hs ON hs.FacilityID = f.FacilityID  
                             JOIN Persons p ON e.PrincipalMedicareNumber = p.MedicareCardNumber
                             JOIN Works_At wa ON f.FacilityID = wa.FacilityID
                             AND e.PrincipalMedicareNumber = wa.MedicareCardNumber
                             WHERE hs.FacilityID=:FacilityID;");
$statement->bindParam(":FacilityID", $_GET["FacilityID"]);
$statement->execute(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Displaying One High School</h1> <br>
<table>
        <thead>
            <tr>
                <th>FacilityID</th>
                <th>Name</th>
                <th>PrincipalName</th>
                <th>WebAddress</th>
                <th>Capacity</th>
                <th>PostalCode</th>
                <th>PhoneNumber</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["FacilityID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["PrincipalName"] ?></td>
                <td><?= $row["WebAddress"] ?></td>
                <td><?= $row["Capacity"] ?></td>
                <td><?= $row["PostalCode"] ?></td>
                <td><?= $row["PhoneNumber"] ?></td>
                <td>
                    <a href="./hsfacility-edit.php?FacilityID=<?=$row["FacilityID"] ?>">Edit</a>&nbsp;
                    <a href="./hsfacility-d.php?FacilityID=<?=$row["FacilityID"] ?>">Delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table> <br>
    <a href="../facility/index.php">Back to Facilities</a>
    </body>
</html>