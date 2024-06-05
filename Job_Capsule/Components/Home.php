<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakkımızda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<?php
require "navbar.php";
?>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../img/carousel1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/carousel2.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../img/carousel3.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-7 ">
                <img src="../img/img_01.png" alt="">
            </div>

            <div class="col-md-5  ">
                <h2 style="margin-top:10px; color: #191769"> Sektörel Haberler</h2>
                <p style="font-weight:bold; margin-top:20px; color: #191769"> Teknolojiye daha fazla kadın eli değecek!
                </p>
                <p> Huawei, teknolojiye daha fazla kadın eli değmesi hedefiyle TEV işbirliğinde teknoloji ve bilişim
                    alanında öğrenim gören kız öğrencilerin eğitimine destek olacak “Huawei Teknoloji Bursu”
                    kampanyasını başlattı.</p>
                <p style="font-weight:bold; margin-top:30px; color: #191769">
                    Gelecek Vaad Eden Meslekler Nelerdir?
                </p>
                <p>
                <p style="font-weight:bold; margin-top:10px; color: #191769">
                    YEŞİL YAKALILAR ÖNEM KAZANACAK
                </p>
                Doğal kaynakların en iyi biçimde kullanılması, çevrenin korunması ve insan sağlığına uygun biçimde
                geliştirilmesi konusunda çalıştıkları için, bu alanda eğitim gören mühendislere/uzmanlara atıkların
                arıtılması, gerekli tesislerin kurulması, işletilmesi, yapılanların denetlenmesi, gürültü
                kaynaklarının belirlenmesi gibi birçok iş düşüyor.
                </p>
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