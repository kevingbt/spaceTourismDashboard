<?php
require_once 'init.php';
$db = new DbProduct();
$result = $db->fetchAllProduct();
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
        <a href="login.php">Se connecter/S'inscrire</a>
    </div>
    <div class="indexContainer">
        <h1>Vous souhaitez réserver votre prochain voyage spatial ? </h1>
        <h2>Alors n'hésitez à faire appel à votre agence préférée Space Tourism et réserver l'un de nos voyages ci-dessous.</h2>
        <div class="products">
            <?php foreach ($result as $product) { ?>
                <div class="product">
                    <h3><?= $product->name; ?></h3>
                    <p><?= $product->illustration; ?></p>
                    <p>Date du voyage : <?= $product->departure_date; ?></p>
                    <p>Ce voyage peut accueillir jusqu'à <?= $product->max_passengers ?> personnes</p>
                    <p><span><?= $product->price; ?> €</span></p>
                    <a href="login.php">Réserver</a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>