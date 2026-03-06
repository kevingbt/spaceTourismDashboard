<?php

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


require_once './init.php';
$dbUser = new DbUser();
$dbProduct = new DbProduct();
$dbReservation = new DbReservation();

$resultUser = $dbUser->fetchAllUser();
$resultProduct = $dbProduct->fetchAllProduct();

$nextVoyages = $dbProduct->fetchNextProduct();

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
        <a href="../logout.php">Se déconnecter</a>
    </div>
    <h1>Dashboard Admin</h1>
    <div class="liste">
        <div>
            <h2>Liste des voyages</h2>
            <a href="/admin/listVoyage.php">Voir la listes des voyages</a>
        </div>
        <div>
            <h2>Liste des users</h2>
            <a href="/admin/listUser.php">Voir la listes des users</a>
        </div>
    </div>
    <hr>
    <h2>Les 3 prochains voyages :</h2>
    <ul>
        <?php foreach ($nextVoyages as $product) {
            $voyageurCount = $dbReservation->fetchCountReservationbyId($product->id);
            $decompte = $product->max_passengers - $voyageurCount;
        ?>
            <li>
                <?= sprintf('%s - %s : %d places restantes', $product->name, $product->departure_date, $decompte ?: "Inconnu") ?>
                <form action="/admin/voyage.php" method="get">
                    <input type="hidden" name="id" value=<?= $product->id ?>>
                    <button type="submit">Voir</button>
                </form>
            </li>
        <?php } ?>
    </ul>
    <h2>Créer une nouvelle destination :</h2>
    <form action="/admin/function.php" method="post" class="form">
        <div>
            <label for="">Nom</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="">Description</label>
            <textarea name="illustration" id=""></textarea>
        </div>
        <div>
            <label for="">Date de départ</label>
            <input type="date" name="departure_date">
        </div>
        <div>
            <label for="">Nb max</label>
            <input type="number" name="max_passengers">
        </div>
        <div>
            <label for="">Prix</label>
            <input type="number" name="price">
        </div>
        <button type="submit">Créer</button>
    </form>
    <h2>Créer une réservation pour un utilisateur :</h2>
    <form action="/admin/function.php" method="post" class="form">
        <select name="user" id="">
            <?php foreach ($resultUser as $user) : ?>
                <option value="<?= $user->id ?>"><?= $user->email ?></option>
            <?php endforeach; ?>
        </select>
        <select name="product" id="">
            <?php foreach ($resultProduct as $product) : ?>
                <option value="<?= $product->id ?>"><?= $product->name ?> / <?= $product->departure_date ?> </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">send</button>
    </form>

</body>

</html>