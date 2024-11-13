<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

$dir = '../static';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $targetFile = $dir . '/' . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        echo "<p>Dosya başarıyla yüklendi.</p>";
    } else {
        echo "<p>Dosya yüklenemedi.</p>";
    }
}

if (isset($_GET['delete'])) {
    $fileToDelete = $dir . '/' . basename($_GET['delete']);
    if (file_exists($fileToDelete)) {
        unlink($fileToDelete);
        echo "<p>Dosya başarıyla silindi.</p>";
    } else {
        echo "<p>Dosya bulunamadı.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Yönetim Paneli</title>
</head>
<body>
    <h2>Yönetim Paneli</h2>

    <h3>Yeni Dosya Yükle</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Yükle</button>
    </form>

    <h3>Mevcut Dosyalar</h3>
    <ul>
        <?php
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            echo "<li>$file - <a href='dashboard.php?delete=$file'>Sil</a></li>";
        }
        ?>
    </ul>
</body>
</html>
