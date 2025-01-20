<?php 

require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/education.php";

$database = new Database();
$db = $database->mysqli;
$education = new Education($db);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    if ($education->deleteEducation($delete_id)) {
        
        exit();
    } 
}

?>