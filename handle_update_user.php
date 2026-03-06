<?php
require_once 'init.php';
session_start();
$db = new DbUser();
$id = (int)$_POST['id'];

session_start();
if (isset($_SESSION['email'])) {
    if ($_POST['email'] ?? null && $_POST['password'] ?? null && $_POST['is_admin'] ?? null) {
        switch ($_POST['is_admin']) {
            case "true":
                $isAdmin = true;
                break;
            case "false":
                $isAdmin = false;
                break;
        }
        if ($POST_['password'] == "") {
            $password = $_SESSION['hashed_password'];
        } else {
            $password = md5($_POST['password']);
        }
        $db->updateUser($id, $_POST['email'], $password, $isAdmin);
        if ($isAdmin === false) {
            $_SESSION['email'] = $_POST['email'];
        }
    }
}
header('Location: login.php');
