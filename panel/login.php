<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kullanıcı adı ve şifreyi kontrol et
    if ($username === 'admin' && $password === 'Bss12345**') {  // Kullanıcı adı ve şifreyi burada belirleyin
        $_SESSION['logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Hatalı kullanıcı adı veya şifre.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
</head>
<body>
    <h2>Giriş Yap</h2>
    <form method="post">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Şifre:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Giriş Yap</button>
    </form>
    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
</body>
</html>
