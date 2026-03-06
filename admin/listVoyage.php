<?php
require_once './init.php';
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['is_admin'])) {
    if ($_SESSION['is_admin'] === false) {
        header('Location: ../home.php');
        exit;
    }
}else{
    header('Location: ../login.php');
        exit;
}
$dbProduct = new DbProduct();

$resultProduct = $dbProduct->fetchAllProduct();

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
        <a href="/admin/index.php">retour</a>
    </div>
    <h1>Dashboard Admin</h1>
    <hr>
    <h2 class="h2">Liste des voyages</h2>
    <ul>
        <?php foreach ($resultProduct as $product) { ?>
            <li>
                <?= sprintf('%s - %s', $product->name, $product->departure_date ?: "Inconnu") ?>
                <form action="/admin/voyage.php" method="get">
                    <input type="hidden" name="id" value=<?= $product->id ?>>
                    <button type="submit">Voir</button>
                </form>
            </li>
        <?php } ?>
    </ul>

</body>
</html>