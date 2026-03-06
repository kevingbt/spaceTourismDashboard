<?php
require_once 'init.php';
$dbUser = new DbUser();
$user = $dbUser->fetchAllUser();

session_start();
$userConnected = null;
$isConnected = false;
foreach ($user as $user) {
    if ($user->email === $_POST['email'] && $user->hashed_password === md5($_POST['password'])) {
        $userConnected = $user;
        $isConnected = true;
        break;
    }
}

if ($isConnected) {
    $_SESSION['id'] = $userConnected->id;
    $_SESSION['email'] = $userConnected->email;
    $_SESSION['hashed_password'] = $userConnected->hashed_password;
    $_SESSION['is_admin'] = $userConnected->is_admin;
    if ($userConnected->is_admin === true) {
        header('Location: /admin/index.php');
        exit;
    } else {
        header('Location: /home.php');
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
