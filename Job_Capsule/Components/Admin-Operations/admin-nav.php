<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Capsule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="admin-homepage.php">Anasayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="JobList.php">İlanlar</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" style="color:blue; font-weight:dark; text-align:right;">
                            <?php echo "Hoşgeldiniz " . $_SESSION['mail']; ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="btn btn-outline-primary nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>




            </div>

    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+9hlBX7EjPbbQK8CVf1KnvM6W4w1I"
        crossorigin="anonymous"></script>

</body>

</html>