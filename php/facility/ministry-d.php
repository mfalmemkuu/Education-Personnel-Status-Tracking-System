<?php
require_once '../database.php';
$statement = $conn->prepare('DELETE FROM Ministries 
WHERE MinistryID=:MinistryID;');
$statement->bindParam('MinistryID',$_GET["MinistryID"]);
if($statement->execute()) {
    header("Location: ./index.php");
}
else {
    echo "error deleting ministry.";
}

?>