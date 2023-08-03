<!DOCTYPE html>
<html lang="">
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title> Cart </title>
    <style>
        th:nth-child(1), td:nth-child(1) {
            width: 2rem;
        }

        th:nth-child(2), td:nth-child(2) {
            width: 15rem;
        }

        th:nth-child(3), td:nth-child(3) {
            width: 10rem;
        }

        th:nth-child(4), td:nth-child(4) {
            width: 10rem;
        }
        th:nth-child(5), td:nth-child(5) {
            width: 10rem;
        }
        th:nth-child(6), td:nth-child(6) {
            border: none;
        }
        th:nth-child(7), td:nth-child(7) {
            border: none;
        }
    </style>

</head>
<body style="background-image: url(../images/background.png);">

<?php includeAdminHeader(); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['delete'];
    getQueryResult("DELETE FROM users.items  WHERE id = $id");
}
?>

<div class="cart-grid">

    <?php
    $user_id = $_SESSION['id'];
    $result = getQueryResult(
        "SELECT id, title, collection, src, price, description, sale  FROM users.items");

    $items = getItemsFromResult($result);

    ?>
    <div class="flex">
    <h1 style="margin-left: auto; margin-right: 1rem">Items</h1>
    <img src="../images/plus.svg" style=" margin: auto auto auto 1rem;" onclick="switchPage('edit_item&id=')">
    </div>
    <table class="admin">
        <tr>
            <th>Item ID</th><th>Name</th><th>Collection</th><th>Price</th><th>Sale</th>
        </tr>
        <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['id']; ?></td>
        <td><?php echo $item['title']; ?></td>
        <td><?php echo $item['collection']; ?></td>
        <td><?php echo $item['price']; ?></td>
        <td><?php echo $item['sale']; ?></td>
        <td><img id="buy" src="../images/trash.svg" style="margin-left: 1rem" onclick="deleteSmth('edit_items',  <?=$item['id'];?>)"></td>
        <td><img id="buy" src="../images/pencil-2.svg" style="margin-left: 1rem" onclick="switchPage('edit_item&id=<?=$item['id'];?>')"></td>
    </tr>
    <?php endforeach; ?>
    </table>

</div>


<?php includeFooter(); ?>
<?php includeWarning(); ?>

</body>
</html>

