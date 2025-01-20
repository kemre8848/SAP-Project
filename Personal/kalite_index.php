<?php
include 'database.php';
include 'navbar.php';
session_start();

$database = new Database();
$conn = $database->mysqli;

if (!isset($_SESSION['kullanici_id']) || ($_SESSION['rol_id'] != 1 && $_SESSION['rol_id'] != 5)) {  
    header('Location: yetki.php');
    exit;
}

$sql = "SELECT sertifikalar.Id, sertifikalar.WorkerId, sertifikalar.CertificateNameId, calisanlar.Name, sertifikalar.AddDate, sertifikalar.UpdateDateTime, calisanlar.Surname
        FROM sertifikalar
        JOIN calisanlar ON sertifikalar.WorkerId = calisanlar.Id
        WHERE calisanlar.DepartmentId = '5'";
$result = $conn->query($sql);

$sqlEgitim = "SELECT e.Id, e.WorkerId, e.EducationId, e.EducationDate, c.Name, c.Surname, e.AddDate, e.UpdateDateTime
              FROM egitimler as e
              JOIN calisanlar as c ON e.WorkerId = c.Id
              WHERE c.DepartmentId = '5'";
$resultEgitim = $conn->query($sqlEgitim);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kalite Bölümü</title>
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

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 20px;
        }

        a.button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Kaynakçı Çalışanların Sertifikaları</h1>
    <table>
    <colgroup>
        <col span="2" style="background-color: #D6EEEE">
        <col span="3" style="background-color: pink">
    </colgroup>
    <tr>
        <th>ID</th>
        <th>Çalışan</th>
        <th>Sertifika Adı</th>
        <th>Eklenme Tarihi</th>
        <th>Güncellenme Tarihi</th>
        <th>İşlemler</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['Id']; ?></td>
            <td><?php echo $row['Name'] . " " . $row['Surname']; ?></td>
            <td>
                <?php
                $certId = $row['CertificateNameId'];
                $certSql = "SELECT CertificateName FROM sertifikaturleri WHERE Id = $certId";
                $certResult = $conn->query($certSql);
                if ($certResult->num_rows > 0) {
                    $certRow = $certResult->fetch_assoc();
                    echo $certRow['CertificateName'];
                } else {
                    echo "Sertifika bulunamadı";
                }
                ?>
            </td>
            <td><?php echo $row['AddDate']; ?></td>
            <td><?php echo $row['UpdateDateTime']; ?></td>
            <td>
                <a href="sertifika/edit.php?id=<?php echo $row['Id']; ?>">Düzenle</a>
                <a href="sertifika/certificate.php?id=<?php echo $row['Id']; ?>">Sil</a>
            </td>
        </tr>
    <?php } ?>
</table>

  
    
    <h1>Kaynakçı Çalışanların Egitimleri</h1>
    <table>
    <colgroup>
        <col span="2" style="background-color: #D6EEEE">
        <col span="4" style="background-color: pink">
    </colgroup>
    <tr>
        <th>ID</th>
        <th>Çalışan</th>
        <th>Eğitim Adı</th>
        <th>Eğitim Tarihi</th>
        <th>Eklenme Tarihi</th>
        <th>Güncellenme Tarihi</th>
        <th>İşlemler</th>
    </tr>
    <?php while($row = $resultEgitim->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['Id']; ?></td>
            <td><?php echo $row['Name'] . " " . $row['Surname']; ?></td>
            <td>
                <?php
        
                $eduId = $row['EducationId'];
                $eduSql = "SELECT EducationName FROM egitimturleri WHERE Id = $eduId";
                $eduResult = $conn->query($eduSql);
                if ($eduResult->num_rows > 0) {
                    $eduRow = $eduResult->fetch_assoc();
                    echo $eduRow['EducationName'];
                } else {
                    echo "Eğitim bulunamadı";
                }
                ?>
            </td>
            <td><?php echo $row['EducationDate']; ?></td>
            <td><?php echo $row['AddDate']; ?></td>
            <td><?php echo $row['UpdateDateTime']; ?></td>
            <td>
                <a href="egitim/edit.php?id=<?php echo $row['Id']; ?>">Düzenle</a>
                <a href="egitim/delete.php?id=<?php echo $row['Id']; ?>">Sil</a>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>

