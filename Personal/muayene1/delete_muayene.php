<?php
include '../db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "UPDATE muayenekayit SET IsActive = 0 WHERE Id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Çalışan başarıyla pasif hale getirildi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Geçersiz çalışan ID'si.";
}

$conn->close();


header('Location: muayene_index.php');
exit();
?>
