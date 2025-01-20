<?php
require_once '../database.php';
require_once 'certificate.php';

session_start();

if (!isset($_SESSION['kullanici_id']) || ($_SESSION['rol_id'] != 1 && $_SESSION['rol_id'] != 4)) {  
    header('Location: yetki.php');
    exit;
}

$database = new Database();
$db = $database->mysqli;

$certificate = new Certificate($db);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    if ($certificate->deleteCertificate($delete_id)) {
        echo "Sertifika başarıyla silindi.";
        
    } else {
        echo "Sertifika silinirken bir hata oluştu.";
    }
}

$sertifikalar = $certificate->getAllCertificates();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sertifika Listesi</title>
    <style>
       
    </style>
</head>
<body>
    <div class="container">
        <h1>Sertifika Listesi</h1>
        
        <table>
            <a class="button" href="create.php">Yeni Sertifika Ekle</a>
            <tr>
                <th>ID</th>
                <th>Çalışan Adı</th>
                <th>Sertifika Türü</th>
                <th>Eklenme Tarihi</th>
                <th>Güncellenme Tarihi</th>
                <th>İşlemler</th>
            </tr>
            <?php while ($sertifika = $sertifikalar->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $sertifika['Id']; ?></td>
                <td><?php echo $sertifika['Name'] . ' ' . $sertifika['Surname']; ?></td>
                <td><?php echo $sertifika['CertificateName']; ?></td>
                <td><?php echo $sertifika['AddDate']; ?></td>
                <td><?php echo $sertifika['UpdateDateTime']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $sertifika['Id']; ?>">Düzenle</a>
                    <form method="post" action="index.php" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $sertifika['Id']; ?>">
                        <button type="submit">Sil</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
        
    </div>
</body>
</html>
