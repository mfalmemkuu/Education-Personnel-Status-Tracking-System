<?php
require_once '../database.php';

$sql = "SELECT s.ScheduleID, s.Date, s.StartTime, s.EndTime, IF(s.IsCancelled,'Yes', 'No') AS IsCancelled, IF(hs.MedicareCardNumber IS NULL, 'Unassigned', hs.MedicareCardNumber) AS MedicareCardNumber, IF(hs.FacilityID IS NULL, 'Unassigned', hs.FacilityID) AS FacilityID
FROM Schedule s
LEFT JOIN Has_Schedule hs ON s.ScheduleID = hs.ScheduleID
WHERE hs.ScheduleID = :ScheduleID ;";

$stmt = $conn->prepare($sql);      
$stmt->bindParam(":ScheduleID", $_GET["ScheduleID"]);
$stmt->execute();

?>

<h1>Displaying One Schedule</h1>

<table>
  <thead>
      <tr>
        <th>ScheduleID</th>
        <th>Date</th>
        <th>StartTime</th>
        <th>EndTime</th>
        <th>MedicareCardNumber</th>
        <th>FacilityID</th>
        <th>Actions</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["ScheduleID"] ?></td>
      <td><?= $row["Date"] ?></td>
      <td><?= $row["StartTime"] ?></td>
      <td><?= $row["EndTime"] ?></td>
      <td><?= $row["MedicareCardNumber"] ?></td>
      <td><?= $row["FacilityID"] ?></td>
      <td>
        <a href="./create-view.php?ScheduleID=<?= $row["ScheduleID"] ?>">Assign</a>&nbsp;
        <a href="./edit-view.php?ScheduleID=<?= $row["ScheduleID"] ?>">Edit</a>&nbsp;
        <a href="./schedule-d.php?ScheduleID=<?= $row["ScheduleID"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    <a href="./index.php">Back to Schedule List</a>