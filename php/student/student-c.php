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

$sql = "INSERT INTO Persons (MedicareCardNumber, FirstName, LastName, MedicareExpiryDate
, DateOfBirth, TelephoneNumber, Citizenship, PostalCode, EmailAddress)
VALUES(:medicareCardNumber,:firstName,:lastName,:medicareExpiryDate,:dateOfBirth,
:telephoneNumber,:citizenship,:postalcode,:emailAddress);";

//echo "SQL Query: <br>" . $sql;

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


  // Execute the prepared statement
  $query->execute();
  echo "New Person record created successfully";


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
  goto break_free_of_try;
}

try {

  $sql = "INSERT INTO Students(MedicareCardNumber, CurrentLevel)
  VALUES(:MedicareCardNumber, :currentLevel);";
  
  //echo "SQL Query: <br>" . $sql;
  
      $query = $conn->prepare($sql);
  
      // Bind parameters to statement
      $query->bindParam(':medicareCardNumber', $_REQUEST['medicareCardNumber']);
      $query->bindParam(':currentLevel', $_REQUEST['currentLevel']);
  
  
    // Execute the prepared statement
    $query->execute();
    echo "New Student record created successfully";
  
  
} catch(PDOException $e) {
    echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
    goto break_free_of_try;
}

try {

  $sql = "INSERT INTO Addresses_Persons(PostalCode, Province, `Address`, City)
  VALUES(:postalCode, :province, :adress, :city);";
  
  //echo "SQL Query: <br>" . $sql;
  
      $query = $conn->prepare($sql);
  
      // Bind parameters to statement
      $query->bindParam(':postalCode', $_REQUEST['postalCode']);
      $query->bindParam(':province', $_REQUEST['province']);
      $query->bindParam(':adress', $_REQUEST['adress']);
      $query->bindParam(':city', $_REQUEST['city']);
  
  
    // Execute the prepared statement
    $query->execute();
    echo "New Address_Person's record created successfully";
  
  
} catch(PDOException $e) {
    echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
    goto break_free_of_try;
}
break_free_of_try:

//close connection once done
$conn = null;
//call main php page
require_once("index.php");
?>