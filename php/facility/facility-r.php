<?php require_once '../database.php';

//ministries
$ministry = $conn->prepare('SELECT m.MinistryID, m.Name FROM Ministries m;');
$ministry->execute();

//facilities
$facility = $conn->prepare('SELECT f.FacilityID, f.Name, f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber FROM Facilities f;');
$facility->execute();

//education facilities
$edfacility = $conn->prepare("SELECT e.FacilityID, f.Name, CONCAT(p.FirstName, ' ', p.LastName) AS PrincipalName, f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber
FROM facilities f
JOIN educationalfacilities e ON e.FacilityID = f.FacilityID
JOIN persons p ON e.PrincipalMedicareNumber = p.MedicareCardNumber
JOIN works_at wa ON f.FacilityID = wa.FacilityID
AND e.PrincipalMedicareNumber = wa.MedicareCardNumber;");
$edfacility->execute();

//primary schools
$psfacility = $conn->prepare("SELECT e.FacilityID, f.Name, CONCAT(p.FirstName, ' ', p.LastName) AS PrincipalName, f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber
FROM Facilities f
JOIN EducationalFacilities e ON e.FacilityID = f.FacilityID
JOIN PrimarySchools ps ON ps.FacilityID = f.FacilityID  
JOIN Persons p ON e.PrincipalMedicareNumber = p.MedicareCardNumber
JOIN Works_At wa ON f.FacilityID = wa.FacilityID
AND e.PrincipalMedicareNumber = wa.MedicareCardNumber;");
$psfacility->execute();

//middle schools
$msfacility = $conn->prepare("SELECT e.FacilityID, f.Name, CONCAT(p.FirstName, ' ', p.LastName) AS PrincipalName, f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber
FROM Facilities f
JOIN EducationalFacilities e ON e.FacilityID = f.FacilityID
JOIN MiddleSchools ms ON ms.FacilityID = f.FacilityID  
JOIN Persons p ON e.PrincipalMedicareNumber = p.MedicareCardNumber
JOIN Works_At wa ON f.FacilityID = wa.FacilityID
AND e.PrincipalMedicareNumber = wa.MedicareCardNumber;");
$msfacility->execute();


//high schools
$hsfacility = $conn->prepare("SELECT e.FacilityID, f.Name, CONCAT(p.FirstName, ' ', p.LastName) AS PrincipalName, f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber
FROM Facilities f
JOIN EducationalFacilities e ON e.FacilityID = f.FacilityID
JOIN HighSchools hs ON hs.FacilityID = f.FacilityID  
JOIN Persons p ON e.PrincipalMedicareNumber = p.MedicareCardNumber
JOIN Works_At wa ON f.FacilityID = wa.FacilityID
AND e.PrincipalMedicareNumber = wa.MedicareCardNumber;");
$hsfacility->execute();


//management facilities
$mafacility = $conn->prepare("SELECT m.FacilityID, f.Name, CONCAT(p.FirstName, ' ', p.LastName) AS PresidentName, f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber
FROM facilities f, managementfacilities m, persons p 
WHERE m.FacilityID = f.FacilityID 
AND m.PresidentMedicareNumber = p.MedicareCardNumber ;");

//head office facilities
$hofacility = $conn->prepare("SELECT hof.FacilityID, f.Name, CONCAT(p.FirstName, ' ', p.LastName) AS PresidentName, f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber
FROM Facilities f, ManagementFacilities m, Persons p , HeadOfficeFacilities hof 
WHERE m.FacilityID = f.FacilityID 
AND m.PresidentMedicareNumber = p.MedicareCardNumber 
AND hof.FacilityID = f.FacilityID ;");
$hofacility->execute();

// general management facilities
$gmfacility = $conn->prepare("SELECT gmf.FacilityID, f.Name, CONCAT(p.FirstName, ' ', p.LastName) AS PresidentName, f.WebAddress, f.Capacity, f.PostalCode, f.PhoneNumber
FROM Facilities f, ManagementFacilities m, Persons p , GeneralManagementFacilities gmf 
WHERE m.FacilityID = f.FacilityID 
AND m.PresidentMedicareNumber = p.MedicareCardNumber 
AND gmf.FacilityID = f.FacilityID ;");
$gmfacility->execute();


$mafacility->execute();


?>

<h2>List of Ministries</h2>
<form action="./ministry-r-one.php" method="get">
  Search Ministry by ID: <input type="text" name="MinistryID">
  <input type="submit">
</form><br>
    <a href="./ministry-create.php">Create a Ministry</a><br><br>
    <table>
        <thead>
            <tr>
                <th>MinistryID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $ministry->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["MinistryID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td>
                    <a href="./ministry-edit.php?MinistryID=<?=$row["MinistryID"] ?>">Edit</a> &nbsp;
                    <a href="./ministry-d.php?MinistryID=<?=$row["MinistryID"] ?>">Delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>
    <br>

<h2>List of Facilities</h2>
<form action="./facility-r-one.php" method="get">
  Search Facility by ID: <input type="text" name="FacilityID">
  <input type="submit">
</form>
<br>

<a href="./facility-create.php">Create a Facility</a><br><br>
<table>
  <thead>
      <tr>
        <th>FacilityID</th>        
        <th>Name</th>
        <th>WebAddress</th>
        <th>Capacity</th>
        <th>PostalCode</th>
        <th>PhoneNumber</th>
        <th>Actions</th>
  </thead>
  <tbody>
    <?php  while($row = $facility->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["FacilityID"] ?></td>    
      <td><?= $row["Name"] ?></td>
      <td><?= $row["WebAddress"] ?></td>
      <td><?= $row["Capacity"] ?></td>
      <td><?= $row["PostalCode"] ?></td>
      <td><?= $row["PhoneNumber"] ?></td>
      <td>
        <a href="./facility-edit.php?FacilityID=<?= $row["FacilityID"] ?>">Edit</a>
        &nbsp;
        <a href="./facility-d.php?FacilityID=<?= $row["FacilityID"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
<br>

<h2>List of Educational Facilities</h2>
<form action="./edfacility-r-one.php" method="get">
  Search Educational Facility by ID: <input type="text" name="FacilityID">
  <input type="submit">
</form><br>
    <a href="./edfacility-create.php">Create an Educational Facility</a><br><br>
    <table>
        <thead>
            <tr>
                <th>FacilityID</th>
                <th>Name</th>
                <th>PrincipalName</th>
                <th>WebAddress</th>
                <th>Capacity</th>
                <th>PostalCode</th>
                <th>PhoneNumber</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $edfacility->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["FacilityID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["PrincipalName"] ?></td>
                <td><?= $row["WebAddress"] ?></td>
                <td><?= $row["Capacity"] ?></td>
                <td><?= $row["PostalCode"] ?></td>
                <td><?= $row["PhoneNumber"] ?></td>
                <td>
                    <a href="./edfacility-edit.php?FacilityID=<?=$row["FacilityID"] ?>">Edit</a>&nbsp;
                    <a href="./edfacility-d.php?FacilityID=<?=$row["FacilityID"] ?>">Delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>

    <h3>List of Primary Schools</h3>
    <form action="./psfacility-r-one.php" method="post">
    Search Primary School by ID: <input type="text" name="FacilityID">
    <input type="submit">
    </form><br>
    <a href="./psfacility-create.php">Create a Primary School Facility</a><br><br>
    <table>
        <thead>
            <tr>
                <th>FacilityID</th>
                <th>Name</th>
                <th>PrincipalName</th>
                <th>WebAddress</th>
                <th>Capacity</th>
                <th>PostalCode</th>
                <th>PhoneNumber</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $psfacility->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["FacilityID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["PrincipalName"] ?></td>
                <td><?= $row["WebAddress"] ?></td>
                <td><?= $row["Capacity"] ?></td>
                <td><?= $row["PostalCode"] ?></td>
                <td><?= $row["PhoneNumber"] ?></td>
                <td>
                    <a href="./psfacility-edit.php?FacilityID=<?=$row["FacilityID"] ?>">Edit</a>&nbsp;
                    <a href="./psfacility-d.php?FacilityID=<?=$row["FacilityID"] ?>">Delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>

    <h3>List of Middle schools</h3>
    <form action="./msfacility-r-one.php" method="post">
    Search Middle School by ID: <input type="text" name="FacilityID">
    <input type="submit">
    </form><br>
    <a href="./msfacility-create.php">Create a Middle school</a><br><br>
    <table>
        <thead>
            <tr>
                <th>FacilityID</th>
                <th>Name</th>
                <th>PrincipalName</th>
                <th>WebAddress</th>
                <th>Capacity</th>
                <th>PostalCode</th>
                <th>PhoneNumber</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $msfacility->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["FacilityID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["PrincipalName"] ?></td>
                <td><?= $row["WebAddress"] ?></td>
                <td><?= $row["Capacity"] ?></td>
                <td><?= $row["PostalCode"] ?></td>
                <td><?= $row["PhoneNumber"] ?></td>
                <td>
                    <a href="./msfacility-edit.php?FacilityID=<?=$row["FacilityID"] ?>">Edit</a>&nbsp;
                    <a href="./msfacility-d.php?FacilityID=<?=$row["FacilityID"] ?>">Delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>

    <h3>List of Highschools</h3>
    <form action="./hsfacility-r-one.php" method="post">
    Search HighSchool by ID: <input type="text" name="FacilityID">
    <input type="submit">
    </form><br>
    <a href="./hsfacility-create.php">Create a Highschool</a><br><br>
    <table>
        <thead>
            <tr>
                <th>FacilityID</th>
                <th>Name</th>
                <th>PrincipalName</th>
                <th>WebAddress</th>
                <th>Capacity</th>
                <th>PostalCode</th>
                <th>PhoneNumber</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $hsfacility->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["FacilityID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["PrincipalName"] ?></td>
                <td><?= $row["WebAddress"] ?></td>
                <td><?= $row["Capacity"] ?></td>
                <td><?= $row["PostalCode"] ?></td>
                <td><?= $row["PhoneNumber"] ?></td>
                <td>
                    <a href="./hsfacility-edit.php?FacilityID=<?=$row["FacilityID"] ?>">Edit</a> &nbsp;
                    <a href="./hsfacility-d.php?FacilityID=<?=$row["FacilityID"] ?>">Delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>

<h2>List of Management Facilities</h2>
<form action="./mafacility-r-one.php" method="post">
  Search Management Facility by ID: <input type="text" name="FacilityID">
  <input type="submit">
</form>
<br>
    <a href="./mafacility-create.php">Create a Management Facility</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>FacilityID</th>
                <th>Name</th>
                <th>PresidentName</th>
                <th>WebAddress</th>
                <th>Capacity</th>
                <th>PostalCode</th>
                <th>PhoneNumber</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $mafacility->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["FacilityID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["PresidentName"] ?></td>
                <td><?= $row["WebAddress"] ?></td>
                <td><?= $row["Capacity"] ?></td>
                <td><?= $row["PostalCode"] ?></td>
                <td><?= $row["PhoneNumber"] ?></td>
                <td>
                    <a href="./mafacility-edit.php?FacilityID=<?=$row["FacilityID"] ?>">Edit</a>&nbsp;
                    <a href="./mafacility-d.php?FacilityID=<?=$row["FacilityID"] ?>">Delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>

    <h3>List of Head Office Facilities</h3>
    <form action="./hofacility-r-one.php" method="post">
    Search Head Office Facility by ID: <input type="text" name="FacilityID">
    <input type="submit">
    </form><br>
    <a href="./hofacility-create.php">Create a Head Office Facility</a><br><br>
    <table>
        <thead>
            <tr>
                <th>FacilityID</th>
                <th>Name</th>
                <th>PresidentName</th>
                <th>WebAddress</th>
                <th>Capacity</th>
                <th>PostalCode</th>
                <th>PhoneNumber</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $hofacility->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["FacilityID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["PresidentName"] ?></td>
                <td><?= $row["WebAddress"] ?></td>
                <td><?= $row["Capacity"] ?></td>
                <td><?= $row["PostalCode"] ?></td>
                <td><?= $row["PhoneNumber"] ?></td>
                <td>
                    <a href="./hofacility-edit.php?FacilityID=<?=$row["FacilityID"] ?>">Edit</a> &nbsp;
                    <a href="./hofacility-d.php?FacilityID=<?=$row["FacilityID"] ?>">Delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>

    <h3>List of General Management Facilities</h3>
    <form action="./gmfacility-r-one.php" method="post">
    Search General Management Facility by ID: <input type="text" name="FacilityID">
    <input type="submit">
    </form><br>
    <a href="./gmfacility-create.php">Create a General Management Facility</a><br><br>
    <table>
        <thead>
            <tr>
                <th>FacilityID</th>
                <th>Name</th>
                <th>PresidentName</th>
                <th>WebAddress</th>
                <th>Capacity</th>
                <th>PostalCode</th>
                <th>PhoneNumber</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $gmfacility->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
            <tr>
                <td><?= $row["FacilityID"] ?></td>
                <td><?= $row["Name"] ?></td>
                <td><?= $row["PresidentName"] ?></td>
                <td><?= $row["WebAddress"] ?></td>
                <td><?= $row["Capacity"] ?></td>
                <td><?= $row["PostalCode"] ?></td>
                <td><?= $row["PhoneNumber"] ?></td>
                <td>
                    <a href="./gmfacility-edit.php?FacilityID=<?=$row["FacilityID"] ?>">Edit</a>
                    <a href="./gmfacility-d.php?FacilityID=<?=$row["FacilityID"] ?>">Delete</a>
                </td>
            </tr>
       <?php } ?>
        </tbody>
    </table>


<?php

/*
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
*/
?>
