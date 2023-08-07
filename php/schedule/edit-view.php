<!DOCTYPE html>
<html>
<body>

    <h1>Edit Schedule</h1>
    <form action="schedule-u.php">
        FOR Schedule ID: <input type="text" value="<?php $_REQUEST['scheduleID']; ?>" name="scheduleID" disabled><br>
        <br>
        Date: <input type="date" name="sDate"><br>
        Start Time: <input type="date" name="startTime"><br>
        End Time: <input type="date" name="endTime"><br>
        Is the schedule cancelled? 
        <select name="isCancelled" required>
            <option value="false">No</option>
            <option value="true">Yes</option>            
        </select>
        <br>
        <input type="submit">
    </form><br>
    <a href="../schedule/index.php">Back to Schedules</a>

</body>
</html>

<?php

?>