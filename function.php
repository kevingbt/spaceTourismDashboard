<?php
require_once './init.php';
session_start();
$dbUser = new DbUser();
$dbReservation = new DbReservation();
$count = $dbUser->fetchCountUser();

if ($_SESSION['id'] ?? null && $_POST['product'] ?? null) {
    $dbReservation->pushReservation((int)$_SESSION['id'], (int)$_POST['product']);
    header('Location: /home.php');
    exit;
}

if ($_POST['email'] ?? null && $_POST['password'] ?? null && $_POST['is_admin'] ?? null) {
    if ($count == 0) {
        $isAdmin = true;
    } else {
        $isAdmin = false;
    }
    $dbUser->pushUser($_POST['email'], md5($_POST['password']), $isAdmin);
    header('Location: /home.php');
    exit;
}
