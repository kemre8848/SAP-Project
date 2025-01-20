<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/education.php";

$database = new Database();
$db = $database->mysqli;
$education = new Education($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['Id'];
    $workerId = $_POST['WorkerId'];
    $educationId = $_POST['EducationId'];
    $educationDate = $_POST['EducationDate'];

    if ($education->updateEducation($id, $workerId, $educationId, $educationDate)) {
        echo "Eğitim başarıyla güncellendi.";
    } else {
        echo "Eğitim güncellenirken bir hata oluştu.";
    }
}
?>
