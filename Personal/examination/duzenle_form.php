<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/examination.php";

$examination = new Examination();
$calisanlar = $examination->getAllWorkers();
$muayene_turleri = $examination->getAllExaminationTypes();

$row = [];
if (isset($_POST['edit_id'])) {
    $result = $examination->readOne($_POST['edit_id']);
    if ($result) {
        $row = $result->fetch_assoc();
    }
}
?>

<div class="container">
    <form id="editForm" method="post">
        <h1>Muayene Düzenle</h1>
        
        <input type="hidden" name="id" value="<?php echo isset($row['Id']) ? htmlspecialchars($row['Id']) : ''; ?>">

        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <?php while ($calisan = $calisanlar->fetch_assoc()) { ?>
                <option value="<?php echo htmlspecialchars($calisan['Id']); ?>" <?php if (isset($row['WorkerId']) && $calisan['Id'] == $row['WorkerId']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($calisan['Name'] . ' ' . $calisan['Surname']); ?>
                </option>
            <?php } ?>
        </select>

        <label for="ExaminationDate">Muayene Tarihi:</label>
        <input type="date" id="ExaminationDate" name="ExaminationDate" value="<?php echo isset($row['ExaminationDate']) ? htmlspecialchars($row['ExaminationDate']) : ''; ?>" required>
        
        <label for="ExaminationTypeId">Muayene Türü:</label>
        <select id="ExaminationTypeId" name="ExaminationTypeId" required>
            <?php while ($tur = $muayene_turleri->fetch_assoc()) { ?>
                <option value="<?php echo htmlspecialchars($tur['Id']); ?>" <?php if (isset($row['ExaminationTypeId']) && $tur['Id'] == $row['ExaminationTypeId']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($tur['TypeName']); ?>
                </option>
            <?php } ?>
        </select>
        
        <label for="Results">Sonuçlar:</label>
        <textarea id="Results" name="Results" rows="4" required><?php echo isset($row['Results']) ? htmlspecialchars($row['Results']) : ''; ?></textarea>
        
        <input type="hidden" name="Id" value="<?php echo isset($row['Id']) ? $row['Id'] : -1; ?>">
        <input type="button" value="Güncelle" class="btn btn-primary" onclick="UpdateExamination();">
    </form>
</div>