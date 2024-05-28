<?php

// require "libs/vars.php";
require "../libs/functions.php";
session_start();
$id = intval($_GET['id']);

if (deleteJob($id)) {
    $_SESSION['message'] = $id . " id numaralı ilan silindi.";
    $_SESSION['type'] = "danger";

    header('Location: jobList.php');
} else {
    echo "hata";
}

?>