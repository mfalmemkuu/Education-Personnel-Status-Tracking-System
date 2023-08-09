<?php
require_once '../database.php';
$statement = $conn->prepare('SELECT m.MinistryID, m.Name
                             FROM Ministries m
                             WHERE m.MinistryID = :MinistryID;');
$statement->bindParam(":MinistryID", $_GET["MinistryID"]);

$statement->execute(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1>Displaying One Ministry</h1> <br>
<table>
<thead>
      <tr>
        <th>MinistryID</th>        
        <th>Name</th>
        <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php  while($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
        <td><?= $row["MinistryID"] ?></td>
        <td><?= $row["Name"] ?></td>
        <td>
            <a href="./ministry-edit.php?MinistryID=<?= $row["MinistryID"] ?>">Edit</a>&nbsp;
            <a href="./ministry-d.php?MinistryID=<?= $row["MinistryID"] ?>">Delete</a>
        </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
<br><br>
    <a href="../facility/index.php">Back to Facilities</a>
</body>
</html>