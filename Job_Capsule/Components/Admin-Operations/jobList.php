<?php
require_once "../../libs/functions.php";
include "admin-nav.php";

if (isset($_SESSION["role"]) && $_SESSION["role"] == 0) {
    echo "Oturum hatası: Aday rolüyle işlem yapılamaz!";
    header("location: ../../Pages/logout.php");
    exit();
}
if (empty($_SESSION["loggedin"])) {
    header("Location: ../../Pages/login.php");
}


$page = 1;


if (isset($_GET["page"]) && is_numeric($_GET["page"]))
    $page = $_GET["page"];


//Tüm ilanları dbden okumak için yazılan metod çağırılır.
$result = getAllJobs($page);

$total_jobs = $result["totalCount"];
$data = $result["data"];
$total_pages = $result["total_pages"];

// Veritabanından gelen iş ilanlarıyla bir tablo oluşturuldu. 
function createJobTable($data)
{
    $html = '<table class="table">';
    $html .= '<thead><tr><th>İlan Başlığı</th><th>İlan Açıklama</th><th>Konum</th><th>İşlemler</th></tr></thead>';
    $html .= '<tbody>';
    foreach ($data as $job) {
        $html .= '<tr>';
        $html .= '<td>' . $job['title'] . '</td>';
        $html .= '<td>' . $job['short_description'] . '</td>';
        $html .= '<td>' . $job['location'] . '</td>';
        $html .= '<td>';
        $html .= '<a href="jobUpdate.php?id=' . $job['id'] . '" class="btn btn-warning btn-sm mb-1">Güncelle</a>';
        $html .= '<a href="jobDelete.php?id=' . $job['id'] . '" class="btn btn-danger btn-sm">Sil</a>';
        $html .= '</td>';
        $html .= '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>İş İlanları</h1>
        <a href="jobInsert.php" class="btn btn-primary btn-large float-right mb-2">Yeni İlan Yayınla</a>


        <?php echo createJobTable($data); ?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="JobList.php?page=<?php echo ($page - 1); ?>">Önceki</a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page)
                        echo 'active'; ?>"><a class="page-link"
                            href="JobList.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link"
                            href="JobList.php?page=<?php echo ($page + 1); ?>">Sonraki</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['type']);
                ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>