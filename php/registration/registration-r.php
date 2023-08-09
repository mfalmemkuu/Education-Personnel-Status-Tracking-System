<?php
require_once '../database.php';

$sql = "SELECT s.MedicareCardNumber,CONCAT(p.FirstName, ' ', p.LastName) AS StudentName, f.Name, ra.StartDate, ra.EndDate
FROM Persons p, Facilities f, Registered_At ra, Students s 
WHERE p.MedicareCardNumber = s.MedicareCardNumber 
AND s.MedicareCardNumber = ra.MedicareCardNumber 
AND ra.FacilityID = f.FacilityID ;";

$stmt = $conn->prepare($sql);      

$stmt->execute();

?>
<form action="./registration-r-one.php" method="post">
  Search Registration by Student MedicareCardNumber: <input type="text" name="MedicareCardNumber">
  <input type="submit">
</form>
<br>
<table>
  <thead>
      <tr>
        <th>MedicareCardNumber</th>
        <th>StudentName</th>
        <th>EducationalFacility</th>
        <th>StartDate</th>
        <th>EndDate</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["MedicareCardNumber"] ?></td>
      <td><?= $row["StudentName"] ?></td>
      <td><?= $row["Name"] ?></td>
      <td><?= $row["StartDate"] ?></td>
      <td><?= $row["EndDate"] ?></td>
      <td>
        <a href="./edit-view.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Edit</a> 
        <a href="./registration-d.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>


