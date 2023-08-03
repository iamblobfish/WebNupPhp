<!DOCTYPE html>
<html lang="">
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">
<!--    <link rel="stylesheet" type="text/css" href="../css/item.css">-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title> Cart </title>
    <style>
        th:nth-child(1), td:nth-child(1) {
            width: 10rem;
        }

        th:nth-child(2), td:nth-child(2) {
            width: 10rem;
        }

        th:nth-child(3), td:nth-child(3) {
            width: 20rem;
        }

        th:nth-child(4), td:nth-child(4) {
            width: 15rem;
        }
        th:nth-child(5), td:nth-child(5) {
            border: none;
        }
    </style>

</head>
<body style="background-image: url(../images/background.png);">

<?php includeAdminHeader(); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['delete'];
    getQueryResult("DELETE FROM users.orders  WHERE id = $id");
}
?>

<div class="cart-grid">

    <?php
    $user_id = $_SESSION['id'];
    $result = getQueryResult(
        "SELECT id, user_id, ids, total FROM users.orders");

    $items = getItemsFromResult($result);

    ?>

    <h1>Orders</h1>
    <table class="admin">
        <tr>
            <th>Order ID</th><th>User Id</th><th>Names</th><th>Total</th>
        </tr>
        <?php foreach ($items as $item): ?>
    <tr >
        <td><?php echo $item['id']; ?></td>
        <td><?php echo $item['user_id']; ?></td>
        <td><?php echo $item['ids']; ?></td>
        <td>$<?php echo $item['total']; ?></td>
        <td><img id="buy" src="../images/trash.svg" style="margin-left: 1rem" onclick="deleteSmth('edit_orders',  <?=$item['id'];?>)"></td>
    </tr>
    <?php endforeach; ?>
    </table>

</div>


<?php includeFooter(); ?>
<?php includeWarning(); ?>

</body>
</html>

