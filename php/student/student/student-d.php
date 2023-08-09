
<?php
require_once '../database.php';

$sql5 = "DELETE FROM Registered_At WHERE MedicareCardNumber =:MedicareCardNumber ;";

$reg_at = $conn->prepare($sql7);
$reg_at->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

if($reg_at->execute()) {

    $sql7 = "DELETE FROM Infections WHERE MedicareCardNumber =:MedicareCardNumber ;";

    $infection = $conn->prepare($sql7);
    $infection->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

    if($infection->execute()) {

        $sql6 = "DELETE FROM Vaccinations WHERE MedicareCardNumber =:MedicareCardNumber ;";

        $vaccine = $conn->prepare($sql6);
        $vaccine->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

        if($vaccine->execute()) {

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
        }else {
            echo "Error deleting vaccinations.";
        }
    } else {
        echo "Error deleting infections.";
    }
}else {
    echo "Error deleting registered_at records.";
}
?>

