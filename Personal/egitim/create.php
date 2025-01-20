<?php
include '../database.php';
include 'Education.php';

$database = new Database();
$db = $database->mysqli;
$education = new Education($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $workerId = $_POST['WorkerId'];
    $educationId = $_POST['EducationId'];
    $educationDate = $_POST['EducationDate'];

    if ($education->createEducation($workerId, $educationId, $educationDate)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Eğitim kaydı eklenemedi.";
    }
}

$workers = $education->getAllWorkers();
$educationTypes = $education->getAllEducationTypes();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Yeni Eğitim Ekle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        select, input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Yeni Eğitim Ekle</h1>
    <form method="post" action="create.php">
    <h1>Yeni Eğitim Ekle</h1>
        <label for="WorkerId">Çalışan:</label>
        <select id="WorkerId" name="WorkerId" required>
            <?php while ($worker = $workers->fetch_assoc()) { ?>
                <option value="<?php echo $worker['Id']; ?>"><?php echo $worker['Name'] . ' ' . $worker['Surname']; ?></option>
            <?php } ?>
        </select>

        <label for="EducationId">Eğitim Türü:</label>
        <select id="EducationId" name="EducationId" required>
            <?php while ($eduType = $educationTypes->fetch_assoc()) { ?>
                <option value="<?php echo $eduType['Id']; ?>"><?php echo $eduType['EducationName']; ?></option>
            <?php } ?>
        </select>

        <label for="EducationDate">Eğitim Tarihi:</label>
        <input type="date" id="EducationDate" name="EducationDate" required>

        <input type="submit" value="Kaydet">
    </form>
</body>
</html>
