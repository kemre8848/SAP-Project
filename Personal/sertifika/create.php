<?php
require_once '../database.php';
require_once 'certificate.php';

$database = new Database();
$db = $database->mysqli;

$certificate = new Certificate($db);

$calisanlar = $certificate->getAllWorkers();
$sertifika_turleri = $certificate->getAllCertificateTypes();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workerId = $_POST['WorkerId'];
    $certificateNameId = $_POST['CertificateNameId'];

    if ($certificate->createCertificate($workerId, $certificateNameId)) {
        echo "Sertifika başarıyla eklendi.";
        header('Location: index.php');
        exit;
    } else {
        echo "Sertifika eklenirken bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Yeni Sertifika Ekle</title>
    <style>
        
    </style>
</head>
<body>
    <form id="store_sertifika" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Yeni Sertifika Ekle</h1>
        
        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <?php while ($row = $calisanlar->fetch_assoc()) { ?>
                <option value="<?php echo $row['Id']; ?>">
                    <?php echo $row['Name'] . ' ' . $row['Surname']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="CertificateNameId">Sertifika Türü:</label>
        <select id="CertificateNameId" name="CertificateNameId" required>
            <?php while ($row = $sertifika_turleri->fetch_assoc()) { ?>
                <option value="<?php echo $row['Id']; ?>">
                    <?php echo $row['CertificateName']; ?>
                </option>
            <?php } ?>
        </select>
        
        <input type="submit" value="Kaydet">
    </form>
</body>
</html>
