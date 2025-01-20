<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";

$database = new Database();
$query = isset($_POST['query']) ? $_POST['query'] : '';

$sql = "SELECT Id, CONCAT(Name, ' ', Surname) AS fullName FROM calisanlar WHERE CONCAT(Name, ' ', Surname) LIKE ?";
$stmt = $database->prepare($sql);
$searchTerm = '%' . $query . '%';
$stmt->bind_param('s', $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$options = '';
while ($row = $result->fetch_assoc()) {
    $options .= '<option value="' . $row['Id'] . '">' . $row['fullName'] . '</option>';
}

echo $options;
?>