<?php

if (isset($_GET['item']) &&  $_GET['item']!="") {
    $id = $_GET['item'];
    $result = getQueryResult("SELECT id, title, price, src, sale, collection, description FROM users.items WHERE id = '$id'");
    $item = getItemsFromResult($result)[0];
}
$_SESSION['prev'] = 'item';
?>

<!DOCTYPE html>
<html lang="">
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/item.css">
    <title>Item</title>
</head>
<body style = "background-image: url(../images/background.png);">

<?php includeHeader(); ?>

<div class="item-page">
    <img class='item_img gradient' src="<?= $item['src']?>" alt="Product Image">
    <div class="item-details">
        <h1 class="item-name"><?= $item['title']?></h1>
        <p class="item-price">$<?= $item['price']?></p>
        <div class="size-selection">
            <label for="size gradient">Size:</label>
            <select id="size gradient">
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
            </select>
        </div>

        <button id="buy" data_id="<?= $item['id']?>" onclick="addToItemList(<?=$item['id']?>)" class="important-button gradient">Add to Cart</button>



        <div class="item-description">
            <h2>Description</h2>
            <p class="description">Collection: <?= $item['collection']?></p>

            <p class="description"> <?= $item['description']?></p>
        </div>
    </div>
</div>


<?php includeFooter();?>

<script src="../js/header.js"></script>
</body>
</html>

