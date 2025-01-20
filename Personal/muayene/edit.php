<?php
require_once '../database.php';
require_once 'examination.php';

$database = new Database();
$db = $database->mysqli;

$examination = new Examination($db);

$id = $_GET['id'];

$result = $examination->readOne($id);
if ($result->num_rows == 0) {
    echo "Muayene kaydı bulunamadı.";
    exit;
}

$row = $result->fetch_assoc();

$calisanlar = $examination->getAllWorkers();
$muayene_turleri = $examination->getAllExaminationTypes();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; 
    $WorkerId = $_POST['WorkerId'];
    $ExaminationDate = $_POST['ExaminationDate'];
    $ExaminationTypeId = $_POST['ExaminationTypeId'];
    $Results = $_POST['Results'];
    
    $updated = $examination->update($id, $WorkerId, $ExaminationDate, $ExaminationTypeId, $Results);

    if ($updated) {
        header('Location: index.php');
        exit;
    } else {
        echo "Güncelleme işlemi başarısız.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Muayene Düzenle</title>
    <style>
      
    </style>
</head>
<body>
    <form id="update" method="post" action="edit.php?id=<?php echo $id; ?>">
        <h1>Muayene Düzenle</h1>
        
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['Id']); ?>">

        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <?php while ($calisan = $calisanlar->fetch_assoc()) { ?>
                <option value="<?php echo htmlspecialchars($calisan['Id']); ?>" <?php if ($calisan['Id'] == $row['WorkerId']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($calisan['Name'] . ' ' . $calisan['Surname']); ?>
                </option>
            <?php } ?>
        </select>

        <label for="ExaminationDate">Muayene Tarihi:</label>
        <input type="date" id="ExaminationDate" name="ExaminationDate" value="<?php echo htmlspecialchars($row['ExaminationDate']); ?>" required>
        
        <label for="ExaminationTypeId">Muayene Türü:</label>
        <select id="ExaminationTypeId" name="ExaminationTypeId" required>
            <?php while ($tur = $muayene_turleri->fetch_assoc()) { ?>
                <option value="<?php echo htmlspecialchars($tur['Id']); ?>" <?php if ($tur['Id'] == $row['ExaminationTypeId']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($tur['TypeName']); ?>
                </option>
            <?php } ?>
        </select>
        
        <label for="Results">Sonuçlar:</label>
        <textarea id="Results" name="Results" rows="4" required><?php echo htmlspecialchars($row['Results']); ?></textarea>
        
        <input type="submit" value="Güncelle">
    </form>
</body>
</html>
