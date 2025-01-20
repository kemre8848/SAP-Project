<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/database.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Personal/dbhelper/certificate.php";
session_start();

$db = new Database();
$certificate = new Certificate($db);
if($_SESSION['rol_id'] == 5){
    $sertifikalar = $certificate->getAllCertificatesK(); 
}
else{
    $sertifikalar = $certificate->getAllCertificates();
}
?>

<div class="container">
        <h1>Sertifika Listesi</h1>
        
        <table id=certificate_table>
            <thead>    
                <tr>
                    <th>ID</th>
                    <th>Çalışan Adı</th>
                    <th>Sertifika Türü</th>
                    <th>Eklenme Tarihi</th>
                    <th>Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <?php while ($sertifika = $sertifikalar->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $sertifika['Id']; ?></td>
                <td><?php echo $sertifika['Name'] . ' ' . $sertifika['Surname']; ?></td>
                <td><?php echo $sertifika['CertificateName']; ?></td>
                <td><?php echo $sertifika['AddDate']; ?></td>
                <td><?php echo $sertifika['UpdateDateTime']; ?></td>
                <td>
                <button name="edit_id" class="btn btn-primary" onclick="OpenCertificateEdit(<?php echo $sertifika['Id']; ?>)">Düzenle</button>
                    <form style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $sertifika['Id']; ?>">
                        <button type="button" name="delete_id" class="btn btn-danger" onclick="RemoveCertificateTable(<?php echo $sertifika['Id']; ?>)">Sil</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
        
    </div>