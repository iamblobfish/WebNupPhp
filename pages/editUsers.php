<!DOCTYPE html>
<html lang="">
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title> Cart </title>
    <style>
        th:nth-child(1), td:nth-child(1) {
            width: 2rem;
        }

        th:nth-child(2), td:nth-child(2) {
            width: 3rem;
        }

        th:nth-child(3), td:nth-child(3) {
            width: 10rem;
        }

        th:nth-child(4), td:nth-child(4) {
            width: 10rem;
        }
        th:nth-child(5), td:nth-child(5) {
            width: 15rem;
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

    if ($id != '11') {
        getQueryResult("DELETE FROM users.users_info  WHERE id = $id");
    }
}


?>

<div class="cart-grid">

    <?php
    $user_id = $_SESSION['id'];
    $result = getQueryResult(
        "SELECT id, admin,phone_number, email, username  FROM users.users_info WHERE NOT id = 1 AND NOT id = $user_id");

    $items = getItemsFromResult($result);

    ?>
    <h1>Users</h1>
    <table class="admin">
        <tr>
            <th>ID</th><th>Admin</th><th>Email</th><th>UserName</th><th>Phone</th>
        </tr>
        <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo $item['id']; ?></td>
        <td><?php echo $item['admin']; ?></td>
        <td><?php echo $item['email']; ?></td>
        <td><?php echo $item['username']; ?></td>
        <td><?php echo $item['phone_number']; ?></td>
        <td><img id="del" src="../images/trash.svg" style="margin-left: 1rem" onclick="deleteSmth('edit_users',  <?=$item['id'];?>)"></td>
        <td><img id="edit" src="../images/pencil-2.svg" style="margin-left: 1rem" onclick="switchPage('user&id=<?=$item['id'];?>')"></td>
    </tr>
    <?php endforeach; ?>
    </table>

</div>


<?php includeFooter(); ?>
<?php includeWarning(); ?>

</body>
</html>

