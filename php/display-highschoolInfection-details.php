<?php
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
require_once("index.php");
?>
