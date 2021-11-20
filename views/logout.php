<?php

include_once '../config/setting.php';
session_start();
if(session_destroy())
{
header("Location:" .$siteUrl);
}
?>
