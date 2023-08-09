<?php require_once '../database.php';

$registeredat = $conn->prepare("SELECT s.MedicareCardNumber,CONCAT(p.FirstName, ' ', p.LastName) AS Student_name, 
                                       f.Name, ra.StartDate, ra.EndDate
                                FROM Persons p, Facilities f, Registered_At ra, Students s 
                                WHERE p.MedicareCardNumber = s.MedicareCardNumber AND s.MedicareCardNumber = ra.MedicareCardNumber 
                                AND ra.FacilityID = f.FacilityID ;");

$registeredat->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>primary schools</title>
</head>
<body>
<h1>list of students and facilities</h1>
<a href="./insertstudentregistration.php">add a new student</a>
    <table>
        <thead>
            <tr>
                <td>Student</td>
                <td>Educational facility</td>
                <td>Start date</td>
                <td>End Date</td>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $registeredat->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["Student_name"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["StartDate"] ?></td>
                <td><?= $row["EndDate"] ?></td>
                <td>
                    <a href="./editstudentregistration.php?MedicareCardNumber=<?=$row["MedicareCardNumber"] ?>">edit</a>
                    <a href="./deletestudentregistration.php?MedicareCardNumber=<?=$row["MedicareCardNumber"] ?>">delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>
</body>
</html>