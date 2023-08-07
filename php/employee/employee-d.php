
<?php
require_once '../database.php';
/*
$sql8 = "UPDATE ManagementFacilities mf
SET mf.PresidentMedicareNumber = NULL
WHERE mf.PresidentMedicareNumber = :MedicareCardNumber;"; //xhxy87004970

$mgf = $conn->prepare($sql8);
$id = $_GET['MedicareCardNumber'];
$mgf->bindParam(':PresidentMedicareNumber', $_GET['MedicareNumber']);

if($mgf->execute()) {
*/
    $sql7 = "DELETE FROM Infections WHERE MedicareCardNumber =:MedicareCardNumber ;";

    $infection = $conn->prepare($sql7);
    $infection->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

    if($infection->execute()) {

        $sql6 = "DELETE FROM Vaccinations WHERE MedicareCardNumber =:MedicareCardNumber ;";

        $vaccine = $conn->prepare($sql6);
        $vaccine->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

        if($vaccine->execute()) {

            $sql5 = "DELETE FROM Has_Schedule WHERE MedicareCardNumber =:MedicareCardNumber ;";

            $haschedule = $conn->prepare($sql5);
            $haschedule->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

            if($haschedule->execute()) {

                $sql3 = "DELETE FROM Works_At WHERE MedicareCardNumber =:MedicareCardNumber ;";

                $worksat = $conn->prepare($sql3);
                $worksat->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

                if($worksat->execute()) {

                    $sql4 = "DELETE FROM Teachers WHERE MedicareCardNumber =:MedicareCardNumber ;";
                    $teachers = $conn->prepare($sql4);
                    $teachers->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

                    if($teachers->execute()) {

                        $sql = "DELETE FROM Employees WHERE MedicareCardNumber =:MedicareCardNumber ; ";

                        $employee = $conn->prepare($sql);
                        $employee->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);

                        if($employee->execute()) {
                            $sql2 = "DELETE FROM Persons WHERE MedicareCardNumber =:MedicareCardNumber;";
                            $person = $conn->prepare($sql2);
                            $person->bindParam(':MedicareCardNumber', $_GET['MedicareCardNumber']);
                            if ($person->execute()) {
                                header("Location: ./index.php");
                            }else {
                                echo "Error deleting person.";
                            }
                        }else {
                            echo "Error deleting employee.";
                        }    
                    }else {
                        echo "Error deleting teacher.";
                    }
                }else{
                    echo "Error deleting works-at records.";
                }
            }else {
                echo "Error deleting has-schedule records.";
            }
        }else {
            echo "Error deleting vaccination records.";
        }
    }else {
        echo "Error deleting infection records.";
    }/*
}else {
    echo "Error updating management facilities.";
}*/
?>

