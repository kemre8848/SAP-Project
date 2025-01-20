<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/education.php";

$database = new Database();
$db = $database->mysqli;
$education = new Education($db);
$workers = $education->getAllWorkers();
$educationTypes = $education->getAllEducationTypes();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $workerId = $_POST['WorkerId'];
    $educationId = $_POST['EducationId'];
    $educationDate = $_POST['EducationDate'];

    $education->createEducation($workerId, $educationId, $educationDate); 
        header('Location: index.php');
      
   
}


?>