<?php
include '../database.php';
include 'Education.php';

$database = new Database();
$db = $database->mysqli;
$education = new Education($db);

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['Id'];
    $workerId = $_POST['WorkerId'];
    $educationId = $_POST['EducationId'];
    $educationDate = $_POST['EducationDate'];

    if ($education->updateEducation($id, $workerId, $educationId, $educationDate)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Eğitim kaydı güncellenemedi.";
    }
} else {
    if ($id <= 0) {
        echo "Geçersiz eğitim Id.";
        exit;
    }

    $edu = $education->getEducationById($id);
    if (!$edu) {
        echo "Eğitim kaydı bulunamadı.";
        exit;
    }
}

$workers = $education->getAllWorkers();
$educationTypes = $education->getAllEducationTypes();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eğitim Düzenle</title>
</head>
<body>
    <h1>Eğitim Düzenle</h1>
    <form method="post" action="edit.php?id=<?php echo $id; ?>">
        <input type="hidden" name="Id" value="<?php echo $edu['Id']; ?>">

        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <?php while ($worker = $workers->fetch_assoc()) { ?>
                <option value="<?php echo $worker['Id']; ?>" <?php echo ($worker['Id'] == $edu['WorkerId']) ? 'selected' : ''; ?>>
                    <?php echo $worker['Name'] . ' ' . $worker['Surname']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="EducationId">Eğitim Türü:</label>
        <select id="EducationId" name="EducationId" required>
            <?php while ($eduType = $educationTypes->fetch_assoc()) { ?>
                <option value="<?php echo $eduType['Id']; ?>" <?php echo ($eduType['Id'] == $edu['EducationId']) ? 'selected' : ''; ?>>
                    <?php echo $eduType['EducationName']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="EducationDate">Eğitim Tarihi:</label>
        <input type="date" id="EducationDate" name="EducationDate" value="<?php echo $edu['EducationDate']; ?>" required>

        <input type="submit" value="Güncelle">
    </form>
</body>
</html>
