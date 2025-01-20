<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/certificate.php";
$db = new Database();
$certificate = new Certificate($db);

$calisanlar = $certificate->getAllWorkers();
$sertifika_turleri = $certificate->getAllCertificateTypes();
?>

<form id="store" method="post" action="">
    <h1>Yeni Sertifika Ekle</h1>
    
    <label for="WorkerSearch">Çalışan Ara:</label>
    <input type="text" id="WorkerSearch" placeholder="Çalışanları Ara" onkeyup="filterWorkers()">
    
    <label for="WorkerId">Çalışan:</label>
    <select id="WorkerId" name="WorkerId" required>
    <option value="0" class="worker-option">Seçim Yap</option>
        <?php while ($row = $calisanlar->fetch_assoc()) { ?>
            <option value="<?php echo $row['Id']; ?>" class="worker-option">
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
    
    <input type="hidden" name="Id" value="<?php echo isset($certificateData['Id']) ? $certificateData['Id'] : -1; ?>">
    <input type="button" value="Kaydet" class="btn btn-primary" onclick="SaveCertificateModul()">
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function filterWorkers() {
    var searchValue = $('#WorkerSearch').val().toLowerCase();
    $('#WorkerId option').each(function() {
        var optionText = $(this).text().toLowerCase();
        if (optionText.indexOf(searchValue) !== -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}
</script>
