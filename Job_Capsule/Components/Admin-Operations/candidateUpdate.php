<?php
require "../../libs/functions.php";
include "admin-nav.php";
if (isset($_SESSION["role"]) && $_SESSION["role"] == 0) {
    echo "Oturum hatası: Aday rolüyle işlem yapılamaz!";
    header("location: ../../Pages/logout.php");
    exit();
}

if (empty($_SESSION["loggedin"])) {
    header("Location: ../../Pages/login.php");
}

// Değişkenlerin tanımlanması ve başlangıç değerleri
$mail = $phone = $fullname = $experienceYear = $lastCompany = $lastTitle = "";

// Form gönderildiğinde POST isteğiyle çalışacak kod
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Formdan gelen verilerin alınması ve doğrulanması
    $id = $_POST['id'];
    $input_fullname = trim($_POST["fullname"]);
    $input_phone = trim($_POST["phone"]);
    $input_mail = trim($_POST["mail"]);
    $input_lastTitle = trim($_POST["lastTitle"]);
    $input_lastCompany = trim($_POST["lastCompany"]);
    $input_experienceYear = trim($_POST["experienceYear"]);


    // Veriler doğruysa güncelleme işlemi yapılır



    if (editCandidate($id, $input_mail, $input_phone, $input_fullname, $input_lastTitle, $input_lastCompany, $input_experienceYear)) {
        $_SESSION['message'] = "Aday Bilgileri Başarıyla Güncellendi.";
        $_SESSION['type'] = "success";
        header('Location: candidate.php');
        exit();
    } else {
        echo "Hata oluştu.";
    }
}


$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Geçersiz aday ID";
    exit;
}

// ID'ye göre ilgili iş ilanını getir
$candidate = getCandidateByID($id);


if (!$candidate) {
    echo "Aday bulunamadı";
    exit;
}




$fullname = $candidate['fullname'];
$mail = $candidate['mail'];
$phone = $candidate['phone'];
$lastTitle = $candidate['lastTitle'];
$lastCompany = $candidate['lastCompany'];
$experienceYear = $candidate['experienceYear'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aday Bilgisi Güncelle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Aday Bilgisi Güncelle</h2>
                        <form action="candidateUpdate.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">


                            <div class="form-group">
                                <label for="fullname">Ad-Soyad</label>
                                <input type="text" name="fullname" id="fullname" class="form-control"
                                    value="<?php echo $fullname; ?>">
                            </div>

                            <div class="form-group">
                                <label for="mail">Mail Adresi</label>
                                <input type="email" name="mail" id="typemail" class="form-control"
                                    value="<?php echo htmlspecialchars($mail); ?>" />

                            </div>

                            <div class="form-group">
                                <label for="phone">Telefon</label>
                                <input type="text" id="typephone" class="form-control" name="phone"
                                    value="<?php echo htmlspecialchars($phone); ?>" />

                            </div>
                            <div class="form-group">
                                <label for="lastTitle">Son Şirketindeki Ünvan</label>
                                <input type="text" class="form-control" id="typelastTitle" name="lastTitle"
                                    value="<?php echo htmlspecialchars($lastTitle); ?>" />

                            </div>
                            <div class="form-group">
                                <label for="lastCompany">Son Çalıştığı Firma </label>
                                <input type="text" class="form-control" id="typelastCompany" name="lastCompany"
                                    value="<?php echo htmlspecialchars($lastCompany); ?>" />

                            </div>

                            <div class="form-group">
                                <label for="experienceYear">Toplam Çalışma Yılı </label>
                                <input type="text" id="typeexperienceYear" class="form-control" name="experienceYear"
                                    value="<?php echo htmlspecialchars($experienceYear); ?>" />

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