<!DOCTYPE html>
<html lang="">
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/item.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title> Cart </title>

</head>
<body style="background-image: url(../images/background.png);">

<?php includeHeader(); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['elements'])) {
    $elements = $_POST['elements'];
    $_SESSION['elements'] = $_POST['elements'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
    $buy = $_POST['buy'];
    $_SESSION['buy'] = $_POST['buy'];
    $tot = $_POST['total'];
    $user_id = $_SESSION['id'];
    getQueryResult("INSERT INTO users.orders (user_id, ids, total) VALUES ($user_id,'$buy', $tot)");
}

?>


<div class="cart-grid">

    <?php

    $items = array();
    $total = 0;
    if (isset($_SESSION['elements'])) {
        $ids = explode(',', $_SESSION['elements']);
    } else $ids = array();


    foreach ($ids as $id) {
        if (is_numeric($id)) {
            $result = getQueryResult(
                "SELECT id, title, price, src, sale FROM users.items WHERE id = '$id'");
            $itm = getItemsFromResult($result)[0];
            $items[] = $itm;
            $total += $itm['price'];
        }
    }

    foreach ($items as $item): ?>

        <div id="<?= $item['id'] ?>" class="item-page cart">
            <img class='item_img gradient cart' src="<?= $item['src'] ?>"
                 onclick="switchPage('item&item=<?= $item['id'] ?>')" alt="Product Image">
            <div class="item-details cart">
                <h1 class="item-name"><?= $item['title'] ?></h1>
                <p class="item-price">$<?= $item['price'] ?></p>
                <img id="buy" src="../images/trash.svg" onclick="delFromItemList(<?= $item['id'] ?>)" class="gradient">
            </div>
        </div>

    <?php endforeach; ?>

    <div style="display: flex; justify-content: center;">
        <h1 class="item-name" style="margin-top:35px;  width: max(30vw, 200px);">Total: <?= $total ?></h1>
        <button style="margin: auto " class="important-button gradient"
                onclick="if (<?= $_SESSION['logged_in'] ?> === 1) {
                        if (<?= $total ?> !== 0) buy(<?= $total ?>)
                        else showCustomAlert('Nothing to buy :)')
                        }
                        else showCustomAlert('Log In to buy :)') "
        >Buy</button>
    </div>

</div>


<?php includeFooter(); ?>


<script src="../js/header.js"></script>


</body>
</html>

