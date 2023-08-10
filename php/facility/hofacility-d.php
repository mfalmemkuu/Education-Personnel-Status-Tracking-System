<?php
require_once '../database.php';
$statement1 = $conn->prepare('DELETE FROM Works_At 
WHERE FacilityID = :FacilityID ;');
$statement1->bindParam(':FacilityID',$_GET["FacilityID"]);

if($statement1->execute()) {    
    $statement4 = $conn->prepare("DELETE FROM HeadOfficeFacilities 
    WHERE FacilityID = :FacilityID;");
    $statement4->bindParam('FacilityID',$_GET["FacilityID"]);

    if($statement4->execute()) {
        $statement2 = $conn->prepare("DELETE FROM ManagementFacilities 
        WHERE FacilityID = :FacilityID ;");
        $statement2->bindParam(':FacilityID',$_GET["FacilityID"]);
        
        if($statement2->execute()) {
            $statement3 = $conn->prepare("DELETE FROM Facilities 
            WHERE FacilityID = :FacilityID ;");
            $statement3->bindParam(':FacilityID',$_GET["FacilityID"]);
            
            if ($statement3->execute()) {
                header("Location: ./index.php");
            } else {
                echo "error deleting from facilities.";
            }
            
        } else {
            echo "error deleting from management facilities.";
        } 
    }else {
        echo "error deleting from head office.";
    }       
}
else {
    echo "error deleting from works_at.";
}

?>