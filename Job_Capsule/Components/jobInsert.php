<?php
require "../libs/functions.php";

// Değişkenlerin tanımlanması ve başlangıç değerleri
$title = $short_description = $long_description = $location = $last_modified_by = "";
$title_err = $short_description_err = $long_description_err = $location_err = $last_modified_by_err = "";

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

    // Son değişikliği yapan kişi doğrulama
    $input_last_modified_by = trim($_POST["last_modified_by"]);
    if (empty($input_last_modified_by)) {
        $last_modified_by_err = "Son değişikliği yapan kişi boş geçilemez.";
    } else {
        $last_modified_by = Security($input_last_modified_by);
    }

    $isDeleted = 0; // Varsayılan olarak iş ilanı silinmemiştir
    $isActive = 0; // Varsayılan olarak iş ilanı aktif değildir

    $created_on = date("Y-m-d H:i:s");
    $created_by = "admin";
    $last_modified_on = date("Y-m-d H:i:s");

    if (empty($title_err) && empty($short_description_err) && empty($long_description_err) && empty($location_err) && empty($last_modified_by_err)) {
        // createJob fonksiyonunu çağır ve dönen değeri kontrol et
        $job_created = createJob($title, $short_description, $long_description, $location, $isDeleted, $isActive, $created_on, $created_by, $last_modified_on, $last_modified_by);

        // Eğer iş ilanı başarıyla eklendiyse
        if ($job_created) {
            // Başarılı mesajını ayarla
            $_SESSION['message'] = $title . " isimli iş ilanı eklendi";
            $_SESSION['type'] = "success";
            // Yönlendirme yap
            header('Location: admin.php');
            // Kodun burada sonlanması için exit() fonksiyonunu kullan
            exit();
        } else {
            // Eğer iş ilanı eklenemediyse hata mesajını görüntüle
            echo "Hata oluştu.";
        }
    }
}
?>

<?php include "admin-nav.php"; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


<div class="container my-3">
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
                            <label for="last_modified_by" class="form-label">Son Değişiklik Tarihi </label>
                            <input type="date" name="last_modified_on" id="last_modified_on"
                                class="form-control <?php echo (!empty($last_modified_on_err)) ? 'is-invalid' : '' ?>"
                                value="<?php echo $last_modified_on; ?>">
                            <span class="invalid-feedback"><?php echo $last_modified_on_err ?></span>
                        </div>

                        <input type="submit" value="Kaydet" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>