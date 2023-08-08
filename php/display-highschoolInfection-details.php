
<br><h2>Highschools Infection Details:</h2>

<?php
require_once './database.php';


$sql = "SELECT 
af.Province AS HighSchoolProvince,
f.Name AS HighSchoolName,
f.Capacity AS HighSchoolCapacity,
(SELECT COUNT(DISTINCT t.MedicareCardNumber) 
FROM Teachers t 
JOIN Infections i ON t.MedicareCardNumber=i.MedicareCardNumber 
JOIN Works_At wa ON wa.MedicareCardNumber=t.MedicareCardNumber 
WHERE wa.FacilityID=h.FacilityID 
AND i.Date>= (SELECT CURDATE()-INTERVAL 14 DAY) 
AND UPPER(i.Type) = 'COVID-19') AS Number_Of_Teachers_Infected_In_Past_2_Weeks,
(SELECT COUNT(DISTINCT s.MedicareCardNumber) 
FROM Students s 
JOIN Infections i ON s.MedicareCardNumber=i.MedicareCardNumber 
JOIN Registered_At ra  ON ra.MedicareCardNumber=s.MedicareCardNumber 
WHERE ra.FacilityID=h.FacilityID 
AND i.Date>= (SELECT CURDATE()-INTERVAL 14 DAY) 
AND UPPER(i.Type) = 'COVID-19') AS Number_Of_Students_Infected_In_Past_2_Weeks
FROM highschools h 
JOIN Facilities f ON h.FacilityID =f.FacilityID 
JOIN Addresses_Facilities af ON af.PostalCode =f.PostalCode 
ORDER BY af.Province ASC, Number_Of_Teachers_Infected_In_Past_2_Weeks ASC;
";


$stmt = $conn->prepare($sql);  
   

$stmt->execute();

?>

<br>
<table>
  <thead>
      <tr>
        <th>HighSchoolProvince</th>        
        <th>HighSchoolName</th>
        <th>Capacity</th>
        <th>Number_Of_Teachers_Infected_In_Past_2_Weeks</th>
        <th>Number_Of_Students_Infected_In_Past_2_Weeks</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["HighSchoolProvince"] ?></td>      
      <td><?= $row["HighSchoolName"] ?></td>
      <td><?= $row["HighSchoolCapacity"] ?></td>
      <td><?= $row["Number_Of_Teachers_Infected_In_Past_2_Weeks"] ?></td>
      <td><?= $row["Number_Of_Students_Infected_In_Past_2_Weeks"] ?></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    




<?php

/*
echo "<br><h3>Highschool Infection Details:</h3>";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Province</th><th>SchoolName</th><th>Capacity</th><th>TotalTeachersInfected</th><th>TotalStudentsInfected</th></tr>";

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
    $sql = "SELECT af.Province, f.Name AS SchoolName, f.Capacity,
    COUNT(DISTINCT CASE WHEN t.MedicareCardNumber IS NOT NULL AND i.`Date` BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND CURDATE() THEN i.MedicareCardNumber END) AS TotalTeachersInfected,
    COUNT(DISTINCT CASE WHEN s.MedicareCardNumber IS NOT NULL AND i.`Date` BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND CURDATE() THEN i.MedicareCardNumber END) AS TotalStudentsInfected
    FROM HighSchools h
    INNER JOIN Facilities f ON h.FacilityID = f.FacilityID
    INNER JOIN Addresses_facilities af ON f.PostalCode = af.PostalCode
    LEFT JOIN Infections i ON f.FacilityID = i.MedicareCardNumber
    LEFT JOIN Teachers t ON i.MedicareCardNumber = t.MedicareCardNumber
    LEFT JOIN Students s ON i.MedicareCardNumber = s.MedicareCardNumber
    GROUP BY af.Province, f.Name, f.Capacity
    ORDER BY af.Province, TotalTeachersInfected;";
    

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
