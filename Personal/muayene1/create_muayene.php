<?php
include '../db.php';

$sql_calisanlar = "SELECT Id, Name, Surname FROM calisanlar WHERE IsActive = 1";
$result_calisanlar = $conn->query($sql_calisanlar);

$sql_muayene_turleri = "SELECT Id, TypeName FROM muayene_turleri";
$result_muayene_turleri = $conn->query($sql_muayene_turleri);

if (!$result_calisanlar || !$result_muayene_turleri) {
    die("Sorgu hatası: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Yeni Muayene Ekle</title>
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

        select, input[type="text"], input[type="date"], textarea {
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
    <form id="store" method="post" action="store_muayene.php">
        <h1>Yeni Muayene Ekle</h1>
        
        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <?php while ($row = $result_calisanlar->fetch_assoc()) { ?>
                <option value="<?php echo $row['Id']; ?>">
                    <?php echo $row['Name'] . ' ' . $row['Surname']; ?>
                </option>
            <?php } ?>
        </select>
        
        <label for="ExaminationDate">Muayene Tarihi:</label>
        <input type="date" id="ExaminationDate" name="ExaminationDate" required>
        
        <label for="ExaminationTypeId">Muayene Türü:</label>
        <select id="ExaminationTypeId" name="ExaminationTypeId" required>
            <?php while ($row = $result_muayene_turleri->fetch_assoc()) { ?>
                <option value="<?php echo $row['Id']; ?>">
                    <?php echo $row['TypeName']; ?>
                </option>
            <?php } ?>
        </select>
        
        <label for="Results">Sonuçlar:</label>
        <textarea id="Results" name="Results" rows="4" required></textarea>
        
        <input type="submit" value="Kaydet">
    </form>
</body>
</html>
