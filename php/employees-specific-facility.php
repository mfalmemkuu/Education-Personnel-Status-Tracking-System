<br><h2>Employee Details for Facility "<?= $_POST['Name'] ?>":</h2>

<?php
require_once './database.php';

$sql = "SELECT p.FirstName, p.LastName, wa.StartDate AS StartDateOfWork, p.DateOfBirth, p.MedicareCardNumber, p.TelephoneNumber, ap.Address, ap.City, ap.Province, p.PostalCode, p.Citizenship, p.EmailAddress
    FROM employees e, facilities f, works_at wa, persons p, addresses_persons ap
    WHERE (f.Name = :Name)
    AND f.FacilityID = wa.FacilityID
    AND wa.MedicareCardNumber = e.MedicareCardNumber 
    AND e.MedicareCardNumber = p.MedicareCardNumber
    AND p.PostalCode = ap.PostalCode
    AND wa.EndDate IS NULL
    ORDER BY wa.Role, p.FirstName, p.LastName;";

$stmt = $conn->prepare($sql);  

$stmt->bindParam(':Name', $_POST['Name']);
    

$stmt->execute();

?>

<br>
<table>
  <thead>
      <tr>
        <th>FirstName</th>        
        <th>LastName</th>
        <th>StartDateOfWork</th>
        <th>DateOfBirth</th>
        <th>MedicareCardNumber</th>
        <th>TelephoneNumber</th>
        <th>Address</th>
        <th>City</th>
        <th>Province</th>
        <th>PostalCode</th>
        <th>Citizenship</th>
        <th>Email</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["FirstName"] ?></td>      
      <td><?= $row["LastName"] ?></td>
      <td><?= $row["StartDateOfWork"] ?></td>
      <td><?= $row["DateOfBirth"] ?></td>
      <td><?= $row["MedicareCardNumber"] ?></td>
      <td><?= $row["TelephoneNumber"] ?></td>
      <td><?= $row["Address"] ?></td>
      <td><?= $row["City"] ?></td>
      <td><?= $row["Province"] ?></td>      
      <td><?= $row["PostalCode"] ?></td>
      <td><?= $row["Citizenship"] ?></td>
      <td><?= $row["EmailAddress"] ?></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    



<?php

/*
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
*/

require_once("index.php");



?>
