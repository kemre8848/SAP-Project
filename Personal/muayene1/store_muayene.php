<?php
include '../db.php';

$worker_id = $_POST['WorkerId'];
$examination_date = $_POST['ExaminationDate'];
$examination_type_id = $_POST['ExaminationTypeId'];
$results = $_POST['Results'];


$sql = "INSERT INTO muayenekayit (WorkerId, ExaminationDate, ExaminationTypeId, Results, AddDate, UpdateDateTime, IsActive) 
        VALUES ('$worker_id', '$examination_date', '$examination_type_id', '$results', NOW(), NOW(), 1)";

if ($conn->query($sql) === TRUE) {
    echo "Yeni muayene kaydı başarıyla eklendi";
    header('Location: muayene_index.php');
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
