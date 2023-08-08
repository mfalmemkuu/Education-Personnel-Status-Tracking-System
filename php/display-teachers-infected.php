<br><h2>Infected Teachers in the past two weeks:</h2>

<?php
require_once './database.php';

$sql = "SELECT p.FirstName, p.LastName, i.Date, f.Name
FROM Infections i, Teachers t, Persons p, Employees e, Works_At wa, Facilities f
WHERE (i.Date BETWEEN (NOW() - INTERVAL 14 DAY) AND NOW())
AND i.MedicareCardNumber = p.MedicareCardNumber
AND p.MedicareCardNumber = e.MedicareCardNumber
AND e.MedicareCardNumber = wa.MedicareCardNumber
AND wa.FacilityID = f.FacilityID
AND i.Type = 'COVID-19'
GROUP BY i.Date
ORDER BY f.Name, p.FirstName;";

$stmt = $conn->prepare($sql);  
    

$stmt->execute();

?>

<br>
<table>
  <thead>
      <tr>
        <th>FirstName</th>        
        <th>LastName</th>
        <th>Date</th>
        <th>Facility Name</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["FirstName"] ?></td>      
      <td><?= $row["LastName"] ?></td>
      <td><?= $row["Date"] ?></td>
      <td><?= $row["Name"] ?></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    



<?php

/*
echo "<br><h3>Infected Teachers in the past two weeks:</h3>";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>FirstName</th><th>LastName</th><th>DateInfected</th><th>FacilityCurrentlyWorkingAt</th></tr>";

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
    $sql = "SELECT p.firstname, p.lastname, i.date, f.name
    FROM infections i, teachers t, persons p, employees e, works_at wa, facilities f
    WHERE CURDATE() - 14 < i.date
    AND i.medicareCardNumber = p.medicareCardNumber
    AND p.medicareCardNumber = e.medicareCardNumber
    AND e.medicareCardNumber = wa.medicareCardNumber
    AND wa.facilityID = f.facilityID
    AND i.type = 'COVID-19'
    ORDER BY f.name, p.firstName;";
    

    $stmt = $conn->prepare($sql);  
    

    $stmt->execute();
  
    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}

//close connection once done
$conn = null;
echo "</table>";

*/
require_once("index.php");
?>
