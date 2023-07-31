<?php
$result = getQueryResult(
    "SELECT email, username, first_name, last_name, phone_number, photo FROM users.users_info WHERE id = ?",
    $_SESSION['id']);

$_SESSION['id'] = $_POST['newId'] ?? $_SESSION['id'];

$_SESSION['logged_in'] = $_POST['loggedin'] ?? $_SESSION['logged_in'];

$profile = getItemsFromResult($result)[0];

$src = $profile['photo'] ?? "../images/profile.svg";

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
<?php includeHeader(); ?>
<form id=profile class="profile" method="post">
    <div class="block">
        <img id="profileImage" src="<?= $src ?>" class="item" alt="Profile Image">
        <button id="logout" class="important-button gradient" onclick="logOut()" type="button">LogOut</button>
        <button class="important-button gradient" type="button" onclick="deleteProfile(); logOut()">Delete Account</button>
    </div>
    <div class="block">
        <input id="name" name="editable" class="gradient" value="<?= $profile['username'] ?>" disabled>
        <input id='email' name="editable" class="gradient" type="email" value="<?= $profile['email']; ?>" disabled>
        <input id='phone' name="editable" class="gradient" type="tel" value="<?= $profile['phone_number']; ?>" disabled>


        <label for="address">Addresses:</label>
        <input id="address" disabled class="gradient" value="Street 1,1, 1">

        <button id="edit" class="important-button gradient" type="button" onclick="enable()">Edit</button>
        <button id="submit" form=profile class="important-button gradient" type="button" style="display: none"
                onclick="enable(); postProfile()">Submit
        </button>


    </div>

</form>

</body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $name = $_POST['name'];
    $id = $_SESSION['id'];
    getQueryResult("UPDATE users.users_info SET username = '$name'  WHERE id = $id;");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_SESSION['id'];
    getQueryResult("DELETE FROM users.users_info  WHERE id = $id;");
}
?>
<?php includeFooter(); ?>

</html>