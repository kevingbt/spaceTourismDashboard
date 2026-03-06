<?php

require_once 'init.php';
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['is_admin'])) {
    header('Location: /login.php');
    exit;
}
$dbUser = new DbUser();
$dbProduct = new DbProduct();
$dbReservation = new DbReservation();

$result = $dbUser->fetchAllUser();

$resultProduct = $dbProduct->fetchAllProduct();
$resultReservation = $dbReservation->fetchAllReservation();
$reservation = $dbReservation->fetchVoyage($_SESSION['id']);

switch ($_SESSION['is_admin']) {
    case true:
        $isAdmin = "true";
        break;
    case false:
        $isAdmin = "false";
        break;
}


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
        <a href="./logout.php" class="btn">Se déconnecter</a>
    </div>
    <div class="pageContainer">
        <h1>Votre compte</h1>
        <hr>
        <h3>Email : <?= $_SESSION['email']; ?></h3>
        <h3>Admin : <?= $isAdmin; ?></h3>
        <form action="/handle_update_user.php" method="post" class="form">
            <div>
                <label for="">Ton email</label>
                <input type="text" name="email" value=<?= $_SESSION['email']; ?>>
            </div>
            <div>
                <label for="">Ton mot de passe</label>
                <input type="password" name="password">
            </div>
            <input type="hidden" name="id" value=<?= $_SESSION['id']; ?>>
            <input type="hidden" name="is_admin" value="false">
            <button type="submit">modifier</button>
        </form>

        <hr>
        <h2>Vos futures réservations</h2>
        <ul>
            <?php foreach ($reservation as $res) { ?>
                <li>
                    <?= $res->product->name; ?>
                    <?= $res->product->departure_date; ?>
                    <form action="/handle_delete_reservation.php" method="post">
                        <input type="hidden" name="id" value=<?= $res->id ?>>
                        <button type="submit">Annuler</button>
                    </form>
                </li>
            <?php } ?>
        </ul>
        <hr>
        <h2>Réserver un nouveau voyage</h2>
        <form action="function.php" method="post" class="form">
            <div>
                <label for="">Choisissez votre prochain voyage</label>
                <select name="product" id="">
                    <?php foreach ($resultProduct as $product) : ?>
                        <option value="<?= $product->id ?>"><?= $product->name ?> / <?= $product->departure_date ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Réserver</button>
        </form>

    </div>
</body>

</html>