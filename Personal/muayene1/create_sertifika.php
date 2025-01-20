<?php
include '../db.php';


$sql = "SELECT Id, Name, Surname FROM calisanlar WHERE IsActive = 1";
$calisan_result = $conn->query($sql);

if (!$calisan_result) {
    die("Sorgu hatası: " . $conn->error);
}


$sql = "SELECT Id, CertificateName FROM sertifikaturleri";
$sertifika_turleri_result = $conn->query($sql);

if (!$sertifika_turleri_result) {
    die("Sorgu hatası: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Yeni Sertifika Ekle</title>
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
    <form id="store_sertifika" method="post" action="store_sertifika.php">
        <h1>Yeni Sertifika Ekle</h1>
        
        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <?php while ($row = $calisan_result->fetch_assoc()) { ?>
                <option value="<?php echo $row['Id']; ?>">
                    <?php echo $row['Name'] . ' ' . $row['Surname']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="CertificateNameId">Sertifika Türü:</label>
        <select id="CertificateNameId" name="CertificateNameId" required>
            <?php while ($row = $sertifika_turleri_result->fetch_assoc()) { ?>
                <option value="<?php echo $row['Id']; ?>">
                    <?php echo $row['CertificateName']; ?>
                </option>
            <?php } ?>
        </select>
        
        <input type="submit" value="Kaydet">
    </form>
</body>
</html>