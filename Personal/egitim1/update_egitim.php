<?php
include '../db.php';

if (isset($_POST['Id'])) {
    $Id = $_POST['Id'];
    $WorkerId = $_POST['WorkerId'];
    $EducationId = $_POST['EducationId'];
    $EducationDate = $_POST['EducationDate'];
    $UpdateDateTime = date('Y-m-d H:i:s');

    $sql = "UPDATE egitimler SET WorkerId='$WorkerId', EducationId='$EducationId', EducationDate='$EducationDate', UpdateDateTime='$UpdateDateTime' WHERE Id=$Id";

    if ($conn->query($sql) === TRUE) {
        echo "Eğitim kaydı başarıyla güncellendi";
        header('Location: ../kalite_index.php');
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Eğitim Id bulunamadı veya geçerli değil.";
}

$conn->close();
?>
