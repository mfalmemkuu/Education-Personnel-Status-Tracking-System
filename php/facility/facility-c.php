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
    
    
    $query->bindParam(':type', $_REQUEST['type']);


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

try {
    $sql = "SELECT m.ministryID, m.name FROM Ministries m WHERE m.name = :ministryName";

    //echo "SQL Query: <br>" . $sql;

    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':ministryName', $_REQUEST['ministryName']);
    $name = $_REQUEST['ministryName'];
    
    
    // Execute the prepared statement
    $query->execute();

    if($name == null ) {
        echo "Ministry name missing.";
        goto break_free_of_try;
    } 

    $result = $query->setFetchMode(PDO::FETCH_ASSOC);
    $rowset = $query-> fetchAll();
    $ministryid = 0;
    if($rowset) {
        foreach($rowset as $row) {
            $ministryid = $row["ministryid"] ; 
        }
    }

    ///$sql = "SELECT m.ministryID, m.name FROM Ministries m WHERE m.name = :ministryName";
    /// TODO add ministry id & facility id to operates

    echo "Ministry record added successfully";
}
catch(PDOException $e) {
    echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
    goto break_free_of_try;
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
        
        
        $query->bindParam(':type', $_REQUEST['type']);
    
    
      // Execute the prepared statement
      $query->execute();
    
      if($query->rowCount() == 0 ) {
        echo "Could not update data <br>";
        //TODO: LIST CONSTRAINTS AND DATA TYPES HERE
        goto break_free_of_try;
      } 
    
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
?>