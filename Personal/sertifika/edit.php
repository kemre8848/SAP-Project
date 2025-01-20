<?php
require_once '../database.php';
require_once 'certificate.php';

$database = new Database();
$db = $database->mysqli;

$certificate = new Certificate($db);

$id = $_GET['id'];

$certificateData = $certificate->getCertificateById($id);
if (!$certificateData) {
    echo "Sertifika kaydı bulunamadı.";
    exit;
}

$calisanlar = $certificate->getAllWorkers();
$sertifika_turleri = $certificate->getAllCertificateTypes();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workerId = $_POST['WorkerId'];
    $certificateNameId = $_POST['CertificateNameId'];

    if ($certificate->updateCertificate($id, $workerId, $certificateNameId)) {
        echo "Sertifika başarıyla güncellendi.";
        header('Location: index.php');
    } else {
        echo "Sertifika güncellenirken bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sertifika Düzenle</title>
    <style>
       
    </style>
</head>
<body>
    <form id="update" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>">
        <h1>Sertifika Düzenle</h1>
        
        <input type="hidden" name="id" value="<?php echo $certificateData['Id']; ?>">

        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <option value="<?php echo $certificateData['WorkerId']; ?>"><?php echo $certificateData['Name'] . ' ' . $certificateData['Surname']; ?></option>
            <?php while ($calisan = $calisanlar->fetch_assoc()) { ?>
                <option value="<?php echo $calisan['Id']; ?>"><?php echo $calisan['Name'] . ' ' . $calisan['Surname']; ?></option>
            <?php } ?>
        </select>

        <label for="CertificateNameId">Sertifika Türü:</label>
        <select id="CertificateNameId" name="CertificateNameId" required>
            <option value="<?php echo $certificateData['CertificateNameId']; ?>">
                <?php echo $certificateData['CertificateName']; ?>
            </option>
            <?php
            $sertifika_turleri->data_seek(0); 
            while ($cert_tur = $sertifika_turleri->fetch_assoc()) {
                ?>
                <option value="<?php echo $cert_tur['Id']; ?>"><?php echo $cert_tur['CertificateName']; ?></option>
            <?php } ?>
        </select>
        
        <input type="submit" value="Güncelle">
    </form>
</body>
</html>
