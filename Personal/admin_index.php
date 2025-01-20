<?php
session_start();
include 'database.php';

$database = new Database();
$conn = $database->mysqli;

if (!$conn) {
    die("Bağlantı hatası: " . $database->mysqli->connect_error);
}

if (!isset($_SESSION['rol_id']) || $_SESSION['rol_id'] != 1) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kullanici_adi = $_POST['kullanici_adi'];
    $sifre = $_POST['sifre']; 
    $rol_id = $_POST['rol_id'];

   
    $hashedPassword = password_hash($sifre, PASSWORD_BCRYPT);

    $sql = "INSERT INTO kullanicilar (kullanici_adi, sifre, rol_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $kullanici_adi, $hashedPassword, $rol_id); 

    if ($stmt->execute()) {
        echo "Yeni kullanıcı başarıyla eklendi.";
        header('Location: index.php');
    } else {
        echo "Hata: " . $stmt->error;
    }

    $stmt->close();
}

$sql = "SELECT * FROM roller";
$roller_result = $conn->query($sql);

if (!$roller_result) {
    die("Sorgu hatası: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Paneli - Yeni Kullanıcı Ekle</title>
</head>
<body>
    <h1>Yeni Kullanıcı Ekle</h1>
    <form method="post" action="">
        <label for="kullanici_adi">Kullanıcı Adı:</label>
        <input type="text" id="kullanici_adi" name="kullanici_adi" required>
        <br>
        <label for="sifre">Şifre:</label>
        <input type="password" id="sifre" name="sifre" required>
        <br>
        <label for="rol_id">Rol:</label>
        <select id="rol_id" name="rol_id" required>
            <?php while($rol = $roller_result->fetch_assoc()) { ?>
                <option value="<?php echo $rol['id']; ?>"><?php echo $rol['rol_adi']; ?></option>
            <?php } ?>
        </select>
        <br>
        <input type="submit" value="Kullanıcı Ekle">
    </form>
</body>
</html>
