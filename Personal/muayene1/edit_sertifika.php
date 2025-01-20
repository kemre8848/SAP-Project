<?php
include '../db.php';

$id = $_GET['id'];


$sql = "SELECT s.Id, s.WorkerId, s.CertificateNameId, s.AddDate, s.UpdateDateTime, c.Name, c.Surname 
        FROM sertifikalar s 
        JOIN calisanlar c ON s.WorkerId = c.Id 
        WHERE s.Id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Sertifika kaydı bulunamadı.";
    exit;
}


$sql = "SELECT Id, CertificateName FROM sertifikaturleri";
$sertifika_turleri_result = $conn->query($sql);

if (!$sertifika_turleri_result) {
    die("Sorgu hatası: " . $conn->error);
}


$sql = "SELECT Id, Name, Surname FROM calisanlar WHERE IsActive = 1";
$calisan_result = $conn->query($sql);

if (!$calisan_result) {
    die("Sorgu hatası: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sertifika Düzenle</title>
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

        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            box-sizing: border-box;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form id="update_sertifika" method="post" action="update_sertifika.php">
        <h1>Sertifika Düzenle</h1>
        
        <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">

        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <option value="<?php echo $row['WorkerId']; ?>"><?php echo $row['Name'] . ' ' . $row['Surname']; ?></option>
            <?php while ($calisan = $calisan_result->fetch_assoc()) { ?>
                <option value="<?php echo $calisan['Id']; ?>"><?php echo $calisan['Name'] . ' ' . $calisan['Surname']; ?></option>
            <?php } ?>
        </select>

        <label for="CertificateNameId">Sertifika Türü:</label>
        <select id="CertificateNameId" name="CertificateNameId" required>
            <option value="<?php echo $row['CertificateNameId']; ?>">
                <?php
                $sql = "SELECT CertificateName FROM sertifikaturleri WHERE Id = " . $row['CertificateNameId'];
                $result = $conn->query($sql);
                $cert = $result->fetch_assoc();
                echo $cert['CertificateName'];
                ?>
            </option>
            <?php while ($cert_tur = $sertifika_turleri_result->fetch_assoc()) { ?>
                <option value="<?php echo $cert_tur['Id']; ?>"><?php echo $cert_tur['CertificateName']; ?></option>
            <?php } ?>
        </select>


        
        <input type="submit" value="Güncelle">
    </form>
</body>
</html>

<?php
$conn->close();
?>
