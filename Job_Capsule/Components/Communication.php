<?php
require "navbar.php";

if (isset($_SESSION["role"]) && $_SESSION["role"] == 1) {
    echo "Oturum hatası: Admin rolüyle işlem yapılamaz!";
    header("location: ../Pages/logout.php");
    exit();
}

if (empty($_SESSION["loggedin"])) {
    header("Location: ../Pages/login.php");
}


// Formdan gelen verileri işleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // E-posta başlık ve içeriğini oluşturma
    $subject = "İletişim Formu: " . $name;
    $email_body = "Ad-Soyad: " . $name . "\n";
    $email_body .= "E-posta: " . $email . "\n\n";
    $email_body .= "Mesaj:\n" . $message;

    // Gönderen e-posta adresi
    $headers = "From: gonderen@example.com";

    // E-postayı gönder
    if (mail("halealtunakar@hotmail.com", $subject, $email_body, $headers)) {
        $message = "E-posta başarıyla gönderildi.";
    } else {
        $error_message = "E-posta gönderilirken bir hata oluştu.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #map {
            height: 400px;
            width: 100%;
        }

        h2 {
            margin-bottom: 20px;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .contact-form textarea {
            height: 100px;
        }

        .contact-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        .contact-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <h2>Bize Ulaşın</h2>
            <div class="col-md-6 mb-3">

                <div id="map"></div>
            </div>
            <div class="col-md-6 mb-3">
                <form action="#" method="post" class="contact-form">
                    <input type="text" name="name" placeholder="Adınız Soyadınız" required>
                    <input type="email" name="email" placeholder="E-posta Adresiniz" required>
                    <textarea name="message" placeholder="Mesajınız" required></textarea>
                    <button type="submit">Gönder</button>
                </form>
                <!-- E-posta gönderme sonucunu kullanıcıya gösterme -->
                <?php if (isset($message)): ?>
                    <div class="alert alert-success"><?php echo $message; ?></div>
                <?php endif; ?>
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function initMap() {
            var myLatLng = { lat: 41.0082, lng: 28.9784 }; // İstanbul koordinatları
            var map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 13
            });
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Biz Buradayız!'
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
</body>

<footer>
    <?php include "../Pages/footer.php"; ?>
</footer>

</html>