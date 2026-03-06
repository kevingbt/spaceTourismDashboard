<?php
require_once 'init.php';
$db = new DbProduct();
$id = (int)$_POST['id'];
session_start();
if (isset($_SESSION['email'])&& $_SESSION['is_admin'] === true) {
    $db->deleteProduct($id);
}
header('Location: /admin/index.php');
exit;
