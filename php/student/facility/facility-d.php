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
  
    $sql = "DELETE FROM PrimarySchools WHERE FacilityID = :facilityID ; ";
    
    echo "SQL Query: <br>" . $sql;
    
    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':facilityID', $_REQUEST['facilityID']);
    $id = $_REQUEST['facilityID'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_before_ms;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not delete data for: " . $id . " in PrimarySchools<br>";
        goto break_free_before_ms;
    }
  
    echo "PrimarySchools Record DELETED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_before_ms:

try {
  
    $sql = "DELETE FROM MiddleSchools WHERE FacilityID = :facilityID ;    ";
    
    echo "SQL Query: <br>" . $sql;
    
    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':facilityID', $_REQUEST['facilityID']);
    $id = $_REQUEST['facilityID'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_before_hs;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not delete data for: " . $id . " in MiddleSchools<br>";
        goto break_free_before_hs;
    }
  
    echo "MiddleSchools Record DELETED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_before_hs:

try {
  
    $sql = "DELETE FROM HighSchools WHERE FacilityID = :facilityID ;";
    
    echo "SQL Query: <br>" . $sql;
    
    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':facilityID', $_REQUEST['facilityID']);
    $id = $_REQUEST['facilityID'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_before_hof;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not delete data for: " . $id . " in HighSchools<br>";
        goto break_free_before_hof;
    }
  
    echo "HighSchools Record DELETED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_before_hof:

try {
  
    $sql = "DELETE FROM HeadOfficeFacilities WHERE FacilityID = :facilityID ;    ";
    
    echo "SQL Query: <br>" . $sql;
    
    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':facilityID', $_REQUEST['facilityID']);
    $id = $_REQUEST['facilityID'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_before_gmf;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not delete data for: " . $id . " in HeadOfficeFacilities<br>";
        goto break_free_before_gmf;
    }
  
    echo "HeadOfficeFacilities Record DELETED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_before_gmf:

try {
  
    $sql = "DELETE FROM GeneralManagementFacilities WHERE FacilityID = :facilityID;";
    
    echo "SQL Query: <br>" . $sql;
    
    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':facilityID', $_REQUEST['facilityID']);
    $id = $_REQUEST['facilityID'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_before_mf;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not delete data for: " . $id . " in GeneralManagementFacilities<br>";
        goto break_free_before_mf;
    }
  
    echo "GeneralManagementFacilities Record DELETED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_before_mf:

try {
  
    $sql = "DELETE FROM ManagementFacilities WHERE FacilityID = :facilityID ; ";
    
    echo "SQL Query: <br>" . $sql;
    
    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':facilityID', $_REQUEST['facilityID']);
    $id = $_REQUEST['facilityID'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_before_ef;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not delete data for: " . $id . "in ManagementFacilities<br>";
        goto break_free_before_ef;
    }
  
    echo "ManagementFacilities Record DELETED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_before_ef:

try {
  
    $sql = "DELETE FROM EducationalFacilities WHERE FacilityID = :facilityID ; ";
    
    echo "SQL Query: <br>" . $sql;
    
    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':facilityID', $_REQUEST['facilityID']);
    $id = $_REQUEST['facilityID'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_before_operates;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not delete data for: " . $id . "in EducationalFacilities<br>";
        goto break_free_before_operates;
    }
  
    echo "EducationalFacilities Record DELETED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_before_operates:

try {
  
    $sql = "DELETE FROM Operates WHERE facilityID = :facilityID;";
    
    echo "SQL Query: <br>" . $sql;
    
    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':facilityID', $_REQUEST['facilityID']);
    $id = $_REQUEST['facilityID'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_before_facilities;;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not delete data for: " . $id . "in Operates<br>";
        goto break_free_before_facilities;
    }
  
    echo "Operates Record DELETED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}
break_free_before_facilities:

try {
  
    $sql = "DELETE FROM Facilities f WHERE f.facilityID = :facilityID; ";
    
    echo "SQL Query: <br>" . $sql;
    
    // Prepare statement
    $query = $conn->prepare($sql);

    // Bind parameters to statement
    $query->bindParam(':facilityID', $_REQUEST['facilityID']);
    $id = $_REQUEST['facilityID'];

    if($id == null) {
        echo "ID must be inputted.<br>";
        goto break_free_of_try;
    }
    // Execute the prepared statement
    $query->execute();

    //echo $query->rowCount();
            
    if($query->rowCount() == 0 ) {
        echo "Could not delete data for: " . $id . "in Facilities<br>";
        goto break_free_of_try;
    }
  
    echo "Facility Record DELETED successfully"; 


} catch(PDOException $e) {
  echo "ERROR: Could not execute " . $sql . "<br>" . $e->getMessage();
}


break_free_of_try:

//close connection once done
$conn = null;
//call main php page
require_once("index.php");
?>