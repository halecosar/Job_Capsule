<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakkımızda</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<?php
require "navbar.php";
?>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <img src="../img/about-us.png" class="img-fluid" alt="About Us">
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <h2 class="text-center">Referanslarımız</h2>
                <div class="d-flex justify-content-around align-items-center flex-wrap">

                    <img src="../img/ref2.jpg" class="img-fluid m-3" alt="Company 2" style="max-height: 100px;">
                    <img src="../img/ref5.png" class="img-fluid m-3" alt="Company 1" style="max-height: 100px;">
                    <img src="../img/ref6.png" class="img-fluid m-3" alt="Company 2" style="max-height: 100px;">
                    <img src="../img/ref7.jpeg" class="img-fluid m-3" alt="Company 3" style="max-height: 100px;">
                    <img src="../img/ref8.png" class="img-fluid m-3" alt="Company 4" style="max-height: 100px;">
                    <img src="../img/ref9.png" class="img-fluid m-3" alt="Company 4" style="max-height: 100px;">


                </div>
            </div>
        </div>
    </div>
    <?php
    require "../Pages/footer.php";
    ?>
</body>

</html>