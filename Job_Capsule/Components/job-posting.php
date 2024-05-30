<?php

include_once "../libs/functions.php"; ?>
<?php
require "navbar.php";
?>
<?php
$keyword = "";
$page = 1;

if (isset($_GET["q"]))
    $keyword = $_GET["q"];
if (isset($_GET["page"]) && is_numeric($_GET["page"]))
    $page = $_GET["page"];

$result = getJobs($keyword, $page);

$totalCount = $result["totalCount"];
$data = $result["data"];
$totalPages = $result["total_pages"];
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container">
    <form class="d-flex justify-content-end mt-2 mb-2">
        <input class="form-control me-2" name="q" style="width:100px" type="search" placeholder="Search"
            aria-label="  Search" value="<?= Security($keyword) ?>">
        <button class="btn btn-outline-primary" type="submit">İlan Ara</button>
    </form>
</div>

<div class="container">
    <div class="row">
        <h4><?php echo $totalCount . " iş ilanı gösteriliyor "; ?></h4>
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
                            <a href="job-posting-details.php?id=<?= htmlspecialchars($job['id']) ?>"
                                class="btn btn-primary btn-large align-self-start">İlan Detayına Git</a>
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