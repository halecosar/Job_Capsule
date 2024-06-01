<?php
require "../../libs/functions.php";
require "../../libs/config.php";
include "admin-nav.php";
// session_start();

if (empty($_SESSION["loggedin"])) {
    header("Location: ../../Pages/login.php");
}
// Değişkenlerin tanımlanması ve başlangıç değerleri
$fullname = $mail = $phone = "";
$fullnameErr = $mailErr = $phoneErr = "";

// Form gönderildiğinde POST isteğiyle çalışacak kod
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ad-Soyad doğrulama
    $input_fullname = trim($_POST["fullname"]);
    if (empty($input_fullname)) {
        $fullnameErr = "Ad-Soyad boş geçilemez.";
    } else if (strlen($input_fullname) < 3) {
        $fullnameErr = "Ad-Soyad için az karakter girdiniz.";
    } else {
        $fullname = Security($input_fullname);
    }



    if (empty(trim($_POST["mail"]))) {
        $mailErr = "mail girmelisiniz";
    } else {
        $sql = "select id FROM users where mail = ?";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            $param_email = trim($_POST["mail"]);
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $mailErr = "mail daha önce kullanılmıştır.";
                } else {
                    $mail = $_POST["mail"];
                }
            } else {
                echo mysqli_error($connection);
                echo "hata oluştu";
            }
        }
    }

    if (empty(trim($_POST["phone"]))) {
        $phoneErr = "telefon numarası girmelisiniz";
    } else if (strlen($_POST["phone"]) < 10 || strlen($_POST["phone"]) > 10) {
        $phoneErr = "telefon numarasını başında 0 olmadan 10 haneli giriniz.";
    } else if (!preg_match('/^[0-9]*$/', $_POST["phone"])) {
        $phoneErr = "telefon numarası sadece rakamlardan oluşmalıdır.";
    } else {
        $phone = $_POST["phone"];
    }




    if (empty($fullnameErr) && empty($mailErr) && empty($phoneErr)) {
        // CandidateAdd fonksiyonunu çağır ve dönen değeri kontrol et
        $candidate_created = CandidateAdd($mail, $phone, $fullname);

        // Eğer iş ilanı başarıyla eklendiyse
        if ($candidate_created) {
            // Başarılı mesajını ayarla
            $_SESSION['message'] = $fullname . " isimli aday ilanı eklendi";
            $_SESSION['type'] = "success";
            // Yönlendirme yap
            header('Location: candidate.php');
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
                        <form action="candidateInsert.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Aday Ad-Soyad</label>
                                <input type="text" name="fullname" id="fullname"
                                    class="form-control <?php echo (!empty($fullnameErr)) ? 'is-invalid' : '' ?>"
                                    value="<?php echo $fullname; ?>">
                                <span class="invalid-feedback"><?php echo $fullnameErr ?></span>
                            </div>

                            <div mb-3="form-outline form-white mb-3">
                                <label class="form-label" for="mail">Mail Adresi</label>
                                <input type="email" id="typemail" name="mail"
                                    class="form-control form-control-sm <?php echo (!empty($mailErr)) ? 'is-invalid' : '' ?>"
                                    value="<?php echo htmlspecialchars($mail); ?>" />
                                <span class="invalid-feedback"><?php echo $mailErr ?></span>
                            </div>

                            <div mb-3="form-outline form-white mb-3">
                                <label class="form-label" for="phone">Telefon</label>
                                <input type="text" id="typephone" name="phone"
                                    class="form-control form-control-sm <?php echo (!empty($phoneErr)) ? 'is-invalid' : '' ?>"
                                    value="<?php echo htmlspecialchars($phone); ?>" />
                                <span class="invalid-feedback"><?php echo $phoneErr ?></span>
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