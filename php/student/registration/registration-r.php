<?php
require_once '../database.php';

$sql = 'SELECT *
FROM registered_at r;';

$stmt = $conn->prepare($sql);  
    

$stmt->execute();

?>

<table>
  <thead>
      <tr>
        <th>MedicareCardNumber</th>
        <th>FacilityID</th>
        <th>StartDate</th>
        <th>EndDate</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["MedicareCardNumber"] ?></td>
      <td><?= $row["FacilityID"] ?></td>
      <td><?= $row["StartDate"] ?></td>
      <td><?= $row["EndDate"] ?></td>
      <td>
        <a href="./registration-u.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Edit</a> 
        <a href="./registration-d.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    <a href="../registration/index.php">Back to Registrations</a>



<?php

/*
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>MedicareCardNumber</th><th>FacilityID</th><th>Firstname</th><th>Lastname</th><th>MedicareExpiryDate</th><th>DateOfBirth</th><th>TelephoneNumber</th><th>Citizenship</th><th>Address</th><th>City</th><th>PostalCode</th><th>Province</th><th>Email</th></tr>";

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
    echo '<td><a href="./edit-view.php?medicareCardNumber='. parent::current() .'&facilityID='. parent::current() .'">Edit</a> ';
    echo '<a href="./student-d.php?medicareCardNumber='. parent::current() .'&facilityID='. parent::current() .'">Delete</a></td>';
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
    $sql = "SELECT *
    FROM registered_at r;";
    

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
?>
