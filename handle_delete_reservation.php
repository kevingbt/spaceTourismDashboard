<?php
require_once 'init.php';
$db = new DbReservation();
$id = (int)$_POST['id'];
session_start();
if (isset($_SESSION['email'])) {
    $db->deleteReservation($id);
}
header('Location: login.php');
exit;