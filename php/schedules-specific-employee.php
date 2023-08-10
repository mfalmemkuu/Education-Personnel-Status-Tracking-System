<h2>Schedule Details for Employee "<?= $_POST['MedicareCardNumber'] ?>", Between <?= $_POST['StartTime'] ?> and <?= $_POST['EndTime'] ?>:</h2>

<?php
require_once './database.php';


$sql = "SELECT s.ScheduleID, f.Name, s.`Date`, s.StartTime, s.EndTime
FROM Has_Schedule hs, Facilities f, Schedule s, Employees e
WHERE s.`Date` >= :StartTime
AND s.`Date` <= :EndTime 
AND s.ScheduleID = hs.ScheduleID 
AND f.FacilityID = hs.FacilityID 
AND hs.MedicareCardNumber = :MedicareCardNumber
AND hs.MedicareCardNumber = e.MedicareCardNumber 
ORDER BY f.Name ASC, s.`Date` ASC, s.StartTime ASC;";

$stmt = $conn->prepare($sql);  

$stmt->bindParam(':MedicareCardNumber', $_POST['MedicareCardNumber']);
$stmt->bindParam(':StartTime', $_POST['StartTime']);
$stmt->bindParam(':EndTime', $_POST['EndTime']);

$stmt->execute();

?>

<br>
<table>
  <thead>
      <tr>
        <th>ScheduleID</th>        
        <th>Facility Name</th>
        <th>Schedule Date</th>
        <th>StartTime</th>
        <th>EndTime</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["ScheduleID"] ?></td>      
      <td><?= $row["Name"] ?></td>
      <td><?= $row["Date"] ?></td>
      <td><?= $row["StartTime"] ?></td>
      <td><?= $row["EndTime"] ?></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    



<?php

require_once("index.php");
?>
