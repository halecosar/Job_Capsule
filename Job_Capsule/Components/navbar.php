<?php
session_start();
$loggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Capsule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar {
            background-color: #191769 !important;
            /* Navbar arka plan rengi */
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;

        }

        .navbar-nav .nav-link:hover {
            color: #ffffff !important;

        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand me-2" href="Home.php">
                <img src="../img/jc-logo1.png" style="width: 50px;" alt="Job Capsule Logo">
            </a>
            <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarButtonsExample"
                aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarsButtonsExample">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION["loggedin"])): ?>

                        <li class="nav-item">
                            <a class="nav-link" href="Home.php">Anasayfa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="my-applications.php">Başvurularım</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="job-posting.php">İş İlanları</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profilim</a>
                        </li>

                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="Home.php">Anasayfa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about-us.php">Hakkımızda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="job-posting.php">İş İlanları</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Communication.php">İletişim</a>
                        </li>


                    <?php endif; ?>

                </ul>



                <?php if (!$loggedIn): ?>
                    <div class="d-flex align-items-center">
                        <a class="btn btn-outline-primary nav-link" href="../Pages/login.php"> Giriş Yap</a>
                        <a class="btn btn-outline-primary nav-link" href="../Pages/register.php">Kayıt Ol</a>
                    </div>
                <?php else: ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" style="color:blue; font-weight:dark; text-align:right;">
                                <?php echo "Hoşgeldiniz " . htmlspecialchars($_SESSION['mail']); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-primary nav-link" href="../Pages/logout.php">Logout</a>
                        </li>
                    </ul>
                <?php endif; ?>



            </div>
        </div>
    </nav>


    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>


</html>