<h2>Facility Details:</h2>

<?php
require_once './database.php';

$sql = "SELECT f.Name, af.Address, af.City, f.PostalCode, f.PhoneNumber, f.WebAddress, IF(f.FacilityID = mf.FacilityID, 'Management Facility','Educational Facility') AS Type, f.Capacity, p.FirstName AS PresidentOrPrincipalFirstName, p.LastName AS PresidentOrPrincipalLastName, COUNT(wa.MedicareCardNumber) AS NumberOfEmployeesWorkingForFacility
FROM Facilities f, Addresses_Facilities af, ManagementFacilities mf, EducationalFacilities ef, Works_At wa, Employees e, Persons p
WHERE f.PostalCode = af.PostalCode
AND (f.FacilityID = mf.FacilityID OR f.FacilityID = ef.FacilityID)
AND (mf.PresidentMedicareNumber = wa.MedicareCardNumber OR ef.PrincipalMedicareNumber = wa.MedicareCardNumber )
AND wa.FacilityID = f.FacilityID
AND wa.MedicareCardNumber = e.MedicareCardNumber 
AND e.MedicareCardNumber = p.MedicareCardNumber
AND wa.EndDate IS NULL
GROUP BY f.FacilityID
ORDER BY af.Province, af.City, Type, NumberOfEmployeesWorkingForFacility;";

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

require_once("index.php");


?>
