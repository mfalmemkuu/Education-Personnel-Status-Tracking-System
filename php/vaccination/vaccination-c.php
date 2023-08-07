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

$sql = "INSERT INTO Vaccinations(MedicareCardNumber, `Date`, `Type`, DoseNumber)
VALUES(:medicareCardNumber, :vaccineDate, :vaccineType ,:doseNumber);";

//echo "SQL Query: <br>" . $sql;

    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':medicareCardNumber', $_REQUEST['medicareCardNumber']);
    $query->bindParam(':vaccineDate', $_REQUEST['vaccineDate']);
    $query->bindParam(':vaccineType', $_REQUEST['vaccineType']);
    $query->bindParam(':doseNumber', $_REQUEST['doseNumber']);


  // Execute the prepared statement
  $query->execute();

  if($query->rowCount() == 0 ) {
    echo "Could not update data <br>";
    //TODO: LIST CONSTRAINTS AND DATA TYPES HERE
    goto break_free_of_try;
  } 

  echo "New Vaccination record created successfully";


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
  goto break_free_of_try;
}
break_free_of_try:

//close connection once done
$conn = null;
?>