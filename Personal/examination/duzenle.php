<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/examination.php";

$examination = new Examination();
$calisanlar = $examination->getAllWorkers();
$muayene_turleri = $examination->getAllExaminationTypes();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $WorkerId = $_POST['WorkerId'];
        $ExaminationDate = $_POST['ExaminationDate'];
        $ExaminationTypeId = $_POST['ExaminationTypeId'];
        $Results = $_POST['Results'];

        $updated = $examination->update($id, $WorkerId, $ExaminationDate, $ExaminationTypeId, $Results);

        
}
}
?>

