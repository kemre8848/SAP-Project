<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/certificate.php";

$certificate = new Certificate($db);

$calisanlar = $certificate->getAllWorkers();
$sertifika_turleri = $certificate->getAllCertificateTypes();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['WorkerId']) && isset($_POST['CertificateNameId'])){
        
        $workerId = $_POST['WorkerId'];
        $certificateNameId = $_POST['CertificateNameId'];
        $certificate->createCertificate($workerId, $certificateNameId);

        header('Location: index.php');
        exit;
    }
}


?>