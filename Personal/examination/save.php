<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/examination.php";

$examination = new Examination();
$calisanlar = $examination->getAllWorkers();
$muayene_turleri = $examination->getAllExaminationTypes();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['WorkerId']) && isset($_POST['ExaminationDate']) && isset($_POST['ExaminationTypeId']) && isset($_POST['Results'])) {
    
    $worker_id = $_POST['WorkerId'];
    $examination_date = $_POST['ExaminationDate'];
    $examination_type_id = $_POST['ExaminationTypeId'];
    $results = $_POST['Results'];

    $examination->create($worker_id, $examination_date, $examination_type_id, $results);
    header('Location: index.php');
    exit;
}
}
?>