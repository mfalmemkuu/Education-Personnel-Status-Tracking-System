<?php
require_once '../database.php';
$statement = $conn->prepare('DELETE FROM Ministries WHERE MinistryID=:MinistryID;');
$statement->bindParam('MinistryID',$_GET["MinistryID"]);
$statement->execute();
header("Location: showfacility.php");
?>