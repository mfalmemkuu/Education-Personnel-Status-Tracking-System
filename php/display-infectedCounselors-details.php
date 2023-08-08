<br><h2>Counselors who have been infected 3 times:</h2>

<?php
require_once './database.php';

$sql = "SELECT 
t.MedicareCardNumber,
t.Level,
t.Specialisation,
p.FirstName,
p.LastName,
p.DateOfBirth,
p.EmailAddress,
COALESCE(ts.TotalScheduledHours, 0) AS TotalScheduledHours
FROM 
Teachers t
INNER JOIN 
Persons p ON t.MedicareCardNumber = p.MedicareCardNumber
LEFT JOIN (
SELECT 
    w.MedicareCardNumber,
    SUM(TIMESTAMPDIFF(HOUR, s.StartTime, s.EndTime)) AS TotalScheduledHours
FROM 
    Works_At w
INNER JOIN 
    Schedule s ON w.StartDate <= s.Date AND (w.EndDate IS NULL OR w.EndDate >= s.Date)
GROUP BY 
    w.MedicareCardNumber
) AS ts ON t.MedicareCardNumber = ts.MedicareCardNumber
WHERE 
t.MedicareCardNumber IN (
    SELECT MedicareCardNumber
    FROM Infections
    GROUP BY MedicareCardNumber
    HAVING COUNT(*) >= 3
)
AND t.Specialisation = 'counselor'
ORDER BY 
t.Level ASC,
p.FirstName ASC,
p.LastName ASC;";

$stmt = $conn->prepare($sql);  
  

$stmt->execute();

?>

<br>
<table>
  <thead>
      <tr>
        <th>MedicareCardNumber</th>        
        <th>Teaching Level</th>
        <th>Specialization</th>
        <th>FirstName</th>
        <th>LastName</th>
        <th>DateOfBirth</th>
        <th>EmailAddress</th>
        <th>TotalScheduledHours</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["MedicareCardNumber"] ?></td>      
      <td><?= $row["Level"] ?></td>
      <td><?= $row["Specialisation"] ?></td>
      <td><?= $row["FirstName"] ?></td>
      <td><?= $row["LastName"] ?></td>
      <td><?= $row["DateOfBirth"] ?></td>
      <td><?= $row["EmailAddress"] ?></td>
      <td><?= $row["TotalScheduledHours"] ?></td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    

<?php
/*
echo "<br><h3>Counselors who have been infected 3 times:</h3>";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>MedicareCardNumber</th><th>Role</th><th>Specialisation</th><th>FirstName</th><th>LastName</th><th>DateOfBirth</th><th>EmailAddress</th><th>TotalScheduledHours</th></tr>";

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
    $sql = "SELECT t.MedicareCardNumber, t.Level, t.Specialisation, p.FirstName, p.LastName, p.DateOfBirth, p.EmailAddress,
    COALESCE(ts.TotalScheduledHours, 0) AS TotalScheduledHours
    FROM Teachers t
    INNER JOIN Persons p ON t.MedicareCardNumber = p.MedicareCardNumber
    LEFT JOIN (
        SELECT 
        w.MedicareCardNumber,
        SUM(TIMESTAMPDIFF(HOUR, s.StartTime, s.EndTime)) AS TotalScheduledHours
        FROM Works_at w
        INNER JOIN Schedule s ON w.StartDate <= s.Date AND (w.EndDate IS NULL OR w.EndDate >= s.Date)
        GROUP BY w.MedicareCardNumber
      ) AS ts ON t.MedicareCardNumber = ts.MedicareCardNumber
    WHERE t.MedicareCardNumber IN (
        SELECT MedicareCardNumber
        FROM Infections
        GROUP BY MedicareCardNumber
        HAVING COUNT(*) >= 3
    )
    ORDER BY t.Level ASC, p.FirstName ASC, p.LastName ASC;";
    

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
