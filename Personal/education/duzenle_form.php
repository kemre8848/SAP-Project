<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/education.php";

$database = new Database();
$db = $database->mysqli;
$education = new Education($db);

$id = isset($_POST['edit_id']) ? $_POST['edit_id'] : -1;
$educationData = $education->getEducationById($id);

$workers = $education->getAllWorkers();
$educationTypes = $education->getAllEducationTypes();
?>

<div class="container">
    <form id="editForm" method="post" action="">
        <h1>Eğitim Düzenle</h1>
            <label for="WorkerId">Çalışan:</label>
            <select id="WorkerId" name="WorkerId" required>
                <?php while ($worker = $workers->fetch_assoc()) { ?>
                    <option value="<?php echo $worker['Id']; ?>" <?php if ($educationData['WorkerId'] == $worker['Id']) echo 'selected'; ?>>
                        <?php echo $worker['Name'] . ' ' . $worker['Surname']; ?>
                    </option>
                <?php } ?>
            </select>

            <label for="EducationId">Eğitim Türü:</label>
            <select id="EducationId" name="EducationId" required>
                <?php while ($eduType = $educationTypes->fetch_assoc()) { ?>
                    <option value="<?php echo $eduType['Id']; ?>" <?php if ($educationData['EducationId'] == $eduType['Id']) echo 'selected'; ?>>
                        <?php echo $eduType['EducationName']; ?>
                    </option>
                <?php } ?>
            </select>

            <label for="EducationDate">Eğitim Tarihi:</label>
            <input type="date" id="EducationDate" name="EducationDate" value="<?php echo $educationData['EducationDate']; ?>" required>

            <input type="hidden" name="Id" value="<?php echo $educationData['Id']; ?>">
            <input type="button" value="Güncelle" class="btn btn-primary" onclick="UpdateEducation();">
    </form>
</div>
