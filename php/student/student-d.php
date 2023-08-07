
<?php
require_once '../database.php';

$sql = "DELETE FROM Students WHERE MedicareCardNumber =:MedicareCardNumber ; ";

$student = $conn->prepare($sql);
$student->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

if($student->execute()) {
    $sql2 = "DELETE FROM Persons WHERE MedicareCardNumber =:MedicareCardNumber;";
    $person = $conn->prepare($sql2);
    $person->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);
    if ($person->execute()) {
        header("Location: ./index.php");
    }else {
        echo "Error deleting person.";
    }
}
else {
    echo "Error deleting student.";
}

?>

