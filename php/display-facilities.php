<?php
echo "<br><h3>Facility Details:</h3>";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>MedicareCardNumber</th><th>CurrentGradeLevel</th><th>Firstname</th><th>Lastname</th><th>MedicareExpiryDate</th><th>DateOfBirth</th><th>TelephoneNumber</th><th>Citizenship</th><th>Address</th><th>City</th><th>PostalCode</th><th>Province</th><th>Email</th></tr>";

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
    $sql = "SELECT s.medicareCardNumber, s.currentLevel, p.firstname, p.lastname, p.medicareexpirydate, p.dateofbirth, p.telephonenumber, p.citizenship, ap.address, ap.city, p.postalcode, ap.province, p.emailaddress
    FROM students s, persons p, addresses_persons ap
    WHERE s.medicareCardNumber = p.medicareCardNumber
    AND p.postalcode = ap.postalcode;";
    

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
