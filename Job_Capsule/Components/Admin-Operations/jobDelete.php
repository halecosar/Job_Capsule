<?php

// require "libs/vars.php";
require "../../libs/functions.php";
session_start();
$id = intval($_GET['id']);

if (deleteJob($id)) {
    $_SESSION['message'] = $id . " ID'li İlan Silindi.";
    $_SESSION['type'] = "danger";

    header('Location: jobList.php');
} else {
    echo "hata";
}

?>