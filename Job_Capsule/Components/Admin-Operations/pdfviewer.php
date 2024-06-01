<?php
include "admin-nav.php";
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