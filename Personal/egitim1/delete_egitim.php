<?php
include '../db.php';

$id = $_GET['id'];

$sql = "UPDATE egitimadlari SET IsActive = 0 WHERE Id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Eğitim kaydı başarıyla silindi";
    header('Location: index.php'); 
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>