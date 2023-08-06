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
  
    $sql = "UPDATE Students s
    SET S.CurrentLevel = :currentLevel
    WHERE S.MedicareCardNumber = :MedicareCardNumber;";
    
    echo "SQL Query: <br>" . $sql;

    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':medicareCardNumber', $_REQUEST['medicareCardNumber']);
      $query->bindParam(':currentLevel', $_REQUEST['currentLevel']);

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
  
    echo "Student Record UPDATED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}

try {
  
    $sql = "UPDATE Persons p
    SET p.FirstName =:FirstName,
    p.LastName =:LastName , p.DateOfBirth =:DateOfBirth,
    p.TelephoneNumber =:TelephoneNumber, p.Citizenship =:Citizenship, p.PostalCode =:PostalCode,
    p.EmailAddress =:EmailAddress
    WHERE p.MedicareCardNumber = :medicareCardNumber;";
    
    echo "SQL Query: <br>" . $sql;

    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':medicareCardNumber', $_REQUEST['medicareCardNumber']);
    $query->bindParam(':firstname', $_REQUEST['firstname']);
    $query->bindParam(':lastname', $_REQUEST['lastname']);
    $query->bindParam(':medicareExpiryDate', $_REQUEST['medicareExpiryDate']);
    $query->bindParam(':dateOfBirth', $_REQUEST['dateOfBirth']);
    $query->bindParam(':telephoneNumber', $_REQUEST['telephoneNumber']);
    $query->bindParam(':citizenship', $_REQUEST['citizenship']);
    $query->bindParam(':postalCode', $_REQUEST['postalCode']);
    $query->bindParam(':email', $_REQUEST['email']);

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
  
    echo "Person Record UPDATED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_of_try:

//close connection once done
$conn = null;
//call main php page
require_once("index.php");
?>