<?php
require_once '../database.php';

$sql_better = "SELECT s.medicareCardNumber, s.currentLevel, p.firstname, p.lastname, p.medicareexpirydate, p.dateofbirth, p.telephonenumber, p.citizenship, ap.address, ap.city, p.PostalCode, ap.province, p.emailaddress
    FROM students s, persons p, addresses_persons ap
    WHERE s.medicareCardNumber = p.medicareCardNumber
    AND p.PostalCode = ap.PostalCode;";

$sql = 'SELECT * FROM Persons;';

$stmt = $conn->prepare($sql);  
    

$stmt->execute();

?>

<table>
  <thead>
      <tr>
        <th>MedicareCardNumber</th>
        <th>CurrentGradeLevel</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>MedicareExpiryDate</th>
        <th>DateOfBirth</th>
        <th>TelephoneNumber</th>
        <th>Citizenship</th>
        <th>Address</th>
        <th>City</th>
        <th>PostalCode</th>
        <th>Province</th>
        <th>Email</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["MedicareCardNumber"] ?></td>
      <td><?= $row["CurrentLevel"] ?></td>
      <td><?= $row["Firstname"] ?></td>
      <td><?= $row["MedicareExpiryDate"] ?></td>
      <td><?= $row["DateOfBirth"] ?></td>
      <td><?= $row["TelephoneNumber"] ?></td>
      <td><?= $row["Citizenship"] ?></td>
      <td><?= $row["Address"] ?></td>
      <td><?= $row["City"] ?></td>
      <td><?= $row["PostalCode"] ?></td>
      <td><?= $row["Province"] ?></td>
      <td><?= $row["Email"] ?></td>
      <td>
        <a href="./student-u.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Edit</a>
        <a href="./student-d.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    <a href="../student/index.php">Back to Students</a>
