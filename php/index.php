<!DOCTYPE html>
<html>
<body>
<br>
<hr>
<br>
<h2>Main Project - Group kdc353_1</h2>
<br>
<br>

<h3>1-</h3>

<h3>2-</h3>
<a href="/student">CRUD Operations on Students</a><br><br>
<form action="display-students.php">
<input type="submit" value="Display All Students">
</form>
<div id="displayStudents"></div>

<hr>
sample crud operations (TO DELETE)

<h3>insert</h3>
<form action="insert-ex.php">
FirstName: <input type="text" name="firstname"><br>
LastName: <input type="text" name="lastname"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>

<br>
<br>
<h3>read</h3>
<form action="display-ex.php">
<input type="submit" value="Display Table">
</form>

<br>
<br>
<h3>update</h3>
<form action="update-ex.php">
FOR ID: <input type="text" name="id"><br>
FirstName: <input type="text" name="firstname"><br>
LastName: <input type="text" name="lastname"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>

<br>
<br>
<h3>delete</h3>
<form action="delete-ex.php">
FOR ID: <input type="text" name="id"><br>
<input type="submit">
<br>
<br>

</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}




?>