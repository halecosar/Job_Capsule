<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
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

<?php
require "navbar.php";
?>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 mb-2">
                <h2>Bize Ulaşın</h2>


                <div id="map"></div>
            </div>
            <br>
            <div class="col-6 mt-5">
                <br>
                <br>
                <br>
                <form action="communication.php" method="post" class="contact-form">
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

    <?php
    require "../Pages/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
        </script>
</body>

</html>


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