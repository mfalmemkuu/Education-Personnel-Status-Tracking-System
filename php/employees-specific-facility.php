<br><h2>Employee Details for Facility "<?= $_POST['Name'] ?>":</h2>

<?php
require_once './database.php';

$sql = "SELECT p.FirstName, p.LastName, wa.StartDate AS StartDateOfWork, p.DateOfBirth, p.MedicareCardNumber, p.TelephoneNumber, ap.Address, ap.City, ap.Province, p.PostalCode, p.Citizenship, p.EmailAddress
    FROM Employees e, Facilities f, Works_At wa, Persons p, Addresses_Persons ap
    WHERE (f.Name = :Name)
    AND f.FacilityID = wa.FacilityID
    AND wa.MedicareCardNumber = e.MedicareCardNumber 
    AND e.MedicareCardNumber = p.MedicareCardNumber
    AND p.PostalCode = ap.PostalCode
    AND wa.EndDate IS NULL
    ORDER BY wa.Role ASC, p.FirstName ASC, p.LastName ASC;";

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


require_once("index.php");



?>
