<?php
// session_start();
?>

<?php
require "navbar.php";
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hesap Bilgileri</title>

</head>

<body>
    <div class="container mt-5">
        <div class="alert alert-primary" role="alert">
            <?php echo "Hoşgeldiniz " . htmlspecialchars($_SESSION['mail']); ?>
        </div>
        <div class="list-group">
            <a href="hesap-bilgileri.php" class="list-group-item list-group-item-action active" aria-current="true">
                Hesap Bilgileri
            </a>
            <a href="ozgecmis-degistir.php" class="list-group-item list-group-item-action">Özgeçmişimi Değiştir</a>
            <a href="destek-talebi.php" class="list-group-item list-group-item-action">Destek Talebi</a>
            <a href="hesap-sil.php" class="list-group-item list-group-item-action">H