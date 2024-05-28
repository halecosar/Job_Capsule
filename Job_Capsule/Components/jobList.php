<?php
require_once "../libs/functions.php";

$keyword = "";
$page = 1;

if (isset($_GET["q"]))
    $keyword = $_GET["q"];
if (isset($_GET["page"]) && is_numeric($_GET["page"]))
    $page = $_GET["page"];



$result = getJobs($keyword, $page);

$total_jobs = $result["totalCount"];
$data = $result["data"];
$total_pages = $result["total_pages"];

// Veritabanından gelen iş ilanlarıyla bir tablo oluştur
function createJobTable($data)
{
    $html = '<table class="table">';
    $html .= '<thead><tr><th>Title</th><th>Short Description</th><th>Location</th></tr></thead>';
    $html .= '<tbody>';
    foreach ($data as $job) {
        $html .= '<tr>';
        $html .= '<td>' . $job['title'] . '</td>';
        $html .= '<td>' . $job['short_description'] . '</td>';
        $html .= '<td>' . $job['location'] . '</td>';
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
        <h1>Job Listings</h1>
        <?php echo createJobTable($data); ?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="jobs.php?page=<?php echo ($page - 1); ?>">Previous</a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page)
                        echo 'active'; ?>"><a class="page-link"
                            href="jobs.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link" href="jobs.php?page=<?php echo ($page + 1); ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</body>

</html>