<?php
require_once "../../libs/functions.php";
include "admin-nav.php";
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// session_start();

if (empty($_SESSION["loggedin"])) {
    header("Location: ../../Pages/login.php");
}

$keyword = "";
$page = 1;
$selectedJobId = "";

if (isset($_GET["q"]))
    $keyword = $_GET["q"];
if (isset($_GET["page"]) && is_numeric($_GET["page"]))
    $page = $_GET["page"];
if (isset($_GET["job"]))
    $selectedJobId = $_GET["job"];

$result = getApplicationsForReport($keyword, $page, $selectedJobId);

$total_candidates = $result["totalCount"];
$data = $result["data"];
$total_pages = $result["total_pages"];

$jobsData = getJobs2();

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
    $html .= '<thead><tr><th>Başvurulan İlan</th><th>Ad-Soyad</th><th>Mail</th><th>Telefon</th><th>Toplam Tecrübe Yılı</th><th>Aday Aşama</th></tr></thead>';
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
    <title>Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Raporlar</h1>
        <br>

        <div class="form-group">
            <label for="jobSelect">İlan Seçiniz</label>
            <select class="form-control" id="jobSelect" name="job">
                <option value="">Tümü</option>
                <?php
                if ($jobsData['totalCount'] > 0) {
                    while ($job = mysqli_fetch_assoc($jobsData['data'])) {
                        $selected = ($job['id'] == $selectedJobId) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($job['id']) . '" ' . $selected . '>' . htmlspecialchars($job['title']) . '</option>';
                    }
                } else {
                    echo '<option value="">No jobs found</option>';
                }
                ?>
            </select>
        </div>

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

<script>
    document.getElementById('jobSelect').addEventListener('change', function () {
        var selectedJobId = this.value;
        var currentUrl = window.location.href.split('?')[0];
        var queryParams = new URLSearchParams(window.location.search);
        queryParams.set('job', selectedJobId);
        window.location.href = currentUrl + '?' + queryParams.toString();
    });
</script>

</html>