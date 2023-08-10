<?php
require_once '../database.php';

$sql = "DELETE FROM Has_Schedule WHERE ScheduleID =:ScheduleID ; ";

$haschedule = $conn->prepare($sql);
$haschedule->bindParam(':ScheduleID', $_GET['ScheduleID']);

if($haschedule->execute()) {
    $schedule = $conn->prepare("UPDATE Schedule s
            SET s.isCancelled = true
            WHERE s.ScheduleID = :ScheduleID;
        ");
        
    $schedule->bindParam(':ScheduleID', $_POST["ScheduleID"]);

    if($schedule->execute()) {
        header("Location: ./index.php");
    }    
    else {
        echo "error updating IsCancelled to true";
    }
}
else {
    echo "Error deleting has_schedule.";
}

?>

<!--deletes has_schedule record and set iscancelled to true -->