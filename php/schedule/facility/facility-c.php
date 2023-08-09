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

$sql = "INSERT INTO Facilities f(f.Name, WebAddress, Capacity, PostalCode, PhoneNumber)
VALUES(:fname, :webAddress, :capacity, :postalCode, :phoneNumber);";

//echo "SQL Query: <br>" . $sql;

    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':fname', $_REQUEST['fname']);
    $query->bindParam(':capacity', $_REQUEST['capacity']);
    $query->bindParam(':PostalCode', $_REQUEST['PostalCode']);
    $query->bindParam(':phoneNumber', $_REQUEST['phoneNumber']);
    $query->bindParam(':webaddress', $_REQUEST['webaddress']);
    


  // Execute the prepared statement
  $query->execute();

  if($query->rowCount() == 0 ) {
    echo "Could not update data <br>";
    //TODO: LIST CONSTRAINTS AND DATA TYPES HERE
    goto break_free_of_try;
  } 

  echo "New facility record created successfully";


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
  goto break_free_of_try;
}

break_free_of_try:

//close connection once done
$conn = null;
?>