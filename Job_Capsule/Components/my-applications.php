<?php

include_once "../libs/functions.php";
?>

<?php
$keyword = "";
$page = 1;
require "navbar.php";

if (isset($_SESSION["role"]) && $_SESSION["role"] == 1) {
    echo "Oturum hatası: Admin rolüyle işlem yapılamaz!";
    header("location: ../Pages/logout.php");
    exit();
}

if (empty($_SESSION["loggedin"])) {
    header("Location: ../Pages/login.php");
}

// Sessionda kullanıcı ID'sini kontrol et varsa, değişkeni tanımla yoksa  hata mesajı görüntüle
if (isset($_SESSION['userId'])) {
    $user_id = $_SESSION['userId'];

} else {

    echo "Oturum hatası: Kullanıcı oturumu bulunamadı!";

}

if (isset($_GET["q"]))
    $keyword = $_GET["q"];
if (isset($_GET["page"]) && is_numeric($_GET["page"]))
    $page = $_GET["page"];

$result = getAllApplications($user_id, $keyword, $page);

$totalCount = $result["totalCount"];
$data = $result["data"];
$totalPages = $result["total_pages"];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Hakkımızda</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>


<body>
    <div class="container mt-5">
        <div class="container">
            <form class="d-flex justify-content-end mt-2 mb-2">
                <input class="form-control me-2" name="q" style="width:100px" type="search" placeholder="Ara"
                    aria-label="  Search" value="<?= Security($keyword) ?>">
                <button class="btn btn-outline-primary" type="submit">İlan Ara</button>
            </form>
        </div>

        <div class="container">
            <div class="row">
                <h4><?php echo $totalCount . " adet başvurunuz bulunmaktadır "; ?></h4>
            </div>
            <?php if (mysqli_num_rows($data) > 0): ?>
                <div class="row">
                    <?php while ($job = mysqli_fetch_assoc($data)): ?>
                        <div class="col-md-4">
                            <div class="card mb-5">
                                <h5 class="card-header"><?= htmlspecialchars($job['title']) ?></h5>
                                <div class="card-body">
                                    <p class="card-text"><?= htmlspecialchars($job['short_description']) . "..." ?></p>
                                    <h5 class="card-text"><?= htmlspecialchars($job['location']) ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    İlan bulunamadı.
                </div>
            <?php endif; ?>
        </div>


        <div class="container">
            <div class="row">
                <?php if ($totalPages > 1): ?>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php for ($x = 1; $x <= $totalPages; $x++): ?>
                                <li class="page-item <?php if ($x == $page)
                                    echo "active" ?>"><a class="page-link" href="
    
        <?php
                                $url = "?page=" . $x;

                                if (!empty($keyword)) {
                                    $url .= "&q=" . $keyword;
                                }
                                echo $url;

                                ?>
    
    
    
    
    "><?php echo $x; ?></a></li>
                            <?php endfor; ?>
                        </ul>
                    </nav>

                <?php endif; ?>
            </div>
        </div>

    </div>
    <?php include "../Pages/footer.php"; ?>
</body>




</html>