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

$sql = "INSERT INTO Persons (medicareCardNumber, firstName, lastName, medicareExpiryDate, postalCode, emailAddress) VALUES (:medicareCardNumber, :firstname, :lastname, :medicareExpiryDate, :postalCode, :email);";

//echo "SQL Query: <br>" . $sql;

    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':medicareCardNumber', $_REQUEST['medicareCardNumber']);
    $query->bindParam(':firstname', $_REQUEST['firstname']);
    $query->bindParam(':lastname', $_REQUEST['lastname']);
    $query->bindParam(':medicareExpiryDate', $_REQUEST['medicareExpiryDate']);
    $query->bindParam(':postalCode', $_REQUEST['postalCode']);
    $query->bindParam(':email', $_REQUEST['email']);


  // Execute the prepared statement
  $query->execute();
  echo "New record created successfully";


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}

//close connection once done
$conn = null;
//call main php page
require_once("index.php");
?>