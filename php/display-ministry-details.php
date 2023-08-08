<br><h2>Ministry Details:</h2>

<?php
require_once './database.php';

$sql = "SELECT 
p.FirstName AS MinisterFirstName,
p.LastName AS MinisterLastName,
ap.City AS MinisterCityOfResidence,
(SELECT COUNT(*) FROM Operates o1 JOIN ManagementFacilities m3 ON m3.FacilityID =o1.FacilityID WHERE o1.MinistryID=m.MinistryID) AS NumberOfManagementFacilities,
(SELECT COUNT(*) FROM Operates o1 JOIN EducationalFacilities e  ON e.FacilityID =o1.FacilityID WHERE o1.MinistryID=m.MinistryID) AS NumberOfEducationalFacilities
FROM Ministries m 
JOIN Operates o ON o.MinistryID =m.MinistryID 
JOIN HeadOfficeFacilities h on h.FacilityID = o.FacilityID 
JOIN ManagementFacilities m2 on m2.FacilityID = h.FacilityID 
JOIN Persons p on p.MedicareCardNumber = m2.PresidentMedicareNumber 
JOIN Addresses_Persons ap ON ap.PostalCode =p.PostalCode
GROUP BY m.MinistryID 
ORDER BY ap.City ASC, 
((SELECT COUNT(*) FROM Operates o1 JOIN ManagementFacilities m3 ON m3.FacilityID =o1.FacilityID WHERE o1.MinistryID=m.MinistryID)
+
(SELECT COUNT(*) FROM Operates o1 JOIN EducationalFacilities e  ON e.FacilityID =o1.FacilityID WHERE o1.MinistryID=m.MinistryID)) DESC;";

$stmt = $conn->prepare($sql);  
   

$stmt->execute();

?>

<br>
<table>
  <thead>
      <tr>
        <th>MinisterFirstName</th>        
        <th>MinisterLastName</th>
        <th>MinisterCityOfResidence</th>
        <th>NumberOfManagementFacilities</th>
        <th>NumberOfEducationalFacilities</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["MinisterFirstName"] ?></td>      
      <td><?= $row["MinisterLastName"] ?></td>
      <td><?= $row["MinisterCityOfResidence"] ?></td>
      <td><?= $row["NumberOfManagementFacilities"] ?></td>
      <td><?= $row["NumberOfEducationalFacilities"] ?></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    

<?php
/*
echo "<br><h3>Ministry Details:</h3>";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>MinisterFirstName</th><th>MinisterLastName</th><th>MinisterCity</th><th>TotalManagementFacilities</th><th>TotalEducationalFacilities</th></tr>";

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
    $sql = "SELECT p.FirstName AS MinisterFirstName, p.LastName AS MinisterLastName,
    ap.City AS MinisterCity,
    COUNT(DISTINCT mf.FacilityID) AS TotalManagementFacilities,
    COUNT(DISTINCT ef.FacilityID) AS TotalEducationalFacilities
    FROM Ministries m
    INNER JOIN Employees e ON m.MinistryID = e.MedicareCardNumber
    INNER JOIN Persons p ON e.MedicareCardNumber = p.MedicareCardNumber
    INNER JOIN Addresses_persons ap ON p.PostalCode = ap.PostalCode
    LEFT JOIN ManagementFacilities mf ON m.MinistryID = mf.PresidentMedicareNumber
    LEFT JOIN EducationalFacilities ef ON m.MinistryID = ef.PrincipalMedicareNumber
    GROUP BY p.FirstName, p.LastName, ap.City
    ORDER BY ap.City ASC, TotalManagementFacilities DESC;";
    

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
