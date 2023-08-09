<br><h2>Email Details for Specific Facility "<?= $_POST['Name'] ?>":</h2>
<?php
require_once './database.php';

$sql = "SELECT el.LogID AS EmailID, el.Subject , el.Sender, el.Receiver, el.Date, el.Body
FROM Email_Log el, Facilities f, Email_Sent es
WHERE el.LogID = es.LogID 
AND es.FacilityID = f.FacilityID 
AND f.Name =':Name';";

$stmt = $conn->prepare($sql);  

$stmt->bindParam(':Name', $_POST['Name']);
    

$stmt->execute();

?>
<br>
<table>
  <thead>
      <tr>
        <th>EmailID</th>        
        <th>Subject</th>
        <th>Sender</th>
        <th>Receiver</th>
        <th>Date</th>
        <th>Body</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["EmailID"] ?></td>      
      <td><?= $row["Subject"] ?></td>
      <td><?= $row["Sender"] ?></td>
      <td><?= $row["Receiver"] ?></td>
      <td><?= $row["Date"] ?></td>
      <td><?= $row["Body"] ?></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>

<?php

require_once("index.php");
?>
