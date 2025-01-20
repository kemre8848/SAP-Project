<?php

require_once '../database.php'; 
require_once 'examination.php'; 

$database = new Database();
$db = $database->mysqli; 

$examination = new Examination($db);

$result_calisanlar = $examination->getAllWorkers();
$result_muayene_turleri = $examination->getAllExaminationTypes();

if (!$result_calisanlar || !$result_muayene_turleri) {
    die("Sorgu hatası: " . $db->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Yeni Muayene Ekle</title>
    <style>
      
    </style>
</head>
<body>
    <form id="store" method="post" action="index.php">
        <h1>Yeni Muayene Ekle</h1>
        
        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <?php while ($row = $result_calisanlar->fetch_assoc()) { ?>
                <option value="<?php echo $row['Id']; ?>">
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
        
        <input type="submit" value="Kaydet">
    </form>
</body>
</html>
