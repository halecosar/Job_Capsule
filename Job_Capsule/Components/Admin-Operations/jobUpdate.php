<?php
require "../../libs/functions.php";
include "admin-nav.php";
session_start();

// Değişkenlerin tanımlanması ve başlangıç değerleri
$title = $short_description = $long_description = $location = $isActive = "";

// Form gönderildiğinde POST isteğiyle çalışacak kod
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Formdan gelen verilerin alınması ve doğrulanması
    $id = $_POST['id'];
    $input_title = trim($_POST["title"]);
    $input_short_description = trim($_POST["short_description"]);
    $input_long_description = trim($_POST["long_description"]);
    $input_location = trim($_POST["location"]);
    $isActive = isset($_POST["isActive"]) ? 1 : 0;

    // Veriler doğruysa güncelleme işlemi yapılır

    if (editJob($id, $input_title, $input_short_description, $input_long_description, $input_location, $isActive)) {
        $_SESSION['message'] = "İş ilanı başarıyla güncellendi.";
        $_SESSION['type'] = "success";
        header('Location: jobList.php');
        exit();
    } else {
        echo "Hata oluştu.";
    }
}

// Sayfaya get ile gelen id parametresini al
$id = $_GET['id'] ?? null;

// ID parametresi boşsa veya geçersizse hata mesajı göster
if (!$id) {
    echo "Geçersiz iş ilanı ID";
    exit;
}

// ID'ye göre ilgili iş ilanını getir
$job = getJobByID($id);

// İş ilanı bulunamazsa hata mesajı göster
if (!$job) {
    echo "İş ilanı bulunamadı";
    exit;
}

// Formda ön tanımlı değerler için ilan verisini değişkenlere ata
$title = $job['title'];
$short_description = $job['short_description'];
$long_description = $job['long_description'];
$location = $job['location'];
$isActive = $job['isActive'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İş İlanı Güncelle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">İş İlanı Güncelle</h2>
                        <form action="jobUpdate.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="title">Başlık</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="<?php echo $title; ?>">
                            </div>

                            <div class="form-group">
                                <label for="short_description">Kısa Açıklama</label>
                                <textarea name="short_description" id="short_description"
                                    class="form-control"><?php echo $short_description; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="long_description">Uzun Açıklama</label>
                                <textarea name="long_description" id="long_description"
                                    class="form-control"><?php echo $long_description; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="location">Konum</label>
                                <input type="text" name="location" id="location" class="form-control"
                                    value="<?php echo $location; ?>">
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="isActive" name="isActive" <?php if ($isActive == 1)
                                    echo "checked"; ?>>
                                <label class="form-check-label" for="isActive">Aktif İlan</label>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>