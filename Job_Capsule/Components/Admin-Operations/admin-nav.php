<?php
session_start();

if (isset($_SESSION["role"]) && $_SESSION["role"] == 0) {
    echo "Oturum hatası: Aday rolüyle işlem yapılamaz!";
    header("location: ../../Pages/logout.php");
    exit();
}

if (empty($_SESSION["loggedin"])) {
    header("Location: ../../Pages/login.php");
}
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
            /* Navbar bağlantı metin rengi */
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff !important;
            /* Navbar bağlantı metin rengi - hover durumunda */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">

        <div class="container">

            <a class="navbar-brand me-2" href="https://mdbgo.com/">

            </a>


            <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarButtonsExample"
                aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>


            <div class="collapse navbar-collapse" id="navbarButtonsExample">

                <a class="navbar-brand me-2">
                    <img src="../../img/jc-logo1.png" style="width: 50px;" alt="Job Capsule Logo">
                </a>

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-homepage.php">Anasayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="JobList.php">İlanlar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="candidate.php">Adaylar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="applications.php">Başvurular</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report.php">Rapor Görüntüle</a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" style="color:blue; font-weight:dark; text-align:right;">
                            <?php echo "Hoşgeldiniz " . $_SESSION['mail']; ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-outline-primary nav-link" href="../../Pages/logout.php">Logout</a>
                    </li>
                </ul>




            </div>

    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+9hlBX7EjPbbQK8CVf1KnvM6W4w1I"
        crossorigin="anonymous"></script>

</body>

</html>