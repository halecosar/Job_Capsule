<?php
include_once "../libs/functions.php";
include "../libs/config.php";
require "navbar.php";

// Kullanıcı oturumunu kontrol et
if (!isset($_SESSION['userId'])) {
    // Kullanıcı oturumu yoksa giriş sayfasına yönlendir
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['userId'];
$error = "";
$success = "";

// Kullanıcı bilgilerini veritabanından çek
$query = "SELECT fullname, mail, phone, password FROM users WHERE id = ?";
if ($stmt = mysqli_prepare($connection, $query)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $fullname, $mail, $phone, $current_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $mail = trim($_POST["mail"]);
    $phone = trim($_POST["phone"]);
    $update_password = isset($_POST["update_password"]) ? true : false;
    $password = $update_password && isset($_POST["password"]) ? trim($_POST["password"]) : "";
    $confirm_password = $update_password && isset($_POST["confirm_password"]) ? trim($_POST["confirm_password"]) : "";

    if ($update_password && $password != $confirm_password) {
        $error = "Şifreler eşleşmiyor.";
    } else {
        if ($update_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $hashed_password = $current_password;
        }

        // Kullanıcı bilgilerini güncelle
        $update_query = "UPDATE users SET fullname = ?, mail = ?, phone = ?, password = ? WHERE id = ?";
        if ($stmt = mysqli_prepare($connection, $update_query)) {
            mysqli_stmt_bind_param($stmt, "ssssi", $fullname, $mail, $phone, $hashed_password, $user_id);
            if (mysqli_stmt_execute($stmt)) {
                $success = "Profiliniz başarıyla güncellendi.";
            } else {
                $error = "Profil güncelleme başarısız oldu.";
            }
            mysqli_stmt_close($stmt);
        }
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Güncelleme</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script>
        function togglePasswordFields() {
            var checkbox = document.getElementById('update_password');
            var passwordFields = document.getElementsByClassName('password-field');
            for (var i = 0; i < passwordFields.length; i++) {
                passwordFields[i].disabled = !checkbox.checked;
            }
        }
    </script>
</head>

<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <i class="fas fa-user-circle fa-6x"></i>
        </div>
        <h2>ÜYELİK BİLGİLERİM</h2>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <form action="profile.php" method="POST">
            <div class="form-group">
                <label for="fullname">Ad-Soyad</label>
                <input type="text" class="form-control" id="fullname" name="fullname"
                    value="<?= htmlspecialchars($fullname) ?>" required>
            </div>
            <div class="form-group">
                <label for="mail">E-posta</label>
                <input type="email" class="form-control" id="mail" name="mail" value="<?= htmlspecialchars($mail) ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="phone">Telefon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($phone) ?>"
                    required>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="update_password" name="update_password"
                    onclick="togglePasswordFields()" checked>
                <label class="form-check-label" for="update_password">Şifremi güncellemek istiyorum</label>
            </div>
            <div class="form-group">
                <label for="password">Şifre</label>
                <input type="password" class="form-control password-field" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Şifre Tekrar</label>
                <input type="password" class="form-control password-field" id="confirm_password" name="confirm_password"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Güncelle</button>
        </form>
    </div>
</body>

</html>