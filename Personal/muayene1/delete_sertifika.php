<?php
include '../db.php';

$id = $_GET['id'];

$sql = "UPDATE sertifikalar SET IsActive = 0 WHERE Id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Sertifika başarıyla silindi.";
    header('Location: sertifika_index.php');
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>