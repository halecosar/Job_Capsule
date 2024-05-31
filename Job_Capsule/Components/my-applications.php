<?php
include_once "../libs/functions.php";
require "navbar.php";

// Kullanıcı oturumunu başlat
// session_start();

// Oturumda kullanıcı ID'sini kontrol et
if (isset($_SESSION['userId'])) {
    // Oturumda kullanıcı ID'si varsa, değişkeni tanımlayın
    $user_id = $_SESSION['userId'];
} else {
    // Oturumda kullanıcı ID'si yoksa, bir hata mesajı görüntüleyin veya kullanıcıyı giriş yapmaya yönlendirin
    echo "Oturum hatası: Kullanıcı oturumu bulunamadı!";
    // Örneğin:
    // header("Location: login.php");
    // exit;
}

$keyword = "";
$page = 1;

if (isset($_GET["q"]))
    $keyword = $_GET["q"];
if (isset($_GET["page"]) && is_numeric($_GET["page"]))
    $page = $_GET["page"];

// Tüm başvuruları al
$result = getAllApplications($user_id, $keyword, $page);

// Sonucu kontrol et
if ($result === false) {
    // Fonksiyon başarısız olduysa hata mesajı göster
    echo "Başvurular alınırken bir hata oluştu. Lütfen daha sonra tekrar deneyin.";
} else {
    // Fonksiyon başarılı olduysa devam et
    $totalCount = $result["totalCount"];
    $data = $result["data"];
    $totalPages = $result["total_pages"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Başvurularım</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="container">
            <form class="d-flex justify-content-end mt-2 mb-2" action="my-applications.php" method="GET">
                <input class="form-control me-2" name="q" style="width:100px" type="search" placeholder="Search"
                    aria-label="Search" value="<?= htmlspecialchars($keyword) ?>">
                <button class="btn btn-outline-primary" type="submit">BAŞVURU Ara</button>
            </form>
        </div>

        <div class="container">
            <div class="row">
                <h4><?php echo $totalCount . " BAŞVURU gösteriliyor "; ?></h4>
            </div>
            <?php if (mysqli_num_rows($data) > 0): ?>
                <div class="row">
                    <?php while ($application = mysqli_fetch_assoc($data)): ?>
                        <div class="col-md-4">
                            <div class="card mb-5">
                                <div class="card-body">
                                    <p class="card-text"><?= htmlspecialchars($application['user_id']) ?></p>
                                    <h5 class="card-text"><?= htmlspecialchars($application['job_id']) ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    Başvuru bulunamadı.
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
                                    echo "active" ?>">
                                        <a class="page-link"
                                            href="my-applications.php?page=<?= $x ?>&q=<?= htmlspecialchars($keyword) ?>">
                                        <?php echo $x; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>