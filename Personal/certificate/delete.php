<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/certificate.php";

$database = new Database();
$db = $database->mysqli;

$certificate = new Certificate($db); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    if ($certificate->deleteCertificate($delete_id)) {
        echo "Sertifika başarıyla silindi.";
    } else {
        echo "Sertifika silinirken bir hata oluştu.";
    }
}
?>


