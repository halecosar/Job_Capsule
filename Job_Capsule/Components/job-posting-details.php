<?php
include "navbar.php";
include_once "../libs/functions.php";


$jobDetails = getJobByID($_GET["id"]);


?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<title>Job Details</title>

<div class="container">
    <div class="row mt-4 mb-2">
        <div class="col-md-9">
            <div class="row">
                <h3><?php echo htmlspecialchars($jobDetails["title"]); ?></h3>
            </div>
            <div class="row">
                <p><?php echo nl2br(htmlspecialchars($jobDetails["long_description"])); ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mb-5">

                <div class="card-body">
                    <p> Location </p>
                    <p class="card-text"><?= htmlspecialchars($jobDetails['location']) ?></p>
                    <p> Date Posted </p>
                    <h5 class="card-text"> <?= htmlspecialchars($jobDetails['created_on']) ?></h5>
                    <a href="job-posting-details.php?id=<?php echo $jobDetails['id'] ?>"
                        class="btn btn-primary btn-large align-self-start">İlana Başvur</a>


                </div>
            </div>
        </div>
    </div>
</div>