<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/certificate.php";

$database = new Database();
$db = $database->mysqli;

$certificate = new Certificate($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['Id'];
    $workerId = $_POST['WorkerId'];
    $certificateNameId = $_POST['CertificateNameId'];

    if ($certificate->updateCertificate($id, $workerId, $certificateNameId)) {
        echo "Sertifika başarıyla güncellendi.";
    } else {
        echo "Sertifika güncellenirken bir hata oluştu.";
    }
}
?>



