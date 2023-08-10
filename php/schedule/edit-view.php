<?php
require_once '../database.php';

$statement = $conn->prepare("SELECT s.ScheduleID, s.Date, s.StartTime, s.EndTime, hs.MedicareCardNumber, hs.FacilityID 
FROM Schedule s
INNER JOIN Has_Schedule hs ON s.ScheduleID = hs.ScheduleID
WHERE hs.ScheduleID = :ScheduleID ;");
$statement->bindParam(":ScheduleID", $_GET["ScheduleID"]);
$statement->execute();
$schedule = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["ScheduleID"]) && isset($_POST["Date"]) && isset($_POST["StartTime"]) && isset($_POST["EndTime"]) && isset($_POST["MedicareCardNumber"]) && isset($_POST["FacilityID"]) ) {

    //try {
        $schedule = $conn->prepare("UPDATE Schedule s
            SET s.Date = ':Date', s.StartTime = ':StartTime', 
            s.EndTime = ':EndTime'
            WHERE s.ScheduleID = :ScheduleID;
        ");
        
        $schedule->bindParam(':ScheduleID', $_POST["ScheduleID"]);
        $schedule->bindParam(':Date', $_POST["Date"]);
        $schedule->bindParam(':StartTime', $_POST["StartTime"]);
        $schedule->bindParam(':EndTime', $_POST["EndTime"]);
    
        if ($schedule->execute()) {
            // If the person is successfully updated, now update the student in the Students table
            $haschedule = $conn->prepare("UPDATE Has_Schedule s
                                       SET s.MedicareCardNumber = ':MedicareCardNumber', s.FacilityID = :FacilityID
                                       WHERE s.ScheduleID = :ScheduleID;
                                       ");
    
            $haschedule->bindParam(':ScheduleID', $_POST["ScheduleID"]);
            $haschedule->bindParam(':MedicareCardNumber', $_POST["MedicareCardNumber"]);
            $haschedule->bindParam(':FacilityID', $_POST["FacilityID"]);
    
            if ($haschedule->execute()) {
                header("Location: ../schedule/index.php"); // Redirect after successful update
                exit; // Terminate the script after the redirection
            } else {
                echo "Error updating has_schedule.";
            }
        } else {
            echo "Error updating schedule.";
        }
    //} catch (PDOException $e) {
    //    die("Error: " . $e->getMessage());
    //}
    
}

?>
<!DOCTYPE html>
<html>
<body>

    <h1>Edit Schedule</h1>
    <form action="edit-view.php" method="post">
        <br>
        Date: <input type="date" name="Date" id="Date" value="<?= $schedule["Date"]?>"> <br>
        Start Time: <input type="time" name="StartTime" id="StartTime" value="<?= $schedule["StartTime"]?>"> <br>
        End Time: <input type="time" name="EndTime" id="EndTime" value="<?= $schedule["EndTime"]?>"> <br>
        Employee MedicareCardNumber: <input type="text" name="MedicareCardNumber" value="<?= $schedule["MedicareCardNumber"]?>"><br>
        Facility ID: <input type="number" name="FacilityID" value="<?= $schedule["FacilityID"]?>"><br>     
        <input type="hidden" name="ScheduleID" id="ScheduleID" value="<?= $schedule["ScheduleID"]?>">
        <br>
        <input type="submit">
    </form><br>
    <a href="../schedule/index.php">Back to Schedules</a>

</body>
</html>

<?php

?>