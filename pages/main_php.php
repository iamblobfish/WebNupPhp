<?php

$result = getQueryResult("SELECT id, title, price, src, sale FROM items ORDER BY created_at DESC LIMIT 3");
$items1 = getItemsFromResult($result);

$result = getQueryResult("SELECT id, title, price, src, sale FROM items ORDER BY sale DESC LIMIT 3");
$items2 = getItemsFromResult($result);

$collection = getQueryResult("SELECT collection FROM items ORDER BY created_at DESC LIMIT 1")->fetch_assoc()['collection'];
$result = getQueryResult("SELECT id, title, price, src, sale FROM items WHERE collection = ?", $collection);
$items3 = getItemsFromResult($result);

if (isset($_SESSION['id'])){
    $_SESSION['id'] = $_POST['newId'] ?? $_SESSION['id'];
} else $_SESSION['id'] = "";

if (isset($_SESSION['logged_in'])){
    $_SESSION['logged_in'] = $_POST['loggedin'] ?? $_SESSION['logged_in'];
} else $_SESSION['logged_in'] = "false";

?>

<html lang="">
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Main Page</title>
</head>
<body style="background-image: url(../images/background.png);">

<?php includeHeader(); ?>

<h1>Newest</h1>
<div class="catalog-grid">

    <?php foreach ($items1 as $item): ?>
        <div id="<?= $item['id']; ?>" class="item" tag="search">
            <img src="<?= $item['src']; ?>" class="img" alt="Autumn Dress">
            <p>$<?= $item['price']; ?></p>
            <p><?= $item['title']; ?></p>
            <button id="buy" class="important-button gradient" onclick="addToItemList(<?= $item['id'] ?>);">Buy</button>
        </div>
    <?php endforeach; ?>


</div>

<h1>Sales</h1>
<div class="catalog-grid">

    <?php foreach ($items2 as $item): ?>
        <div id="<?= $item['id']; ?>" class="item" tag="search">
            <img src="<?= $item['src']; ?>" class="img" alt="Autumn Dress">
            <p>$<?= $item['price']; ?></p>
            <p><?= $item['title']; ?></p>
            <button id="buy" class="important-button gradient" onclick="addToItemList(<?= $item['id'] ?>);">Buy</button>
        </div>
    <?php endforeach; ?>
</div>

<h1>Latest Collection</h1>
<div class="catalog-grid">

    <?php foreach ($items3 as $item): ?>
        <div id="<?= $item['id']; ?>" class="item" tag="search">
            <img src="<?= $item['src']; ?>" class="img" alt="Autumn Dress">
            <p>$<?= $item['price']; ?></p>
            <p><?= $item['title']; ?></p>
            <button id="buy" class="important-button gradient" onclick="addToItemList(<?= $item['id'] ?>);">Buy</button>
        </div>
    <?php endforeach; ?>

</div>

<?php includeFooter(); ?>
<script src="../js/header.js"></script>

</body>
</html>
