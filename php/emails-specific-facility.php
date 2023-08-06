<?php
echo "<br><h3>Email Details for Specific Facility:</h3>";

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>EmailID</th><th>Subject</th><th>Sender</th><th>Receiver</th><th>Date</th><th>Body</th></tr>";

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
    $sql = "SELECT el.LogID AS 'EmailID', el.subject AS 'Subject' ,
    el.sender AS 'Sender' , el.receiver AS 'Receiver',
    el.`date` AS 'Date', el.body AS 'Body'
    FROM Email_log el, Facilities f , Email_sent es
    WHERE el.LogID = es.LogID AND es.FacilityID = f.FacilityID AND f.Name =:fname;";
    

    $stmt = $conn->prepare($sql);  
    
    $stmt->bindParam(':fname', $_REQUEST['fname']);

    $name = $_REQUEST['fname'];
    
    if($name == NULL) {
        echo "Facility name must be inputted.<br>";
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
