<br><h2>Total Hours Scheduled for Teacher "<?= $_POST['Name'] ?>":</h2>

<?php
require_once './database.php';

$sql = "SELECT 
p.FirstName,
p.LastName,
SUM(TIMESTAMPDIFF(HOUR, s.StartTime, s.EndTime)) AS TotalScheduledHours
FROM 
Teachers t
INNER JOIN 
Has_Schedule hs ON t.MedicareCardNumber = hs.MedicareCardNumber
INNER JOIN 
Schedule s ON hs.ScheduleID = s.ScheduleID
INNER JOIN 
Facilities f ON hs.FacilityID = f.FacilityID
INNER JOIN 
Persons p ON t.MedicareCardNumber = p.MedicareCardNumber
WHERE 
f.Name = :Name 
AND s.Date >= :StartTime AND s.Date <= :EndTime
GROUP BY 
p.FirstName,
p.LastName
ORDER BY 
p.FirstName,
p.LastName;";

$stmt = $conn->prepare($sql);  

$stmt->bindParam(':Name', $_POST['Name']);
$stmt->bindParam(':StartTime', $_POST['StartTime']);
$stmt->bindParam(':EndTime', $_POST['EndTime']);
    

$stmt->execute();

?>

<br>
<table>
  <thead>
      <tr>
        <th>FirstName</th>        
        <th>LastName</th>
        <th>TotalScheduledHours</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["FirstName"] ?></td>      
      <td><?= $row["LastName"] ?></td>
      <td><?= $row["TotalScheduledHours"] ?></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    



<?php


require_once("index.php");



?>

