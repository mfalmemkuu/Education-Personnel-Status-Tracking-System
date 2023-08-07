<?php
require_once '../database.php';


$sql = 'SELECT i.MedicareCardNumber, i.Date, i.Type  FROM Infections i;';

$stmt = $conn->prepare($sql);  
    

$stmt->execute();

?>
<!-- search for input 
<form action="NEW FILE">
  Search: <input type="text" >
</form>
-->
<br>
<table>
  <thead>
      <tr>
        <th>MedicareCardNumber</th>        
        <th>Vaccination Date</th>
        <th>Vaccination Type</th>
        <th>Actions</th>
  </thead>
  <tbody>
    <?php  while($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
    <tr>
      <td><?= $row["MedicareCardNumber"] ?></td>      
      <td><?= $row["Date"] ?></td>
      <td><?= $row["Type"] ?></td>
      <td>
        <a href="./edit-view.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Edit</a>&nbsp;
        <a href="./infection-d.php?MedicareCardNumber=<?= $row["MedicareCardNumber"] ?>">Delete</a>
      </td>
    </tr>
    <?php  } ?>
  </tbody>
</table>
    <br>
    

<?php
/*

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>MedicareCardNumber</th><th>InfectionDate</th><th>InfectionType</th></tr>";

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
    echo '<td><a href="./edit-view.php?medicareCardNumber='. parent::current() .'">Edit</a> ';
    echo '<a href="./infection-d.php?medicareCardNumber='. parent::current() .'">Delete</a></td>';
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
    $sql = "SELECT *  FROM Infections;  ";
    

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
