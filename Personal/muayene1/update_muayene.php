<?php
include '../db.php';


$id = $_POST['id'];
$worker_id = $_POST['WorkerId'];
$examination_date = $_POST['ExaminationDate'];
$examination_type_id = $_POST['ExaminationTypeId'];
$results = $_POST['Results'];
$update_date_time = date("Y-m-d H:i:s");


$sql = "UPDATE muayenekayit 
        SET WorkerId = '$worker_id', 
            ExaminationDate = '$examination_date', 
            ExaminationTypeId = '$examination_type_id', 
            Results = '$results',
            UpdateDateTime = '$update_date_time' 
        WHERE Id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Muayene kaydı başarıyla güncellendi";
    header('Location: muayene_index.php');
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>