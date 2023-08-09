<!DOCTYPE html>
<html>
<body>
<br>
<hr>
<br>
<a href="./index.php">Homepage</a>
<h1>Main Project - Group kdc353_1</h1>
<br>
<br>

<h3>1- Create/Delete/Edit/Display a Facility</h3>
<a href="/facility">CRUD Operations on Facilities</a><br><br>

<h3>2- Create/Delete/Edit/Display a Student </h3>
<a href="/student">CRUD Operations on Students</a><br><br>

<h3>3- Create/Delete/Edit/Display an Employee</h3>
<a href="/employee">CRUD Operations on Employees</a><br><br>

<h3>4- Create/Delete/Edit/Display a Vaccination</h3>
<a href="/vaccination">CRUD Operations on Vaccinations</a><br><br>

<h3>5- Create/Delete/Edit/Display an Infection</h3>
<a href="/infection">CRUD Operations on Infections</a><br><br>

<h3>6- Register/Modify registration/Cancel registration for a student in a school</h3>
<a href="/registration">CRUD Operations on Registrations</a><br><br>

<h3>7- Assign/Delete/Edit Schedule for an Employee</h3>
<a href="/schedule">CRUD Operations on Schedules</a><br><br>


<h3>8- Get details of all the facilities in the system. </h3>
<form action="display-facilities-details.php" method ="get">
<input type="submit" value="Display Facility Details">
</form>

<h3>9- Get details of all the employees currently working in a specific facility. </h3>
<form action="employees-specific-facility.php" method="post">
Facility Name: <input type="text" name="Name"><br>
<input type="submit">
</form>

<h3>10- For a given employee, get the details of all the schedules they have been scheduled during a specific period of time.</h3>
<form action="schedules-specific-employee.php" method="post">
Employee Medicare Card Number: <input type="text" name="MedicareCardNumber"><br>
Start Date: <input type="date" name="StartTime"><br>
End Date: <input type="date" name="EndTime"><br>
<input type="submit">
</form>

<h3>11- Get details of all the teachers who have been infected by COVID-19 in the past two weeks.</h3>
<form action="display-teachers-infected.php" method ="get">
<input type="submit" value="Display Infected Teachers Details">
</form>

<h3>12- List the emails generated by a given facility.</h3>
<form action="emails-specific-facility.php" method="post">
Facility Name: <input type="text" name="Name"><br>
<input type="submit">
</form>

<h3>13- For a given facility, generate a list of all the teachers who have been on schedule to work in the last two weeks.</h3>
<form action="scheduledTeachers-specific-facility.php" method="post">
Facility Name: <input type="text" name="Name"><br>
<input type="submit">
</form>

<h3>14- For a given facility, give the total hours scheduled for every teacher during a specific period.</h3>
<form action="hoursScheduled-specific-facility.php" method ="post">
Facility Name: <input type="text" name="Name"><br>
Starting Date: <input type="date" name="StartTime"><br>
End Date: <input type="date" name="EndTime"><br>
<input type="submit">
</form>

<h3>15- For every high school, provide the province where the school is located, the
school's name, the capacity of the school, and the total number of teachers in
the school who have been infected by COVID-19 in the past two weeks, and
the number of students in the school who have been infected by COVID-19 in
the past two weeks. </h3>
<form action="display-highschoolInfection-details.php" method ="get"> 
<input type="submit" value="Display Highschool Infection Details">
</form>

<h3>16- For every ministry in the system, provide the minster's first-name, last-name,
the city of residence of the minister, and the total number of management
facilities, and the total number of educational facilities that the minister is
currently administering.</h3>
<form action="display-ministry-details.php" method ="get"> 
<input type="submit" value="Display Ministry Details">
</form>

<h3>17- Get details of the counselor(s) who are currently working and has been infected by COVID-19 at least three times.</h3>
<form action="display-infectedCounselors-details.php" method ="get"> 
<input type="submit" value="Display Counselors">
</form>

<br>
<br>
<hr> <!-- --------------------------------------------------->
<br>
<br>
<br>
<br>
<br>
<?php
require_once './database.php';


?>