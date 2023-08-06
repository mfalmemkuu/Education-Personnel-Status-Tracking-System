<?php


echo "<table style='border: solid 1px black;'>";
echo "<tr><th>FacilityID</th><th>Name</th><th>WebAddress</th><th>Capacity</th><th>PostalCode</th><th>DateOfBirth</th><th>PhoneNumber</th><th>MinistryName</th></tr>";

class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td style='width:auto;'>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo '<td><a href="./edit-view.php?facilityID='. parent::current() .'">Edit</a> ';
    echo '<a href="./facility-d.php?facilityID='. parent::current() .'">Delete</a></td>';
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
    $sql = "SELECT f.FacilityID, f.Name, f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber, m.Name AS MinistryName
    FROM Facilities f, Ministries m, Operates o, EducationalFacilities ef, managementFacilities mf
    WHERE f.FacilityID=o.FacilityID
    AND m.MinistryID = o.MinistryID
    AND (ef.FacilityID = f.FacilityID OR mf.FacilityID = f.FacilityID);";
    

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
?>
