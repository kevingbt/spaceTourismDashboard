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
$dbProduct = new DbProduct();
$dbReservation = new DbReservation();

$id = (int)$_GET['id'];

$result = $dbProduct->fetchProductId($id);

$participants = $dbReservation->fetchParticipants($id);
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
        <h1>Dashboard Voyage</h1>
        <hr>
        <div class="info">
            <h3>Destination : <?= $result->name; ?></h3>
            <h3>Description : <?= $result->illustration; ?></h3>
            <h3>Date de départ : <?= $result->departure_date; ?></h3>
            <h3>Prix : <?= $result->price; ?></h3>
            <h3>Nb de places: <?= $result->max_passengers; ?></h3>
        </div>
        <div>
            <h3>Modifier le voyage</h3>
            <form action="/handle_update_product.php" method="post">
                <input type="hidden" name="id" value=<?= $result->id; ?>>
                <input type="text" name="name" value=<?= $result->name; ?>>
                <textarea name="illustration" id=""><?= $result->illustration; ?></textarea>
                <input type="date" name="departure_date" value=<?= $result->departure_date; ?>>
                <input type="number" name="max_passengers" value=<?= $result->max_passengers; ?>>
                <input type="number" name="price" value=<?= $result->price; ?>>
                <button type="submit">modifier</button>
            </form>
            <h3>Supprimer le voyage</h3>
            <?php if (empty($participants)){ ?>
                <form action="/handle_delete_product.php" method="post">
                    <input type="hidden" name="id" value=<?= $result->id; ?>>
                    <button type="submit">supprimer</button>
                </form>
            <?php } else { ?>
                <p>Vous ne pouvez pas supprimer ce voyage car des réservations existent.</p>
            <?php } ?>

        </div>
        <hr>
        <h2>Liste des participants</h2>
        <ul>
            <?php foreach ($participants as $users) { ?>
                <li>
                    <?= $users->email; ?>
                    <form action="/admin/utilisateur.php" method="get">
                        <input type="hidden" name="id" value=<?= $users->id ?>>
                        <button type="submit">Voir</button>
                    </form>
                </li>
            <?php } ?>
        </ul>
    </div>

</body>

</html>