<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/certificate.php";

$database = new Database();
$db = $database->mysqli;

$certificate = new Certificate($db);

$id = $_POST['edit_id'];
$certificateData = $certificate->getCertificateById($id);

$calisanlar = $certificate->getAllWorkers();
$sertifika_turleri = $certificate->getAllCertificateTypes();
?>
<form id="editForm" method="post" action="duzenle.php">
    <h1>Sertifika Düzenle</h1>
    
    <label for="WorkerId">Çalışan:</label>
    <select id="WorkerId" name="WorkerId" required>
        <?php while ($row = $calisanlar->fetch_assoc()) { ?>
            <option value="<?php echo $row['Id']; ?>" <?php if ($certificateData['WorkerId'] == $row['Id']) echo 'selected'; ?>>
                <?php echo $row['Name'] . ' ' . $row['Surname']; ?>
            </option>
        <?php } ?>
    </select>

    <label for="CertificateNameId">Sertifika Türü:</label>
    <select id="CertificateNameId" name="CertificateNameId" required>
        <?php while ($row = $sertifika_turleri->fetch_assoc()) { ?>
            <option value="<?php echo $row['Id']; ?>" <?php if ($certificateData['CertificateNameId'] == $row['Id']) echo 'selected'; ?>>
                <?php echo $row['CertificateName']; ?>
            </option>
        <?php } ?>
    </select>
    
    <input type="hidden" name="Id" value="<?php echo $id; ?>">
    <input type="button" value="Güncelle" class="btn btn-primary" onclick="UpdateCertificate();">
</form>

