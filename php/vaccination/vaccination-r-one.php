<?php
require_once '../database.php';

$sql = 'SELECT v.MedicareCardNumber, v.Date, v.Type, v.DoseNumber  FROM Vaccinations v WHERE v.MedicareCardNumber = :MedicareCardNumber;';

$stmt = $conn->prepare($sql);  
$stmt->bindParam(":MedicareCardNumber", $_GET["MedicareCardNumber"]);
    
$stmt->execute();
?>

<h1>Displaying One Vaccination</h1>

<br>
<table>
  <thead>
      <tr>
        <th>MedicareCardNumber</th>        
        <th>Vaccination Date</th>
        <th>Vaccination Type</th>
        <th>Dose Number</th>
        <th>Actions</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["MedicareCardNumber"] ?></td>      
      <td><?= $row["Date"] ?></td>
      <td><?= $row["Type"] ?></td>
      <td><?= $row["DoseNumber"] ?></td>
      <td>
        <a href="./edit-view.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Edit</a>&nbsp;
        <a href="./vaccination-d.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    <a href="./index.php">Back to Vaccinations List</a>
    
