<?php
require_once '../database.php';


$sql = 'SELECT i.MedicareCardNumber, i.Date, i.Type  FROM Infections i;';

$stmt = $conn->prepare($sql);  
    

$stmt->execute();

?>
<!-- search for input -->
<form action="./infection-r-one.php">
  Search Infection by MedicareCardNumber: <input type="text" name="MedicareCardNumber">
  <input type="submit">
</form>
<br>
<table>
  <thead>
      <tr>
        <th>MedicareCardNumber</th>        
        <th>Infection Date</th>
        <th>Infection Type</th>
        <th>Actions</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["MedicareCardNumber"] ?></td>      
      <td><?= $row["Date"] ?></td>
      <td><?= $row["Type"] ?></td>
      <td>
        <a href="./edit-view.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Edit</a>&nbsp;
        <a href="./infection-d.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    

<?php
