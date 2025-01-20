<?php
include '../db.php';

$WorkerId = $_POST['WorkerId'];
$EducationId = $_POST['EducationId'];
$EducationDate = $_POST['EducationDate'];
$AddDate = date('Y-m-d H:i:s');
$UpdateDateTime = $AddDate;
$IsActive = 1; 

$sql = "INSERT INTO egitimler (WorkerId, EducationId, EducationDate, AddDate, UpdateDateTime, IsActive) 
        VALUES ('$WorkerId', '$EducationId', '$EducationDate', '$AddDate', '$UpdateDateTime', '$IsActive')";

if ($conn->query($sql) === TRUE) {
    echo "Eğitim kaydı başarıyla eklendi";
    header('Location: ../kalite_index.php'); 
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>



