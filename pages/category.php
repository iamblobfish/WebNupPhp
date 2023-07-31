<?php
$query = "  SELECT i1.collection, i1.src
            FROM users.items i1
            JOIN (
                SELECT MIN(id) as min_id, collection
                FROM users.items
                GROUP BY collection
            ) i2 ON i1.id = i2.min_id";

$result = getQueryResult($query);
$items = getItemsFromResult($result);

?>
<!DOCTYPE html>
<html lang="">
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/category.css">
</head>
<body style="background-image: url(../images/background.png);">
<!--Background-->

<?php includeHeader(); ?>

<!--<h1>Collections</h1>-->
<div class="categories-grid">
    <?php foreach ($items as $item): ?>

        <div id="<?= $item['collection']; ?>" class="items collections"
             onclick="switchPage('search&collection=<?= $item['collection']; ?>')">

            <h2 class="item-name"><?= $item['collection']; ?></h2>
            <img src="<?= $item['src']; ?>" class="img" alt="../static/images/default.png">

        </div>

    <?php endforeach; ?>

</div>

<?php includeFooter(); ?>

<!--<script src="../static/get_dress.js"></script>-->
<!--<script src="../js/header.js"></script>-->
</body>
</html>

