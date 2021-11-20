<?php

session_start();

if (!isset($_SESSION["admin"])) {
        header("Location:" . $siteUrl . "cms/login.php");
        exit();
}
