<?php
///include the current works at role & facility 
?>
<?php
require_once '../database.php';

$sql_better = "SELECT s.MedicareCardNumber, p.FirstName, p.LastName, p.MedicareExpiryDate, p.DateOfBirth, p.TelephoneNumber, p.Citizenship, ap.Address, ap.City, p.PostalCode, ap.Province, p.EmailAddress
    FROM employees s, persons p, addresses_persons ap
    WHERE s.MedicareCardNumber = p.MedicareCardNumber
    AND p.PostalCode = ap.PostalCode;";

$sql_decent = "SELECT e.MedicareCardNumber, p.FirstName, p.LastName, p.MedicareExpiryDate, p.DateOfBirth, p.TelephoneNumber, p.Citizenship, p.PostalCode, p.EmailAddress
FROM employees e, persons p
WHERE e.MedicareCardNumber = p.MedicareCardNumber;";

$sql = 'SELECT * FROM employees;'; //or persons

$stmt = $conn->prepare($sql_decent);  
    

$stmt->execute();

?>

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
      <td><?= $row["FirstName"] ?></td>
      <td><?= $row["LastName"] ?></td>
      <td><?= $row["MedicareExpiryDate"] ?></td>
      <td><?= $row["DateOfBirth"] ?></td>
      <td><?= $row["TelephoneNumber"] ?></td>
      <td><?= $row["Citizenship"] ?></td>
      <td><?= $row["Address"] ?></td>
      <td><?= $row["City"] ?></td>
      <td><?= $row["PostalCode"] ?></td>
      <td><?= $row["Province"] ?></td>
      <td><?= $row["EmailAddress"] ?></td>
      <td>
        <a href="./employee-u.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Edit</a>
        <a href="./employee-d.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    <a href="../employee/index.php">Back to Employees</a>
