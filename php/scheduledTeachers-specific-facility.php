
<br><h2>Scheduled Teachers for the last two weeks for "<?= $_POST['Name'] ?>": </h2>
<?php
require_once './database.php';

$sql = "SELECT p.FirstName, p.LastName, wa.Role
FROM Facilities f 
JOIN Works_At wa ON wa.FacilityID =f.FacilityID 
JOIN Has_Schedule hs ON hs.MedicareCardNumber =wa.MedicareCardNumber 
JOIN Schedule s ON s.ScheduleID =hs.ScheduleID 
JOIN Persons p ON p.MedicareCardNumber =wa.MedicareCardNumber 
WHERE wa.MedicareCardNumber IN 
	(SELECT t.MedicareCardNumber  
  FROM Teachers t)
AND s.`Date` <= CURDATE()
AND s.`Date` >= (CURDATE()-INTERVAL 2 WEEK)
AND f.Name = :Name
ORDER BY wa.Role ASC, p.FirstName ASC;
";

$stmt = $conn->prepare($sql);  

$stmt->bindParam(':Name', $_POST['Name']);
    

$stmt->execute();

?>
<br>
<table>
  <thead>
      <tr>
        <th>FirstName</th>        
        <th>LastName</th>
        <th>Teaching Level</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["FirstName"] ?></td>      
      <td><?= $row["LastName"] ?></td>
      <td><?= $row["Role"] ?></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
<?php

require_once("index.php");
?>
