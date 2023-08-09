<?php
require_once '../database.php';

$sql = "SELECT s.ScheduleID, s.Date, s.StartTime, s.EndTime, hs.MedicareCardNumber, hs.FacilityID
FROM Schedule s
LEFT JOIN Has_Schedule hs ON s.ScheduleID = hs.ScheduleID
WHERE s.IsCancelled = false;";

$stmt = $conn->prepare($sql);      

$stmt->execute();

?>
<form action="./schedule-r-one.php" method="post">
  Search Schedule by Employee MedicareCardNumber: <input type="text" name="MedicareCardNumber">
  <input type="submit">
</form>
<br>
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
      <!-- ADD ANOTHER ACTION FOR ASSIGNING SCHEDULE, WILL GRAB THE SCHEDULE ID FOR HAS_SCHEDULE -->
      <td>
        <a href="./edit-view.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Edit</a>&nbsp;
        <a href="./registration-d.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>


