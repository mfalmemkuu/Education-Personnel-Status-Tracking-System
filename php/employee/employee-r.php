<?php
///include the current works at role & facility 
?>
<?php
require_once '../database.php';

$sql_better = "SELECT s.MedicareCardNumber, p.FirstName, p.LastName, p.MedicareExpiryDate, p.DateOfBirth, p.TelephoneNumber, p.Citizenship, ap.Address, ap.City, p.PostalCode, ap.Province, p.EmailAddress
    FROM Employees s, Persons p, Addresses_Persons ap
    WHERE s.MedicareCardNumber = p.MedicareCardNumber
    AND p.PostalCode = ap.PostalCode;";

$sql = "SELECT e.MedicareCardNumber, p.FirstName, p.LastName, p.MedicareExpiryDate, p.DateOfBirth, p.TelephoneNumber, p.Citizenship, p.PostalCode, p.EmailAddress, w.Role
FROM Employees e, Persons p, Works_At w
WHERE e.MedicareCardNumber = p.MedicareCardNumber AND e.MedicareCardNumber = w.MedicareCardNumber;";

$stmt = $conn->prepare($sql);  
    

$stmt->execute();

?>
<!-- search for student input - result makes us focus to the student in the list -->
<form action="./employee-r-one.php">
  Search Employee by MedicareCardNumber: <input type="text" name="MedicareCardNumber">
  <input type="submit">
</form>
<br>
<table>
  <thead>
      <tr>
        <th>MedicareCardNumber</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>MedicareExpiryDate</th>
        <th>DateOfBirth</th>
        <th>TelephoneNumber</th>
        <th>Citizenship</th>
        <th>PostalCode</th>
        <th>Email</th>
        <th>CurrentRole</th>
        <th>Actions</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["MedicareCardNumber"] ?></td>
      <td><?= $row["FirstName"] ?></td>
      <td><?= $row["LastName"] ?></td>
      <td><?= $row["MedicareExpiryDate"] ?></td>
      <td><?= $row["DateOfBirth"] ?></td>
      <td><?= $row["TelephoneNumber"] ?></td>
      <td><?= $row["Citizenship"] ?></td>
      <td><?= $row["PostalCode"] ?></td>
      <td><?= $row["EmailAddress"] ?></td>
      <td><?= $row["Role"] ?></td>
      <td>
        <a href="./edit-view.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Edit</a>&nbsp;
        <a href="./employee-d.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
