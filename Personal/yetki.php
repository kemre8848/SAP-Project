<?php
/*session_start();
include 'database.php';
include 'navbar.php';
if (!isset($_SESSION['kullanici_id'])) {
    header('Location: login.php');
    exit;
}

$database = new Database(); 

$rol_id = $_SESSION['rol_id'];

$sql = "SELECT rol_adi FROM roller WHERE id = ?";
$stmt = $database->prepare($sql);
$stmt->bind_param('i', $rol_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $rol = $result->fetch_assoc()['rol_adi'];
} else {
    $rol = ''; 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>ERP Ana Sayfa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1 {
            color: #333;
            margin-top: 20px;
        }
        nav {
            margin-top: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            display: inline-block;
        }
        li {
            margin-bottom: 10px;
        }
        li a {
            display: block;
            color: #333;
            background-color: #f9f9f9;
            padding: 10px 20px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        li a:hover {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Hoşgeldiniz</h1>
    <nav>
        <ul>
            <?php if ($rol == 'admin' || $rol == 'human_resources') { ?>
                <li><a href="index.php">İnsan Kaynakları</a></li>
            <?php } ?>
            <?php if ($rol == 'admin' || $rol == 'infirmary') { ?>
                <li><a href="muayene/muayene_index.php">Revir</a></li>
            <?php } ?>
            <?php if ($rol == 'admin' || $rol == 'quality_control') { ?>
                <li><a href="kalite_index.php">Kalite Kontrol</a></li>
            <?php } ?>
            <?php if ($rol == 'admin') { ?>
                <li><a href="admin_index.php">Admin</a></li>
            <?php } ?>
            <li><a href="logout.php">Çıkış Yap</a></li>
        </ul>
    </nav>
</body>
</html>
*/