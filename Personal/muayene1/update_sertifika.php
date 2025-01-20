<?php
include '../db.php';

$id = $_POST['id'];
$worker_id = $_POST['WorkerId'];
$certificate_name_id = $_POST['CertificateNameId'];

$sql = "SELECT AddDate FROM sertifikalar WHERE Id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$add_date = $row['AddDate'];

$update_date_time = date('Y-m-d H:i:s');

$sql = "UPDATE sertifikalar SET WorkerId='$worker_id', CertificateNameId='$certificate_name_id', AddDate='$add_date', UpdateDateTime='$update_date_time' WHERE Id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Sertifika kaydı başarıyla güncellendi";
    header('Location: sertifika_index.php');
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
