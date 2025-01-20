<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/examination.php";

$examination = new Examination();

$result_calisanlar = $examination->getAllWorkers();
$result_muayene_turleri = $examination->getAllExaminationTypes();
?>

<form id="store" method="post" action="">
    <h1>Yeni Muayene Ekle</h1>
    
    <label for="WorkerSearch">Çalışan Ara:</label>
    <input type="text" id="WorkerSearch" placeholder="Çalışanları Ara" onkeyup="filterWorkers()">
    
    <label for="WorkerId">Çalışan:</label>
    <select id="WorkerId" name="WorkerId" required>
    <option value="0" class="worker-option">Seçim Yap</option>
        <?php while ($row = $result_calisanlar->fetch_assoc()) { ?>
            <option value="<?php echo $row['Id']; ?>" class="worker-option">
                <?php echo $row['Name'] . ' ' . $row['Surname']; ?>
            </option>
        <?php } ?>
    </select>
    
    <label for="ExaminationDate">Muayene Tarihi:</label>
    <input type="date" id="ExaminationDate" name="ExaminationDate" required>
    
    <label for="ExaminationTypeId">Muayene Türü:</label>
    <select id="ExaminationTypeId" name="ExaminationTypeId" required>
        <?php while ($row = $result_muayene_turleri->fetch_assoc()) { ?>
            <option value="<?php echo $row['Id']; ?>">
                <?php echo $row['TypeName']; ?>
            </option>
        <?php } ?>
    </select>
    
    <label for="Results">Sonuçlar:</label>
    <textarea id="Results" name="Results" rows="4" required></textarea>
    
    <input type="hidden" name="Id" value="<?php echo isset($examinationData['Id']) ? $examinationData['Id'] : -1; ?>">
    <input type="button" value="Kaydet" class="btn btn-primary" onclick="SaveExaminationModul()">
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
