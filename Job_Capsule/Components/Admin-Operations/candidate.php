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

$keyword = "";
$page = 1;

if (isset($_GET["q"]))
    $keyword = $_GET["q"];
if (isset($_GET["page"]) && is_numeric($_GET["page"]))
    $page = $_GET["page"];

$result = getAllCandidates($keyword, $page);

$total_candidates = $result["totalCount"];
$data = $result["data"];
$total_pages = $result["total_pages"];

function createCandidateTable($data)
{
    $html = '<table class="table">';
    $html .= '<thead><tr><th>Ad-Soyad</th><th>Mail</th><th>Telefon</th><th>Actions</th><th>CV</th></tr></thead>';
    $html .= '<tbody>';
    foreach ($data as $user) {
        $html .= '<tr>';
        $html .= '<td>' . $user['fullname'] . '</td>';
        $html .= '<td>' . $user['mail'] . '</td>';
        $html .= '<td>' . $user['phone'] . '</td>';
        $html .= '<td>';
        $html .= '<div class="btn-group" style="display: flex; gap: 10px;">';
        $html .= '<a href="candidateUpdate.php?id=' . $user['id'] . '" class="btn btn-warning btn-sm mb-1" style="width: 30px;">Güncelle</a>';
        $html .= '<a href="candidateDelete.php?id=' . $user['id'] . '" class="btn btn-danger btn-sm mb-1" style="width: 30px;">Sil</a>';
        $html .= '</div>';
        $html .= '</td>';
        $html .= '<td>';
        $html .= '<a href="pdfviewer.php?id=' . $user['id'] . '&pdf=' . $user['cvfilename'] . '" class="btn btn-info btn-sm mb-1" style="width: 125px;" >Cv Görüntüle</a>';
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
    <title>Candidate</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Aday Listesi</h1>
        <a href="candidateInsert.php" class="btn btn-primary btn-large float-right mb-2">Yeni Aday Ekle</a>


        <?php echo createCandidateTable($data); ?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link"
                            href="candidate.php?page=<?php echo ($page - 1); ?>">Önceki</a></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page)
                        echo 'active'; ?>"><a class="page-link"
                            href="candidate.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link"
                            href="candidate.php?page=<?php echo ($page + 1); ?>">Sonraki</a>
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