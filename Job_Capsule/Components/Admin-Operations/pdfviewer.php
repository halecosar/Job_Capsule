<?php
include "admin-nav.php";

if (isset($_SESSION["role"]) && $_SESSION["role"] == 0) {
    echo "Oturum hatası: Aday rolüyle işlem yapılamaz!";
    header("location: ../../Pages/logout.php");
    exit();
}

if (empty($_SESSION["loggedin"])) {
    header("Location: ../../Pages/login.php");
}

$pdfName = $_GET['pdf'] ?? null;

$pdfFile = '../../file/' . $pdfName;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Göster</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <embed src="<?php echo $pdfFile; ?>" type="application/pdf" width="100%" height="600px" />
        </div>
    </div>

</body>

</html>