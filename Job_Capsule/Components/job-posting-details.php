<?php
include "navbar.php";
include_once "../libs/functions.php";
$jobDetails = getJobByID($_GET["id"]);
?>

<?php

$loggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!$loggedIn) {
        header('Location: ../Pages/login.php');
    } else {
        echo "başvuru alındı";
    }

} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
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
                        <form method="POST">
                            <button class="btn btn-primary btn-large align-self-start" type="submit">İlana
                                Başvur</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>