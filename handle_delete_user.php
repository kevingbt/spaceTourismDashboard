<?php
require_once 'init.php';
$db = new DbUser();
$id = (int)$_POST['id'];
$user = $db->fetchUserId($id);

session_start();
if (isset($_SESSION['email']) && $user->is_admin === false) {
    $db->deleteUser($id);
}
header('Location: /login.php');
exit;
