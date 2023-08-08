
<br><h2>Highschools Infection Details:</h2>

<?php
require_once './database.php';
/*
$sql = "SELECT af.Province, f.Name AS SchoolName, f.Capacity,
(SELECT COUNT(t.MedicareCardNumber) 
    FROM HighSchools h, Facilities f, Infections i, Teachers t,Persons p, Works_at w, Employees e, EducationalFacilities ef
    WHERE h.FacilityID = ef.FacilityID
    AND ef.FacilityID = f.FacilityID
    AND w.FacilityID = f.FacilityID
    AND p.MedicareCardNumber = i.MedicareCardNumber
    AND p.MedicareCardNumber = t.MedicareCardNumber
    AND w.MedicareCardNumber = e.MedicareCardNumber
    AND e.MedicareCardNumber = t.MedicareCardNumber
    AND w.EndDate IS NULL
    AND i.Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND CURDATE()) AS TotalTeachersInfected,
(SELECT COUNT(s.MedicareCardNumber) 
    FROM HighSchools h, Facilities f, Infections i,Students s, Persons p,Registered_at r,EducationalFacilities ef
    WHERE p.MedicareCardNumber = i.MedicareCardNumber
    AND p.MedicareCardNumber = s.MedicareCardNumber
    AND r.MedicareCardNumber = s.MedicareCardNumber
    AND h.FacilityID = ef.FacilityID
    AND ef.FacilityID = f.FacilityID
    AND r.FacilityID = ef.FacilityID
    AND r.EndDate IS NULL
    AND i.Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND CURDATE()) AS TotalStudentsInfected
FROM HighSchools h, Facilities f, Addresses_facilities af, EducationalFacilities ef
WHERE h.FacilityID = ef.FacilityID
AND ef.FacilityID = f.FacilityID
AND f.PostalCode = af.PostalCode
GROUP BY h.FacilityID
ORDER BY af.Province, TotalTeachersInfected;";
*/

$sql = "SELECT af.Province, f.Name AS SchoolName, f.Capacity 
FROM HighSchools h, Facilities f, Addresses_facilities af, EducationalFacilities ef
WHERE h.FacilityID = ef.FacilityID
AND ef.FacilityID = f.FacilityID
AND f.PostalCode = af.PostalCode
GROUP BY h.FacilityID
ORDER BY af.Province, TotalTeachersInfected
UNION 
SELECT af.Province, f.Name AS SchoolName, f.Capacity, COUNT(t.MedicareCardNumber) AS TotalTeachersInfected
    FROM HighSchools h, Facilities f, Infections i, Teachers t,Persons p, Works_at w, Employees e, EducationalFacilities ef
    WHERE h.FacilityID = ef.FacilityID
    AND ef.FacilityID = f.FacilityID
    AND w.FacilityID = f.FacilityID
    AND p.MedicareCardNumber = i.MedicareCardNumber
    AND p.MedicareCardNumber = t.MedicareCardNumber
    AND w.MedicareCardNumber = e.MedicareCardNumber
    AND e.MedicareCardNumber = t.MedicareCardNumber
    AND w.EndDate IS NULL
    AND i.Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND CURDATE()
    GROUP BY h.FacilityID
ORDER BY af.Province, TotalTeachersInfected
UNION
SELECT af.Province, f.Name AS SchoolName, f.Capacity, COUNT(s.MedicareCardNumber) TotalStudentsInfected
    FROM HighSchools h, Facilities f, Infections i,Students s, Persons p,Registered_at r,EducationalFacilities ef
    WHERE p.MedicareCardNumber = i.MedicareCardNumber
    AND p.MedicareCardNumber = s.MedicareCardNumber
    AND r.MedicareCardNumber = s.MedicareCardNumber
    AND h.FacilityID = ef.FacilityID
    AND ef.FacilityID = f.FacilityID
    AND r.FacilityID = ef.FacilityID
    AND r.EndDate IS NULL
    AND i.Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND CURDATE()
    GROUP BY h.FacilityID
ORDER BY af.Province, TotalTeachersInfected;";


/*
SELECT af.Province, f.Name AS SchoolName, f.Capacity,
(SELECT COUNT(t.MedicareCardNumber) 
    FROM HighSchools h, Facilities f, Infections i, Teachers t,Persons p, Works_at w, Employees e, EducationalFacilities ef
    WHERE h.FacilityID = ef.FacilityID
    AND ef.FacilityID = f.FacilityID
    AND w.FacilityID = f.FacilityID
    AND p.MedicareCardNumber = i.MedicareCardNumber
    AND p.MedicareCardNumber = t.MedicareCardNumber
    AND w.MedicareCardNumber = e.MedicareCardNumber
    AND e.MedicareCardNumber = t.MedicareCardNumber
    AND w.EndDate IS NULL
    AND i.Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND CURDATE()) AS TotalTeachersInfected,
(SELECT COUNT(s.MedicareCardNumber) 
    FROM HighSchools h, Facilities f, Infections i,Students s, Persons p,Registered_at r,EducationalFacilities ef
    WHERE p.MedicareCardNumber = i.MedicareCardNumber
    AND p.MedicareCardNumber = s.MedicareCardNumber
    AND r.MedicareCardNumber = s.MedicareCardNumber
    AND h.FacilityID = ef.FacilityID
    AND ef.FacilityID = f.FacilityID
    AND r.FacilityID = ef.FacilityID
    AND r.EndDate IS NULL
    AND i.Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND CURDATE()) AS TotalStudentsInfected
FROM HighSchools h, Facilities f, Addresses_facilities af, EducationalFacilities ef
WHERE h.FacilityID = ef.FacilityID
AND ef.FacilityID = f.FacilityID
AND f.PostalCode = af.PostalCode
GROUP BY h.FacilityID
ORDER BY af.Province, TotalTeachersInfected;
*/

/*
$sql = "SELECT 
COUNT(DISTINCT CASE WHEN t.MedicareCardNumber IS NOT NULL AND i.Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND CURDATE() THEN i.MedicareCardNumber END) AS TotalTeachersInfected,
COUNT(DISTINCT CASE WHEN s.MedicareCardNumber IS NOT NULL AND i.Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND CURDATE() THEN i.MedicareCardNumber END) AS TotalStudentsInfected
FROM Infections i, Teachers t, Students s, Persons p, Employees e
WHERE p.MedicareCardNumber = i.MedicareCardNumber
AND p.MedicareCardNumber = s.MedicareCardNumber
AND p.MedicareCardNumber = t.MedicareCardNumber
AND e.MedicareCardNumber = t.MedicareCardNumber
ORDER BY TotalTeachersInfected;";

$sql = "SELECT 
COUNT(DISTINCT  s.MedicareCardNumber ) AS TotalStudentsInfected
FROM Infections i, Persons p, Students s
WHERE p.MedicareCardNumber = i.MedicareCardNumber
AND i.Date BETWEEN DATE_SUB(CURDATE(), INTERVAL 2 WEEK) AND CURDATE()
AND p.MedicareCardNumber = s.MedicareCardNumber;";
*/
$stmt = $conn->prepare($sql);  
   

$stmt->execute();

?>

<br>
<table>
  <thead>
      <tr>
        <th>Province</th>        
        <th>SchoolName</th>
        <th>Capacity</th>
        <th>TotalTeachersInfected</th>
        <th>TotalStudentsInfected</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["Province"] ?></td>      
      <td><?= $row["SchoolName"] ?></td>
      <td><?= $row["Capacity"] ?></td>
      <td><?= $row["TotalTeachersInfected"] ?></td>
      <td><?= $row["TotalStudentsInfected"] ?></td>
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
