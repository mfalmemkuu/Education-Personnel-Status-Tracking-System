<?php require_once '../database.php';

$facility = $conn->prepare("SELECT e.FacilityID, f.Name, CONCAT(p.FirstName, ' ', p.LastName) AS Principal_name,
                            f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber
                            FROM facilities f
                            JOIN educationalfacilities e ON e.FacilityID = f.FacilityID
                            JOIN persons p ON e.PrincipalMedicareNumber = p.MedicareCardNumber
                            JOIN works_at wa ON f.FacilityID = wa.FacilityID
                                             AND e.PrincipalMedicareNumber = wa.MedicareCardNumber;");

$facility->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>educational facilities</title>
</head>
<body>
<h1>list of educational facilities</h1>
    <a href="./inserteducationalfacility.php">add an educational facility</a>
    <table>
        <thead>
            <tr>
                <td>FacilityID</td>
                <td>Name</td>
                <td>Principal_name</td>
                <td>WebAddress</td>
                <td>Capacity</td>
                <td>PostalCode</td>
                <td>PhoneNumber</td>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $facility->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["FacilityID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["Principal_name"] ?></td>
                <td><?= $row["WebAddress"] ?></td>
                <td><?= $row["Capacity"] ?></td>
                <td><?= $row["PostalCode"] ?></td>
                <td><?= $row["PhoneNumber"] ?></td>
                <td>
                    <a href="./displayeducationalfacility.php?FacilityID=<?=$row["FacilityID"] ?>">display</a>
                    <a href="./editeducationalfacility.php?FacilityID=<?=$row["FacilityID"] ?>">edit</a>
                    <a href="./deleteeducationalfacility.php?FacilityID=<?=$row["FacilityID"] ?>">delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>
</body>
</html>