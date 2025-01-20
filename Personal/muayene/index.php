<?php
require_once '../database.php';

$database = new Database();
$db = $database->mysqli;

require_once 'examination.php';

$examination = new Examination($db);
$results = $examination->readAll();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_id'])) {
        $examination->delete($_POST['delete_id']);
        header('Location: index.php');
        exit;}
        else{
    $database = new Database();
    $db = $database->mysqli;

    $examination = new Examination($db);

    $worker_id = $_POST['WorkerId'];
    $examination_date = $_POST['ExaminationDate'];
    $examination_type_id = $_POST['ExaminationTypeId'];
    $results = $_POST['Results'];

    if ($examination->create($worker_id, $examination_date, $examination_type_id, $results)) {
        header("Location: index.php");
    } else {
        echo "Muayene kaydı eklenemedi.";
    }
}}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Muayene Kayıtları</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Muayene Kayıtları</h1>
    <a href="create.php">Yeni Muayene Ekle</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Çalışan</th>
                <th>Muayene Tarihi</th>
                <th>Muayene Türü</th>
                <th>Sonuçlar</th>
                <th>Ekleme Tarihi</th>
                <th>Güncelleme Tarihi</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $results->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['Id']); ?></td>
                    <td><?php echo htmlspecialchars($row['Name'] . ' ' . $row['Surname']); ?></td>
                    <td><?php echo htmlspecialchars($row['ExaminationDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['ExaminationTypeId']); ?></td>
                    <td><?php echo htmlspecialchars($row['Results']); ?></td>
                    <td><?php echo htmlspecialchars($row['AddDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['UpdateDateTime']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo htmlspecialchars($row['Id']); ?>">Düzenle</a> | 
                        <form method="post" action="index.php" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $row['Id']; ?>">
                    <button type="submit">Sil</button>
                    </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
