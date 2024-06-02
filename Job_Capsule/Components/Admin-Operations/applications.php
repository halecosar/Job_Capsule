<?php
require_once "../../libs/functions.php";
include "admin-nav.php";

// session_start();

if (empty($_SESSION["loggedin"])) {
    header("Location: ../../Pages/login.php");
}

$keyword = "";
$page = 1;

if (isset($_GET["q"]))
    $keyword = $_GET["q"];
if (isset($_GET["page"]) && is_numeric($_GET["page"]))
    $page = $_GET["page"];

$result = getApplications($keyword, $page);

$total_candidates = $result["totalCount"];
$data = $result["data"];
$total_pages = $result["total_pages"];

function createApplicationTable($data)
{
    $statusMap = [
        '1' => 'Başvuru Alındı',
        '2' => 'İnsan Kaynakları Görüşmesi Bekleniyor',
        '3' => 'İnsan Kaynakları Görüşmesi Gerçekleşti',
        '4' => 'Case İletildi',
        '5' => 'Teknik Görüşme Bekleniyor',
        '6' => 'Teknik Görüşme Gerçekleşti',
        '7' => 'Teklif Aşaması',
        '8' => 'Aday Uygun Değil',
        '9' => 'Teklif Kabul',
        '10' => 'Aday Süreçten Çekildi'
    ];

    $html = '<table class="table">';
    $html .= '<thead><tr><th>Başvurulan İlan</th><th>Ad-Soyad</th><th>Mail</th><th>Telefon</th><th>Toplam Tecrübe Yılı</th><th>Aday Aşama</th><th>Aşama Güncelle</th><th>CV</th></tr></thead>';
    $html .= '<tbody>';
    foreach ($data as $application) {
        $html .= '<tr>';
        $html .= '<td>' . $application['title'] . '</td>';
        $html .= '<td>' . $application['fullname'] . '</td>';
        $html .= '<td>' . $application['mail'] . '</td>';
        $html .= '<td>' . $application['phone'] . '</td>';
        $html .= '<td>' . $application['experienceYear'] . '</td>';

        $statusText = isset($statusMap[$application['status']]) ? $statusMap[$application['status']] : 'Bilinmeyen Durum';
        $html .= '<td>' . $statusText . '</td>';

        $html .= '<td>';
        $html .= '<a href="applicationUpdate.php?id=' . $application['Id'] . '" class="btn btn-warning btn-sm mb-1" style="width: 130px;">Update</a>';
        $html .= '</td>';

        $html .= '<td>';
        $html .= '<a href="pdfviewer.php?id=' . $application['Id'] . '&pdf=' . $application['cvfilename'] . '" class="btn btn-info btn-sm mb-1" style="width: 130px;">Cv Görüntüle</a>';
        $html .= '</td>';

        $html .= '</tr>';
    }
    $html .= '</tbody></table>';
    return $html;
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Başvurular</h1>

        <?php echo createApplicationTable($data); ?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link"
                            href="applications.php?page=<?php echo ($page - 1); ?>">Previous</a></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page)
                        echo 'active'; ?>"><a class="page-link"
                            href="applications.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link"
                            href="applications.php?page=<?php echo ($page + 1); ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</body>

</html>