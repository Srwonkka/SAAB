<?php 
session_start();
$link = isset($_SESSION['link']) ? $_SESSION['link'] : '';
$_SESSION = [];
session_destroy();
if (!empty($link)) {
    header("Location: http://localhost/SAAB/SAAB/login.php?link=".$link);
} else {
    header("Location: http://localhost/SAAB/SAAB/login.php");
}