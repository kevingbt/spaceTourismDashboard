<?php
require_once 'init.php';
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['is_admin'])) {
    if ($_SESSION['is_admin'] === true) {
        header('Location: /admin/index.php');
        exit;
    } else {
        header('Location: /home.php');
        exit;
    }
}
$dbUser = new DbUser();
$dbProduct = new DbProduct();
$result = $dbUser->fetchAllUser();
$resultProduct = $dbProduct->fetchAllProduct();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <h1>Space Tourism</h1>
        <a href="index.php" class="btn">Revenir à la présentation des voyages</a>
    </div>
    <div class="container">
        <h3>Connexion</h3>
        <form action="connexion.php" method="post">
            <div>
                <label for="">Email</label>
                <input type="email" name="email">
            </div>
            <div>
                <label for="">Mot de passe</label>
                <input type="password" name="password">
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <hr>
        <h3>Se créer un compte</h3>
        <form action="function.php" method="post">
            <div>
                <label for="">Email</label>
                <input type="email" name="email">
            </div>
            <div>
                <label for="">Mot de passe</label>
                <input type="password" name="password">
            </div>
            <button type="submit">S'inscrire</button>
        </form>
    </div>

</body>

</html>