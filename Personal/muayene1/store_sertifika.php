<?php
include '../db.php';

$workerId = $_POST['WorkerId'];
$certificateNameId = $_POST['CertificateNameId'];
$addDate = date('Y-m-d H:i:s');
$updateDateTime = $addDate;

$sql = "INSERT INTO sertifikalar (WorkerId, CertificateNameId, AddDate, UpdateDateTime, IsActive) 
        VALUES ('$workerId', '$certificateNameId', '$addDate', '$updateDateTime', 1)";

if ($conn->query($sql) === TRUE) {
    echo "Sertifika başarıyla eklendi.";
    header('Location: sertifika_index.php');
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
