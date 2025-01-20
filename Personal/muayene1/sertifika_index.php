<?php
include '../db.php';
include 'navbar1.php';

session_start();


if (!isset($_SESSION['kullanici_id']) || ($_SESSION['rol_id'] != 1 && $_SESSION['rol_id'] != 4)) {  
    header('Location: yetki.php');
    exit;
}

$sql = "SELECT s.Id, c.Name, c.Surname, st.CertificateName, s.AddDate, s.UpdateDateTime 
        FROM sertifikalar s 
        JOIN calisanlar c ON s.WorkerId = c.Id 
        JOIN sertifikaturleri st ON s.CertificateNameId = st.Id 
        WHERE s.IsActive = 1";
$result = $conn->query($sql);

if (!$result) {
    die("Sorgu hatası: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sertifika Listesi</title>
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
        <h1>Sertifika Listesi</h1>
        
        <table>
        <a class="button" href="create_sertifika.php">Yeni Sertifika Ekle</a>
            <tr>
                <th>ID</th>
                <th>Çalışan Adı</th>
                <th>Sertifika Türü</th>
                <th>Eklenme Tarihi</th>
                <th>Güncellenme Tarihi</th>
                <th>İşlemler</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['Id']; ?></td>
                <td><?php echo $row['Name'] . ' ' . $row['Surname']; ?></td>
                <td><?php echo $row['CertificateName']; ?></td>
                <td><?php echo $row['AddDate']; ?></td>
                <td><?php echo $row['UpdateDateTime']; ?></td>
                <td>
                    <a href="edit_sertifika.php?id=<?php echo $row['Id']; ?>">Düzenle</a>
                    <a href="delete_sertifika.php?id=<?php echo $row['Id']; ?>">Sil</a>
                </td>
            </tr>
            <?php } ?>
        </table>
        
    </div>
</body>
</html>

<?php $conn->close(); ?>