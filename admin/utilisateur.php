<?php
require_once './init.php';
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['is_admin'])) {
    if ($_SESSION['is_admin'] === false) {
        header('Location: ../home.php');
        exit;
    }
} else {
    header('Location: ../login.php');
    exit;
}
$dbUser = new DbUser();
$dbReservation = new DbReservation();
$id = (int)$_GET['id'];

$result = $dbUser->fetchUserId($id);
switch ($result->is_admin) {
    case true:
        $isAdmin = "true";
        break;
    case false:
        $isAdmin = "false";
        break;
}

$reservation = $dbReservation->fetchVoyage($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="header">
        <h1>Space Tourism</h1>
        <a href="/admin/index.php" class="btn">admin</a>
    </div>
    <div class="adminContainer">
        <h1>Dashboard Utilisateur</h1>
        <hr>
        <h3>Email : <?= $result->email; ?></h3>
        <h3>Admin : <?= $isAdmin; ?></h3>
        <div>
            <h3>Modifier l'utilisateur</h3>
            <form action="/handle_update_user.php" method="post">
                <input type="text" name="email" value=<?= $result->email; ?>>
                <input type="password" name="password">
                <input type="hidden" name="id" value=<?= $result->id; ?>>
                <select name="is_admin">
                    <option value="true">true</option>
                    <option value="false">false</option>
                </select>
                <button type="submit">modifier</button>
            </form>
            <?php
            if ($result->is_admin) {
            } else {
            ?>
            <h3>Supprimer l'utilisateur</h3>
                <?php if (empty($reservation)) { ?>
                    <form action="/handle_delete_user.php" method="post">
                    <input type="hidden" name="id" value=<?= $result->id; ?>>
                    <button type="submit">supprimer</button>
                </form>
                <?php } else { ?>
                    <p>Vous ne pouvez pas supprimer cet utilisateur car il a réservé des voyages.</p>
                <?php } ?>
            <?php
            }
            ?>

        </div>
        <hr>
        <h2>Liste des voyages</h2>
        <ul>
            <?php foreach ($reservation as $res) { ?>
                <li>
                    <?= $res->product->name; ?>
                    <?= $res->product->departure_date; ?>
                    <form action="/admin/voyage.php" method="get">
                        <input type="hidden" name="id" value=<?= $res->product->id ?>>
                        <button type="submit">Voir</button>
                    </form>
                    <form action="../handle_delete_reservation.php" method="post">
                        <input type="hidden" name="id" value=<?= $res->id ?>>
                        <button type="submit">Annuler</button>
                    </form>
                </li>
            <?php } ?>
        </ul>
    </div>

</body>

</html>