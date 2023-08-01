<?php
$result = getQueryResult(
    "SELECT email,admin, username, first_name, last_name, phone_number, photo FROM users.users_info WHERE id = ?",
    $_GET['id']);

$profile = getItemsFromResult($result)[0];

$id = $_GET['id'];

$src = $profile['photo'] ?? "../images/profile.svg";

if ($id == 1) {
    $del = 'none';
} else $del = 'flex';
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Profile</title>
</head>
<body style="background-image: url(../images/background.png);">
<?php includeAdminHeader(); ?>
<form id=profile class="profile" method="post">
    <div class="block">
        <img id="profileImage" src="<?= $src ?>" class="item" alt="Profile Image">
        <button class="important-button gradient" type="button"
                onclick="deleteSmth('user&id=<?= $id; ?>',  <?= $id; ?>)" style="display: <?= $del ?>">Delete Account
        </button>
        <button id='back' class="important-button gradient" type="button">Back
        </button>
    </div>
    <div class="block">
        <input id="name" name="editable" class="gradient" value="<?= $profile['username'] ?>" disabled>
        <div class="flex">
            <label style="padding-right: 10px">Admin:</label>
            <input name="editable" style="width: 1rem" id='a' class="gradient" type="text"
                   value="<?= $profile['admin']; ?>" disabled>
        </div>
        <input id='email' name="editable" class="gradient" type="email" value="<?= $profile['email']; ?>" disabled>
        <input id='phone' name="editable" class="gradient" type="tel" value="<?= $profile['phone_number']; ?>" disabled>

        <!--        <input id='last_name' name="editable" class="gradient" type="tel" value="-->
        <?php //= $profile['last_name']; ?><!--" disabled>-->


        <button id="edit" class="important-button gradient" type="button" onclick="enable();">Edit</button>
        <button id="submit" form=profile class="important-button gradient" type="button" style="display: none"
                onclick="enable(); editSmth('user&id=<?= $id; ?>',
                        {
                        'name': document.getElementById('name').value,
                        'a': document.getElementById('a').value,
                        'email': document.getElementById('email').value,
                        'phone': document.getElementById('phone').value,
                        }); location.reload()">Submit
        </button>


    </div>

</form>

</body>

<?php includeFooter(); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {

    $name = $_POST['name'];
    $a = $_POST['a'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $id = $_GET['id'];
    if ($id != ""){
        getQueryResult("UPDATE users.users_info SET username = '$name', admin = '$a', email='$email', phone_number='$phone'  WHERE id = $id");
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_GET['id'];
    if ($id != 1) {
        getQueryResult("DELETE FROM users.users_info  WHERE id = $id");
    }
}
?>

</html>