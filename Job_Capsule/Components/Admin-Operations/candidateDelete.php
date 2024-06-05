<?php
session_start();

if (isset($_SESSION["role"]) && $_SESSION["role"] == 0) {
    echo "Oturum hatası: Aday rolüyle işlem yapılamaz!";
    header("location: ../../Pages/logout.php");
    exit();
}
if (empty($_SESSION["loggedin"])) {
    header("Location: ../../Pages/login.php");
}
// require "libs/vars.php";
require "../../libs/functions.php";
// session_start();
$id = intval($_GET['id']);

if (deleteCandidate($id)) {
    $_SESSION['message'] = $id . " ID'li Aday Silindi.";
    $_SESSION['type'] = "danger";

    header('Location: candidate.php');
} else {
    echo "hata";
}

?>