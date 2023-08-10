<?php
require_once '../database.php';
$statement = $conn->prepare("SELECT hof.FacilityID, f.Name, CONCAT(p.FirstName, ' ', p.LastName) AS PresidentName, f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber
                             FROM Facilities f, ManagementFacilities m, Persons p , HeadOfficeFacilities hof 
                             WHERE m.FacilityID = f.FacilityID AND m.PresidentMedicareNumber = p.MedicareCardNumber 
                             AND hof.FacilityID = f.FacilityID AND f.FacilityID = :FacilityID ;");
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
<h1>Displaying One Head Office</h1> <br>
<table>
        <thead>
            <tr>
                <th>FacilityID</th>
                <th>Name</th>
                <th>PresidentName</th>
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
                <td><?= $row["PresidentName"] ?></td>
                <td><?= $row["WebAddress"] ?></td>
                <td><?= $row["Capacity"] ?></td>
                <td><?= $row["PostalCode"] ?></td>
                <td><?= $row["PhoneNumber"] ?></td>
                <td>
                    <a href="./hofacility-edit.php?FacilityID=<?=$row["FacilityID"] ?>">Edit</a>&nbsp;
                    <a href="./hofacility-d.php?FacilityID=<?=$row["FacilityID"] ?>">Delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table><br>
    <a href="../facility/index.php">Back to Facilities</a>
    </body>
</html>