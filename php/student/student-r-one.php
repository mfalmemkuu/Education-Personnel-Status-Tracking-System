<?php
require_once '../database.php';

//$sql_better = "SELECT s.MedicareCardNumber, s.CurrentLevel, p.FirstName, p.LastName, p.MedicareExpiryDate, p.DateOfBirth, p.TelephoneNumber, p.Citizenship, ap.Address, ap.City, p.PostalCode, ap.Province, p.EmailAddress     FROM students s, persons p, addresses_persons ap     WHERE s.medicareCardNumber = p.medicareCardNumber     AND p.PostalCode = ap.PostalCode;";

$sql = 'SELECT p.MedicareCardNumber, p.FirstName, p.LastName, s.CurrentLevel, p.MedicareExpiryDate
, p.DateOfBirth, p.TelephoneNumber, p.Citizenship, p.PostalCode, p.EmailAddress
FROM students s, persons p
WHERE s.MedicareCardNumber = p.MedicareCardNumber AND s.MedicareCardNumber = :MedicareCardNumber;';

$stmt = $conn->prepare($sql);  
$stmt->bindParam(":MedicareCardNumber", $_GET["MedicareCardNumber"]);
    
$stmt->execute();
?>

<h1>Displaying One Student</h1>

<br>
<table>
  <thead>
      <tr>
        <th>MedicareCardNumber</th>        
        <th>Firstname</th>
        <th>Lastname</th>
        <th>CurrentGradeLevel</th>
        <th>MedicareExpiryDate</th>
        <th>DateOfBirth</th>
        <th>TelephoneNumber</th>
        <th>Citizenship</th>
        <th>PostalCode</th>
        <th>Email</th>
        <th>Actions</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["MedicareCardNumber"] ?></td>      
      <td><?= $row["FirstName"] ?></td>
      <td><?= $row["LastName"] ?></td>
      <td><?= $row["CurrentLevel"] ?></td>
      <td><?= $row["MedicareExpiryDate"] ?></td>
      <td><?= $row["DateOfBirth"] ?></td>
      <td><?= $row["TelephoneNumber"] ?></td>
      <td><?= $row["Citizenship"] ?></td>
      <td><?= $row["PostalCode"] ?></td>
      <td><?= $row["EmailAddress"] ?></td>
      <td>
        <a href="./edit-view.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Edit</a>&nbsp;
        <a href="./student-d.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    <a href="./index.php">Back to Students List</a>
    
