<?php require_once '../database.php';

$statement = $conn->prepare("SELECT s.ScheduleID, hs.MedicareCardNumber, hs.FacilityID
FROM Schedule s
LEFT JOIN Has_Schedule hs ON s.ScheduleID = hs.ScheduleID
WHERE hs.ScheduleID = :ScheduleID ;");
$statement->bindParam(':ScheduleID', $_GET["ScheduleID"]);
//echo "here: " . $statement->fetch();
$statement->execute();
$schedule = $statement->fetch(PDO::FETCH_ASSOC);

try {
    if(isset($_POST["ScheduleID"]) && isset($_POST["MedicareCardNumber"]) && isset($_POST["FacilityID"]) ){
        $query = $conn->prepare("INSERT INTO Has_Schedule(ScheduleID, MedicareCardNumber, FacilityID)
        VALUES (:ScheduleID, :MedicareCardNumber, :FacilityID);
        ");
        $query->bindParam(':ScheduleID',$_POST["ScheduleID"]);
        $query->bindParam(':MedicareCardNumber',$_POST["MedicareCardNumber"]);
        $query->bindParam(':FacilityID',$_POST["FacilityID"]);

        if($query->execute()) {
            $schedule = $conn->prepare("UPDATE Schedule s
            SET s.IsCancelled = false
            WHERE s.ScheduleID = :ScheduleID;"); //set schedule to not cancelled if it's assigned.

            $schedule->bindParam(':ScheduleID',$_POST["ScheduleID"]);

            if($schedule->execute()) {
                header("Location: ./index.php");
            }           
        }        
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<body>

    <h1>Assign Schedule to Employee</h1>
    <form action="create-view.php" method="post">
        FacilityID: <input type="number" name="FacilityID"><br>
        Employee MedicareCardNumber: <input type="text" name="MedicareCardNumber"><br>
        <br>
        <input type="hidden" name="ScheduleID" id="ScheduleID" value="<?= $schedule["ScheduleID"]?>">
        <input type="submit">
    </form><br>
    <a href="../schedule/index.php">Back to Schedules</a>

</body>
</html>

<?php

?>