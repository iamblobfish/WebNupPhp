<!DOCTYPE html>
<html lang="">
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">
</head>
<body style = "background-image: url(../images/background.png);">

<?php includeHeader(); ?>

<h1>Newest</h1>
<div class="catalog-grid">

        <?php foreach ($items as $item): ?>
        <div id="<?= $item['id']; ?>" class="item" tag="search">
            <img src="<?= $item['src']; ?>" class="img" alt="Autumn Dress">
            <p>$<?= $item['price']; ?></p>
            <p><?= $item['title']; ?></p>
            <button id="buy" class="important-button gradient">Buy</button>
        </div>
        <?php endforeach; ?>


</div>

<h1>Sales</h1>
<div class="catalog-grid">

        <?php foreach ($items as $item): ?>
        <div id="<?= $item['id']; ?>" class="item" tag="search">
            <img src="<?= $item['src']; ?>" class="img" alt="Autumn Dress">
            <p>$<?= $item['price']; ?></p>
            <p><?= $item['title']; ?></p>
            <button id="buy" class="important-button gradient">Buy</button>
        </div>
        <?php endforeach; ?>
</div>

<h1>Latest Collection</h1>
<div class="catalog-grid">

        <?php foreach ($items as $item): ?>
        <div id="<?= $item['id']; ?>" class="item" tag="search">
            <img src="<?= $item['src']; ?>" class="img" alt="Autumn Dress">
            <p>$<?= $item['price']; ?></p>
            <p><?= $item['title']; ?></p>
            <button id="buy" class="important-button gradient">Buy</button>
        </div>
        <?php endforeach; ?>

</div>

<?php includeFooter();?>

<script src="../js/header.js"></script>
<script type="module" src="../js/catalog.js"></script>

</body>
</html>

