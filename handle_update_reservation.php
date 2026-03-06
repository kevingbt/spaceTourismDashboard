<?php
require_once 'init.php';
$db = new DbReservation();

session_start();
if (isset($_SESSION['email'])) {
    if ($_POST['user'] ?? null && $_POST['product'] ?? null) {
        $db->updateReservation((int)$_POST['id'], (int)$_POST['user'], (int)$_POST['product']);
    }
}
header('Location: login.php');
exit;
