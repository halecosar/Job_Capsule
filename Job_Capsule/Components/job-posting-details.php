<?php

include_once "../libs/functions.php";
include "../libs/config.php";
$jobDetails = getJobByID($_GET["id"]);
?>

<?php

$loggedIn = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!$loggedIn) {
        header('Location: ../Pages/login.php');
        exit();
    } else {

        if (isset($_SESSION['userId']) && isset($_GET['id'])) {
            $sql = "Select id FROM application where user_id = ? && job_id = ?";

            if ($stmt = mysqli_prepare($connection, $sql)) {
                $param_job_id = trim($_GET['id']);
                $param_user_id = trim($_SESSION['userId']);
                mysqli_stmt_bind_param($stmt, "ss", $param_user_id, $param_job_id);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    // Aday daha önce bu ilana başvuru yapmış mı, eğer yaptıysa hata mesajı basılır.
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $_SESSION["applicationbad_message"] = "Bu ilana daha önce başvuru yaptınız.";
                        $_SESSION["applicationbad_type"] = "danger";
                    } else {
                        $user_id = $_SESSION['userId'];
                        $job_id = $_GET['id'];
                        $status = 1;

                        $result = ApplicationAdd($user_id, $job_id, $status);

                        if ($result) {

                            $_SESSION['application_message'] = "Başvurunuz alındı, ekibimiz en kısa zaman içinde size dönüş sağlayacaktır.";
                            $_SESSION['application_type'] = "success";
                        } else {
                            echo "Başvuru sırasında bir hata oluştu.";
                        }
                    }
                } else {
                    echo mysqli_error($connection);
                    echo "hata oluştu";
                }


            } else {
                echo "Gerekli bilgiler eksik.";
            }
        }

    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <title>Job Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<?php include "navbar.php"; ?>

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
                        <h5> Konum </h5>
                        <p class="card-text"><?= htmlspecialchars($jobDetails['location']) ?></p>
                        <h5> Yayınlama Tarihi </h5>
                        <p class="card-text"> <?= htmlspecialchars($jobDetails['created_on']) ?></p>
                        <form method="POST">
                            <button class="btn btn-primary btn-large align-self-start" type="submit">İlana
                                Başvur</button>

                            <?php if (isset($_SESSION['application_message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['application_type']; ?>">
                                    <?php
                                    echo $_SESSION['application_message'];
                                    unset($_SESSION['application_message']);
                                    unset($_SESSION['application_type']);
                                    ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['applicationbad_message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['applicationbad_type']; ?>">
                                    <?php
                                    echo $_SESSION['applicationbad_message'];
                                    unset($_SESSION['applicationbad_message']);
                                    unset($_SESSION['applicationbad_type']);
                                    ?>
                                </div>
                            <?php endif; ?>

                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require "../Pages/footer.php";
    ?>
</body>

</html>