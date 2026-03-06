<?php 
require_once './init.php';
$dbUser = new DbUser();
$dbProduct = new DbProduct();
$dbReservation = new DbReservation();

if ($_POST['name'] ?? null && $_POST['illustration'] ?? null && $_POST['departure_date'] ?? null && $_POST['max_passengers'] ?? null && $_POST['price'] ?? null) {
    $dbProduct->pushProduct($_POST['name'], $_POST['illustration'], $_POST['departure_date'], $_POST['max_passengers'], $_POST['price']);
    header('Location: /admin/index.php');
    exit;
}

if ($_POST['user'] ?? null && $_POST['product'] ?? null) {
    $dbReservation->pushReservation((int)$_POST['user'], (int)$_POST['product']);
    header('Location: /admin/index.php');
    exit;
}