<?php
require "../../libs/functions.php";
include "admin-nav.php";
// session_start();

if (empty($_SESSION["loggedin"])) {
    header("Location: ../../Pages/login.php");
}
?>