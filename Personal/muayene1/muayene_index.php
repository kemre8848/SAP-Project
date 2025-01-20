<?php
include '../db.php';
include 'navbar1.php';

session_start();


if (!isset($_SESSION['kullanici_id']) || ($_SESSION['rol_id'] != 1 && $_SESSION['rol_id'] != 4)) {  
    header('Location: ../yetki.php');
    exit;
}

$sql = "SELECT mk.Id, mk.WorkerId, mk.ExaminationDate, mt.TypeName AS ExaminationTypeId, mk.Results, mk.AddDate, mk.UpdateDateTime, c.Name, c.Surname 
        FROM muayenekayit mk 
        JOIN calisanlar c ON mk.WorkerId = c.Id 
        JOIN muayene_turleri mt ON mk.ExaminationTypeId = mt.Id 
        WHERE mk.IsActive = 1";
$result = $conn->query($sql);

if (!$result) {
    die("Sorgu hatası: " . $conn->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Muayene Listesi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 20px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #218838;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Muayene Listesi</h1>
        
        <table>
        <a class="button" href="create_muayene.php">Yeni Muayene Ekle</a>
            <colgroup>
                <col span="4" style="background-color: #D6EEEE">
                <col span="4" style="background-color: pink">
            </colgroup>
            <tr>
                <th>ID</th>
                <th>Çalışan Adı</th>
                <th>Muayene Tarihi</th>
                <th>Muayene Türü</th>
                <th>Sonuçlar</th>
                <th>Eklenme Tarihi</th>
                <th>Güncellenme Tarihi</th>
                <th>İşlemler</th>
            </tr>
            
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['Id']; ?></td>
                <td><?php echo $row['Name'] . ' ' . $row['Surname']; ?></td>
                <td><?php echo $row['ExaminationDate']; ?></td>
                <td><?php echo $row['ExaminationTypeId']; ?></td>
                <td><?php echo $row['Results']; ?></td>
                <td><?php echo $row['AddDate']; ?></td>
                <td><?php echo $row['UpdateDateTime']; ?></td>
                <td>
                    <a href="edit_muayene.php?id=<?php echo $row['Id']; ?>">Düzenle</a>
                    <a href="delete_muayene.php?id=<?php echo $row['Id']; ?>">Sil</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        
    </div>
</body>
</html>
<?php $conn->close(); ?> 
