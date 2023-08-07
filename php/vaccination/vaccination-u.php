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
  
    $sql = "UPDATE Vaccinations v
    SET v.`Date` = :vaccineDate, v.`Type` = :vaccineType, v.DoseNumber =:doseNumber
    WHERE v.MedicareCardNumber = :medicareCardNumber;
    ";
    
    echo "SQL Query: <br>" . $sql;

    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':medicareCardNumber', $_REQUEST['medicareCardNumber']);
    $query->bindParam(':vaccineDate', $_REQUEST['vaccineDate']);
    $query->bindParam(':vaccineType', $_REQUEST['vaccineType']);
    $query->bindParam(':doseNumber', $_REQUEST['doseNumber']);

    $id = $_REQUEST['medicareCardNumber'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_of_try;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not update data for: " . $id . "<br>";
        //TODO: LIST CONSTRAINTS AND DATA TYPES HERE
        goto break_free_of_try;
    }
  
    echo "Vaccination Record UPDATED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_of_try:

//close connection once done
$conn = null;
//call main php page
require_once("index.php");
?>