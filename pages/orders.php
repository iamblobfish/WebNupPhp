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


<div class="cart-grid">

    <?php
    $user_id = $_SESSION['id'];
    $result = getQueryResult(
        "SELECT id, ids, total FROM users.orders WHERE user_id = $user_id");

    $items = getItemsFromResult($result);
    foreach ($items as $index => $item) {
        $str = str_replace(',', ' OR id = ', $item['ids']);
        $result = getQueryResult(
            "SELECT title FROM users.items WHERE id = $str");
        $id_values = array();
        foreach (getItemsFromResult($result) as $r) {
            $id_values[] = $r['title'];
        }
        $items[$index]['names'] = implode(", ", $id_values);

    }
    ?>

    <h1>Order Table</h1>
    <table>
        <tr class="gradient">
            <th>Order ID</th><th>Names</th><th>Total</th>
        </tr>
        <?php foreach ($items as $item): ?>
    <tr class="gradient">
        <td><?php echo $item['id']; ?></td>
        <td><?php echo $item['names']; ?></td>
        <td>$<?php echo $item['total']; ?></td>
    </tr>
    <?php endforeach; ?>
    </table>

</div>


<?php includeFooter(); ?>
<?php includeWarning(); ?>

<script src="../js/header.js"></script>


</body>
</html>

