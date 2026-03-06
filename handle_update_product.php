<?php
require_once 'init.php';
$db = new DbProduct();

session_start();
if (isset($_SESSION['email']) && $_SESSION['is_admin'] === true) {
    if ($_POST['name'] ?? null && $_POST['illustration'] ?? null && $_POST['departure_date'] ?? null && (int)$_POST['max_passengers'] ?? null && (int)$_POST['price'] ?? null && (int)$_POST['id'] ?? null) {
        $db->updateProduct((int)$_POST['id'], $_POST['name'], $_POST['illustration'], $_POST['departure_date'], (int)$_POST['max_passengers'], (int)$_POST['price']);
    }
}
header('Location: /admin/index.php');
exit;

