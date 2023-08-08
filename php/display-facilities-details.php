<h2>Facility Details:</h2>

<?php
require_once './database.php';

$sql = "SELECT f.Name, af.Address, af.City, f.PostalCode, f.PhoneNumber, f.WebAddress, IF(f.FacilityID = mf.FacilityID, 'Management Facility','Educational Facility') AS Type, f.Capacity, p.FirstName AS PresidentOrPrincipalFirstName, p.LastName AS PresidentOrPrincipalLastName, COUNT(wa.MedicareCardNumber) AS NumberOfEmployeesWorkingForFacility
FROM facilities f, addresses_facilities af, managementfacilities mf, educationalfacilities ef, works_at wa, employees e, persons p
WHERE f.PostalCode = af.PostalCode
AND (f.FacilityID = mf.FacilityID OR f.FacilityID = ef.FacilityID)
AND (mf.PresidentMedicareNumber = wa.MedicareCardNumber OR ef.PrincipalMedicareNumber = wa.MedicareCardNumber )
AND wa.FacilityID = f.FacilityID
AND wa.MedicareCardNumber = e.MedicareCardNumber 
AND e.MedicareCardNumber = p.MedicareCardNumber
AND wa.EndDate IS NULL
GROUP BY f.FacilityID
ORDER BY af.Province, af.City, Type, NumberOfEmployeesWorkingForFacility;";
/*
$sql = "SELECT f.Name, f.PostalCode, f.PhoneNumber, f.WebAddress, IF(f.FacilityID = mf.FacilityID, 'Management Facility','Educational Facility') AS Type, f.Capacity, p.FirstName AS PresidentOrPrincipalFirstName, p.LastName AS PresidentOrPrincipalLastName, COUNT(wa.MedicareCardNumber) AS NumberOfEmployeesWorkingForFacility
FROM facilities f, managementfacilities mf, educationalfacilities ef, works_at wa, employees e, persons p
WHERE (f.FacilityID = mf.FacilityID OR f.FacilityID = ef.FacilityID)
AND (mf.PresidentMedicareNumber = wa.MedicareCardNumber OR ef.PrincipalMedicareNumber = wa.MedicareCardNumber )
AND wa.FacilityID = f.FacilityID
AND wa.MedicareCardNumber = e.MedicareCardNumber 
AND e.MedicareCardNumber = p.MedicareCardNumber
AND wa.EndDate IS NULL
GROUP BY f.FacilityID
ORDER BY Type, NumberOfEmployeesWorkingForFacility;";
*/
$stmt = $conn->prepare($sql);  
    

$stmt->execute();

?>


<br>
<table>
  <thead>
      <tr>
        <th>Facility Name</th>        
        <th>Address</th>
        <th>City</th>
        <th>PostalCode</th>
        <th>PhoneNumber</th>
        <th>WebAddress</th>
        <th>Type</th>
        <th>Capacity</th>
        <th>PresidentOrPrincipalFirstName</th>
        <th>NumberOfEmployeesWorkingForFacility</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["Name"] ?></td>      
      <td><?= $row["Address"] ?></td>
      <td><?= $row["City"] ?></td>
      <td><?= $row["PostalCode"] ?></td>
      <td><?= $row["PhoneNumber"] ?></td>
      <td><?= $row["WebAddress"] ?></td>
      <td><?= $row["Type"] ?></td>
      <td><?= $row["Capacity"] ?></td>
      <td><?= $row["PresidentOrPrincipalFirstName"] ?></td>
      <td><?= $row["NumberOfEmployeesWorkingForFacility"] ?></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    


<?php


/*
echo "<br><h3>Facility Details:</h3>";

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
    $sql = "SELECT f.name, af.address, af.city, f.postalcode, f.phoneNumber, f.webaddress, IF(f.facilityid = mf.facilityid, 'Management Facility','Educational Facility') AS type, f.capacity, p.firstName AS presidentOrPrincipalFirstName, p.lastName AS presidentOrPrincipalLastName, COUNT(wa.medicareCardNumber) AS NumberOfEmployeesWorkingForFacility
    FROM facilities f, addresses_facilities af, managementfacilities mf, educationalfacilities ef, works_at wa, employees e, persons p
    WHERE f.postalCode = af.postalcode
    AND (f.facilityid = mf.facilityid OR f.facilityid = ef.facilityid)
    AND (mf.presidentMedicareNumber = wa.medicareCardNumber OR ef.principalMedicareNumber = wa.medicareCardNumber )
    AND wa.facilityid = f.facilityid
    AND wa.medicareCardNumber = e.medicareCardNumber 
    AND e.medicareCardNumber = p.medicareCardNumber
    AND wa.endDate IS NULL
    GROUP BY f.facilityid
    ORDER BY af.province, af.city, type, NumberOfEmployeesWorkingForFacility;";
    

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
