
<br><h2>Scheduled Teachers for the last two weeks for "<?= $_POST['Name'] ?>": </h2>

<?php
require_once './database.php';

$sql = "SELECT p.FirstName, p.LastName, wa.`Role` 
FROM Facilities f 
JOIN Works_At wa ON wa.FacilityID =f.FacilityID 
JOIN Has_Schedule hs ON hs.MedicareCardNumber =wa.MedicareCardNumber 
JOIN Schedule s on s.ScheduleID =hs.ScheduleID 
JOIN Persons p on p.MedicareCardNumber =wa.MedicareCardNumber 
WHERE wa.MedicareCardNumber IN 
	(SELECT t.MedicareCardNumber  FROM Teachers t)
AND s.`Date` <= CURDATE()
AND s.`Date` >= (CURDATE()-INTERVAL 2 WEEK)
AND f.Name = :Name
ORDER BY wa.`Role` ASC, p.FirstName ASC;
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
      <td><?= $row["Level"] ?></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    



<?php

/*
echo "<br><h3>Scheduled Teachers for the past two weeks:</h3>";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>FirstName</th><th>LastName</th><th>Role</th></tr>";

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
    $sql = "SELECT p.FirstName, p.LastName , t.`Level`
    FROM Teachers t, Persons p, Facilities f, Has_schedule hs, Works_at wa, Schedule s
    WHERE f.Name = :fname AND p.MedicareCardNumber = t.MedicareCardNumber
    AND hs.MedicareCardNumber = t.MedicareCardNumber AND wa.MedicareCardNumber = t.MedicareCardNumber
    AND wa.FacilityID = f.FacilityID AND hs.FacilityID = f.FacilityID
    AND s.ScheduleID =hs.ScheduleID AND s.startTime >= DATE_SUB(NOW(), INTERVAL 2 WEEK)
    AND s.isCancelled = false;";
    

    $stmt = $conn->prepare($sql);  
    
    $stmt->bindParam(':fname', $_REQUEST['fname']);

    $name = $_REQUEST['fname'];
    
    if($name == NULL) {
        echo "Facility name must be inputted.<br>";
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
