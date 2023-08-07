<?php
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
  
    $sql = "DELETE FROM Registered_at
    WHERE MedicareCardNumber = :medicareCardNumber AND FacilityID = :facilityID ; ";
    
    echo "SQL Query: <br>" . $sql;
    
    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':medicareCardNumber', $_REQUEST['medicareCardNumber']);
    $query->bindParam(':facilityID', $_REQUEST['facilityID']);
    $query->bindParam(':startDate', $_REQUEST['startDate']);
    $query->bindParam(':endDate', $_REQUEST['endDate']);
    $id = $_REQUEST['medicareCardNumber'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_of_try;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not delete data for: " . $id . "<br>";
        goto break_free_of_try;
    }
  
    echo "Registration Record DELETED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}

try {
  
    $sql = "DELETE FROM Persons WHERE MedicareCardNumber =:medicareCardNumber;";
    
    echo "SQL Query: <br>" . $sql;
    
    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':medicareCardNumber', $_REQUEST['medicareCardNumber']);
    $id = $_REQUEST['medicareCardNumber'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_of_try;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not delete data for: " . $id . "<br>";
        goto break_free_of_try;
    }
  
    echo "Person Record DELETED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_of_try:

//close connection once done
$conn = null;
//call main php page
require_once("index.php");
?>