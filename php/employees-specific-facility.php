<?php
echo "<br><h3>Employee Details for Specific Facility:</h3>";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Name</th><th>Address</th><th>City</th><th>PostalCode</th><th>WebAddress</th><th>Type</th><th>Capacity</th><th>President/PrincipalFirstName</th><th>President/PrincipalLastName</th><th>NumberOfEmployeesWorkingAtFacility</th></tr>";

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
    $sql = "SELECT p.firstName, p.lastName, wa.startDate AS startDateOfWork, p.dateOfBirth, p.medicareCardNumber, p.telephoneNumber, ap.address, ap.city, ap.province, p.postalcode, p.citizenship, p.emailaddress
    FROM employees e, facilities f, works_at wa, persons p, addresses_persons ap
    WHERE (f.facilityid = :fid OR f.name = :fname)
    AND f.facilityid = wa.facilityid
    AND wa.medicareCardNumber = e.medicareCardNumber 
    AND e.medicareCardNumber = p.medicareCardNumber
    AND p.postalcode = ap.postalcode
    AND wa.endDate IS NULL
    ORDER BY wa.role, p.firstName, p.lastName;";
    

    $stmt = $conn->prepare($sql);  
    
    $stmt->bindParam(':fid', $_REQUEST['fid']);
    $stmt->bindParam(':fname', $_REQUEST['fname']);

    $id = $_REQUEST['fid'];
    $name = $_REQUEST['fname'];
    
    if($id == null && $name == NULL) {
        echo "ID or Name must be inputted.<br>";
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
