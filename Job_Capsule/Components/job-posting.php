<?php
include "navbar.php";
include_once "../libs/functions.php";


$jobs = getJobs();
$jobCount = getJobsCount();

?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container">
    <form class="d-flex justify-content-end mt-2 mb-2">
        <input class="form-control me-2" style="width:100px" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">İlan Ara</button>
    </form>
</div>

<div class="container">
    <div class="row

    ">
        <h4> <?php echo "$jobCount iş ilanı gösteriliyor "; ?> </h4>
    </div>
    <div class="row">
        <?php foreach ($jobs as $job): ?>
            <div class="col-md-4">
                <div class="card mb-5">
                    <h5 class="card-header"><?= htmlspecialchars($job['title']) ?></h5>
                    <div class="card-body">
                        <p class="card-text"><?= htmlspecialchars($job['short_description']) . "..." ?></p>
                        <h5 class="card-text"> <?= htmlspecialchars($job['location']) ?></h5>
                        <a href="job-posting-details.php?id=<?php echo $job['id'] ?>"
                            class="btn btn-primary btn-large align-self-start">İlan Detayına
                            Git</a>


                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>