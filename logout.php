<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ./index.php");
    exit;
}

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 4200, '/');
}

session_destroy();
require('./views/logout.view.php');
