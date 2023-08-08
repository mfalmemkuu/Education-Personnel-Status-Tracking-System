<h2>Schedule Details for Employee "<?= $_POST['MedicareCardNumber'] ?>", Between <?= $_POST['StartTime'] ?> and <?= $_POST['EndTime'] ?>:</h2>

<?php
require_once './database.php';

$sql = "SELECT s.ScheduleID, f.Name, s.Date, s.StartTime, s.EndTime
FROM employees e, has_schedule hs, facilities f, schedule s
WHERE s.StartTime >= :StartTime AND s.EndTime <= :EndTime 
AND s.IsCancelled = false
AND e.MedicareCardNumber = :MedicareCardNumber
AND hs.FacilityID = f.FacilityID
AND s.ScheduleID = hs.ScheduleID
AND hs.MedicareCardNumber = e.MedicareCardNumber
ORDER BY f.Name, s.Date, s.StartTime;";

$stmt = $conn->prepare($sql);  

$stmt->bindParam(':MedicareCardNumber', $_REQUEST['MedicareCardNumber']);
$stmt->bindParam(':StartTime', $_REQUEST['StartTime']);
$stmt->bindParam(':EndTime', $_REQUEST['EndTime']);
    

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

/*

echo "<br><h3>Schedule Details for Specific Employee:</h3>";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>ScheduleID</th><th>FacilityName</th><th>DateRegistered</th><th>StartTime</th><th>EndTime</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }


}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

try {
    $sql = "SELECT s.scheduleid, f.name, s.date, s.startTime, s.endTime
    FROM employees e, has_schedule hs, facilities f, schedule s
    WHERE s.startTime >= :startTime AND s.endTime <= :endTime 
    AND s.isCancelled = false
    AND e.medicareCardNumber = :medicareCardNumber
    AND hs.facilityid = f.facilityid
    AND s.scheduleid = hs.scheduleid
    AND hs.medicareCardNumber = e.medicareCardNumber
    ORDER BY f.name, s.date, s.startTime;";
    

    $stmt = $conn->prepare($sql);  
    
    $stmt->bindParam(':medicareCardNumber', $_REQUEST['medicareCardNumber']);
    $stmt->bindParam(':startTime', $_REQUEST['startTime']);
    $stmt->bindParam(':endTime', $_REQUEST['endTime']);

    $id = $_REQUEST['medicareCardNumber'];
    $startDate = $_REQUEST['startTime'];
    $endDate = $_REQUEST['endTime'];
    
    if($id == null && $startDate == null && $endDate == null) {
        echo "ID and dates must be inputted.<br>";
        goto break_free_of_try;
    }

    $stmt->execute();
  
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_of_try:

//close connection once done
$conn = null;
echo "</table>";
*/
require_once("index.php");
?>
