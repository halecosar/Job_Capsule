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
$status = $recruiterNote = "";

// Form gönderildiğinde POST isteğiyle çalışacak kod
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Formdan gelen verilerin alınması ve doğrulanması
    $id = $_POST['id'];

    $input_status = trim($_POST["status"]);
    $input_recruiterNote = trim($_POST["recruiterNote"]);



    // Veriler doğruysa güncelleme işlemi yapılır



    if (editApplication($id, $input_status, $input_recruiterNote)) {
        $_SESSION['message'] = "Başvuru Başarıyla Güncellendi.";
        $_SESSION['type'] = "success";
        header('Location: applications.php');
        exit();
    } else {
        echo "Hata oluştu.";
    }
}

// Sayfaya get ile gelen id parametresini al

$id = $_GET['id'] ?? null;
// ID parametresi boşsa veya geçersizse hata mesajı göster
if (!$id) {
    echo "Geçersiz başvuru ID";
    exit;
}

$application = getApplicationByID($id);

if (!$application) {
    echo "Başvuru bulunamadı";
    exit;
}



// Formda ön tanımlı değerler için ilan verisini değişkenlere ata

$recruiterNote = $application['recruiterNote'];
$status = $application['status'];


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
                        <form action="applicationUpdate.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="status">Süreç Statüsü</label>
                                <select name="status" id="typestatus" class="form-control">
                                    <?php
                                    $statusMap = [
                                        '1' => 'Başvuru Alındı',
                                        '2' => 'İnsan Kaynakları Görüşmesi Bekleniyor',
                                        '3' => 'İnsan Kaynakları Görüşmesi Gerçekleşti',
                                        '4' => 'Case İletildi',
                                        '5' => 'Teknik Görüşme Bekleniyor',
                                        '6' => 'Teknik Görüşme Gerçekleşti',
                                        '7' => 'Teklif Aşaması',
                                        '8' => 'Aday Uygun Değil',
                                        '9' => 'Teklif Kabul',
                                        '10' => 'Aday Süreçten Çekildi'
                                    ];

                                    foreach ($statusMap as $value => $label) {
                                        $selected = ($status == $value) ? 'selected' : '';
                                        echo "<option value=\"$value\" $selected>$label</option>";
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="recruiterNote">Görüşme Notu</label>
                                <input type="text" id="typerecruiterNote" class="form-control" name="recruiterNote"
                                    value="<?php echo htmlspecialchars($recruiterNote); ?>" />





                                <button type="submit" class="btn btn-primary mt-3">Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>