<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/education.php";

$database = new Database();
$db = $database->mysqli;
$education = new Education($db);
$workers = $education->getAllWorkers();
$educationTypes = $education->getAllEducationTypes();
?>

<form id="store" method="post" action="">
    <h1>Yeni Eğitim Ekle</h1>
    
    <label for="WorkerSearch">Çalışan Ara:</label>
    <input type="text" id="WorkerSearch" placeholder="Çalışanları Ara" onkeyup="filterWorkers()">
    
    <label for="WorkerId">Çalışan:</label>
    <select id="WorkerId" name="WorkerId" required>
        <?php while ($worker = $workers->fetch_assoc()) { ?>
            <option value="<?php echo $worker['Id']; ?>" class="worker-option">
                <?php echo $worker['Name'] . ' ' . $worker['Surname']; ?>
            </option>
        <?php } ?>
    </select>

    <label for="EducationId">Eğitim Türü:</label>
    <select id="EducationId" name="EducationId" required>
        <?php while ($eduType = $educationTypes->fetch_assoc()) { ?>
            <option value="<?php echo $eduType['Id']; ?>">
                <?php echo $eduType['EducationName']; ?>
            </option>
        <?php } ?>
    </select>

    <label for="EducationDate">Eğitim Tarihi:</label>
    <input type="date" id="EducationDate" name="EducationDate" required>

    <input type="hidden" name="Id" value="<?php echo isset($educationData['Id']) ? $educationData['Id'] : -1; ?>">
    <input type="button" value="Kaydet" class="btn btn-primary" onclick="SaveEducationModul()">
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
