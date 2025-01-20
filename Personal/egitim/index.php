<?php
include '../database.php';
include 'Education.php';

$database = new Database();
$db = $database->mysqli;
$education = new Education($db);

if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    if ($education->deleteEducation($id)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Eğitim kaydı silinemedi.";
    }
}

$educations = $education->getAllEducations();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eğitim Listesi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }
        .button:hover {background-color: #3e8e41}
        .button:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Eğitim Listesi</h1>
        <a class="button" href="create.php">Yeni Eğitim Ekle</a>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Çalışan Adı</th>
                <th>Eğitim Türü</th>
                <th>Eklenme Tarihi</th>
                <th>Güncellenme Tarihi</th>
                <th>İşlemler</th>
            </tr>
            <?php while ($edu = $educations->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $edu['Id']; ?></td>
                <td><?php echo $edu['Name'] . ' ' . $edu['Surname']; ?></td>
                <td><?php echo $edu['EducationName']; ?></td>
                <td><?php echo $edu['AddDate']; ?></td>
                <td><?php echo $edu['UpdateDateTime']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $edu['Id']; ?>">Düzenle</a>
                    <a href="index.php?delete_id=<?php echo $edu['Id']; ?>" onclick="return confirm('Emin misiniz?')">Sil</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
