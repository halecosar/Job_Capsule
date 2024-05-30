<?php
require "../../libs/functions.php";
include "admin-nav.php";
session_start();

if (empty($_SESSION["loggedin"])) {
    header("Location: ../../Pages/login.php");
}
// Değişkenlerin tanımlanması ve başlangıç değerleri
$title = $short_description = $long_description = $location = $isActive = "";
$title_err = $short_description_err = $long_description_err = $location_err = $isActive_err = "";

// Form gönderildiğinde POST isteğiyle çalışacak kod
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Başlık doğrulama
    $input_title = trim($_POST["title"]);
    if (empty($input_title)) {
        $title_err = "Başlık boş geçilemez.";
    } else if (strlen($input_title) > 150) {
        $title_err = "Başlık için çok fazla karakter girdiniz.";
    } else {
        $title = Security($input_title);
    }

    // Kısa açıklama doğrulama
    $input_short_description = trim($_POST["short_description"]);
    if (empty($input_short_description)) {
        $short_description_err = "Kısa açıklama boş geçilemez.";
    } else if (strlen($input_short_description) < 10) {
        $short_description_err = "Kısa açıklama için çok az karakter girdiniz.";
    } else {
        $short_description = Security($input_short_description);
    }

    // Uzun açıklama doğrulama
    $input_long_description = trim($_POST["long_description"]);
    if (empty($input_long_description)) {
        $long_description_err = "Uzun açıklama boş geçilemez.";
    } else if (strlen($input_long_description) < 20) {
        $long_description_err = "Uzun açıklama için çok az karakter girdiniz.";
    } else {
        $long_description = Security($input_long_description);
    }

    // Konum doğrulama
    $input_location = trim($_POST["location"]);

    if (empty($input_location)) {
        $location_err = "Konum boş geçilemez.";
    } else {
        $location = Security($input_location);
    }

    $isActive = intval($_POST["isActive"]); //sayfadan post edilen datayı integer'a çevirdik.

    $isDeleted = 0; // Varsayılan olarak iş ilanı silinmemiştir
    $created_on = date("Y-m-d H:i:s");
    $created_by = "admin";
    $last_modified_on = date("Y-m-d H:i:s");

    if (empty($title_err) && empty($short_description_err) && empty($long_description_err) && empty($location_err) && empty($last_modified_by_err)) {
        // createJob fonksiyonunu çağır ve dönen değeri kontrol et
        $job_created = createJob($title, $short_description, $long_description, $location, $isDeleted, $isActive, $created_by, $last_modified_by);

        // Eğer iş ilanı başarıyla eklendiyse
        if ($job_created) {
            // Başarılı mesajını ayarla
            $_SESSION['message'] = $title . " isimli iş ilanı eklendi";
            $_SESSION['type'] = "success";
            // Yönlendirme yap
            header('Location: JobList.php');
            // Kodun burada sonlanması için exit() fonksiyonunu kullan
            exit();
        } else {
            // Eğer iş ilanı eklenemediyse hata mesajını görüntüle
            echo "Hata oluştu.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="jobInsert.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="title" class="form-label">Başlık</label>
                                <input type="text" name="title" id="title"
                                    class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : '' ?>"
                                    value="<?php echo $title; ?>">
                                <span class="invalid-feedback"><?php echo $title_err ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="short_description" class="form-label">Kısa Açıklama</label>
                                <textarea name="short_description" id="short_description"
                                    class="form-control <?php echo (!empty($short_description_err)) ? 'is-invalid' : '' ?>"><?php echo $short_description; ?></textarea>
                                <span class="invalid-feedback"><?php echo $short_description_err ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="long_description" class="form-label">Uzun Açıklama</label>
                                <textarea name="long_description" id="long_description"
                                    class="form-control <?php echo (!empty($long_description_err)) ? 'is-invalid' : '' ?>"><?php echo $long_description; ?></textarea>
                                <span class="invalid-feedback"><?php echo $long_description_err ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="location" class="form-label">Konum</label>
                                <input type="text" name="location" id="location"
                                    class="form-control <?php echo (!empty($location_err)) ? 'is-invalid' : '' ?>"
                                    value="<?php echo $location; ?>">
                                <span class="invalid-feedback"><?php echo $location_err ?></span>
                            </div>


                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="isActive" class="form-label">Aktif İlan</label>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="checkbox" name="isActive" id="isActive"
                                            class="form-check-input <?php echo (!empty($isActive_err)) ? 'is-invalid' : '' ?>"
                                            value="1" <?php echo ($isActive == 1) ? 'checked' : ''; ?>>
                                        <span class="invalid-feedback"><?php echo $isActive_err ?></span>
                                    </div>
                                </div>



                            </div>



                            <input type="submit" value="Kaydet" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>