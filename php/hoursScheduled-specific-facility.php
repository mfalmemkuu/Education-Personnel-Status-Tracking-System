<?php
echo "<br><h3>Total Hours Scheduled for Specific Teacher:</h3>";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>FirstName</th><th>LastName</th><th>TotalScheduledHours</th></tr>";

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
    $sql = "SELECT p.FirstName, p.LastName, SUM(TIMESTAMPDIFF(HOUR, s.StartTime, s.EndTime)) AS TotalScheduledHours
FROM 
    Teachers t
INNER JOIN 
    Has_schedule hs ON t.MedicareCardNumber = hs.MedicareCardNumber
INNER JOIN 
    Schedule s ON hs.ScheduleID = s.ScheduleID
INNER JOIN 
    Facilities f ON hs.FacilityID = f.FacilityID
INNER JOIN 
    Persons p ON t.MedicareCardNumber = p.MedicareCardNumber
WHERE 
    f.Name = :fname 
    AND s.Date >= :startTime AND s.Date <= :endTime 
GROUP BY 
    p.FirstName,
    p.LastName
ORDER BY 
    p.FirstName,
    p.LastName;
";
    

    $stmt = $conn->prepare($sql);  
    
    $stmt->bindParam(':fname', $_REQUEST['fname']);
    $stmt->bindParam(':startTime', $_REQUEST['startTime']);
    $stmt->bindParam(':endTime', $_REQUEST['endTime']);

    $name = $_REQUEST['fname'];
    $startDate = $_REQUEST['startTime'];
    $endDate = $_REQUEST['endTime'];
    
    if($name == null && $startDate == null && $endDate == null) {
        echo "Facility name and dates must be inputted.<br>";
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
require_once("index.php");
?>
