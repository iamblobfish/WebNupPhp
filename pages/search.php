<?php

if (isset($_GET['search']) &&  $_GET['search']!="") {
    $search = $_GET['search'];
    $result = getQueryResult("SELECT id, title, price, src, sale FROM items WHERE title LIKE '%$search%' OR description LIKE '%$search%' OR collection LIKE '%$search%'");
} elseif (isset($_GET['collection'])) {
    $result = getQueryResult("SELECT id, title, price, src, sale FROM items WHERE collection = ?", $_GET['collection']);
} else {
    $result = getQueryResult("SELECT id, title, price, src, sale FROM items");
}
$items = getItemsFromResult($result);


?>

<!DOCTYPE html>
<html lang="">
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">
    <title>Search</title>
</head>
<body style="background-image: url(../images/background.png);">

<?php includeHeader(); ?>

<div class="catalog-grid">

    <?php foreach ($items as $item): ?>

        <div id="<?= $item['id']; ?>" class="item" tag="search">
            <img src="<?= $item['src']; ?>" class="img" alt="Autumn Dress">
            <p>$<?= $item['price']; ?></p>
            <p><?= $item['title']; ?></p>
            <button id="buy" class="important-button gradient" onclick="addToItemList(<?=$item['id']?>)">Buy</button>
        </div>

    <?php endforeach; ?>

</div>

<?php includeFooter(); ?>

<script src="../js/header.js"></script>

</body>
</html>

