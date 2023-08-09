<?php
/*
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
  
    $sql = "UPDATE Facilities f
    SET f.Name=:fname, f.webAddress =:webAddress, f.Capacity = :capacity,
    f.PostalCode=:postalCode, f.PhoneNumber =:phoneNumber
    WHERE f.FacilityID =:facilityID;    ";
    
    echo "SQL Query: <br>" . $sql;

    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':facilityID', $_REQUEST['facilityID']);
    $query->bindParam(':fname', $_REQUEST['fname']);
    $query->bindParam(':capacity', $_REQUEST['capacity']);
    $query->bindParam(':PostalCode', $_REQUEST['PostalCode']);
    $query->bindParam(':phoneNumber', $_REQUEST['phoneNumber']);
    $query->bindParam(':webaddress', $_REQUEST['webaddress']);

    $id = $_REQUEST['facilityID'];

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
  
    echo "Facility Record UPDATED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_of_try:

//close connection once done
$conn = null;
//call main php page
require_once("index.php");*/
?>