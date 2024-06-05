<?php
session_start();
$loggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"];

?>

<style>
    .navbar {
        background-color: #191769 !important;
    }

    .navbar-nav .nav-link {
        color: #ffffff !important;
    }

    .navbar-nav .nav-link:hover {
        color: #ffffff !important;
    }

    .btn-light,
    .btn-light:hover {
        color: #191769;
        background-color: white;
        border-color: #ffffff;
        font-weight: bold;
    }

    .navbar .d-inline-flex {
        margin-left: auto;
    }

    .navbar .btn {
        margin-right: 10px;
    }

    .navbar-nav.ms-auto {
        margin-left: auto;
    }
</style>

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
                    <li class="nav-item">
                        <a class="nav-link" href="Communication.php">İletişim</a>
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
                <?php endif; ?>
            </ul>

            <?php if (!$loggedIn): ?>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-light me-3" href="../Pages/login.php"> Giriş Yap</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light" href="../Pages/register.php">Kayıt Ol</a>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link">
                            <?php echo "Hoşgeldiniz! " . htmlspecialchars($_SESSION['mail']); ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light " style="color: #191769;" href="../Pages/logout.php">Çıkış Yap</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>