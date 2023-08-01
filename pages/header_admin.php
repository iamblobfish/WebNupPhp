<?php

global $base_url;

$_SESSION['id'] = $_POST['newId'] ?? $_SESSION['id'];
$_SESSION['logged_in'] = $_POST['loggedin'] ?? $_SESSION['logged_in'];
$_SESSION['admin'] = $_POST['admin'] ?? $_SESSION['admin'];

if (isset($_SESSION['logged_in']) and $_SESSION['logged_in'] == "1") {
    $icon_path = "../images/profile.svg";
    $profile = "switchPage('profile')";
    $orders = "switchPage('orders')";
} else {
    $icon_path = "../images/sign-in.svg";
    $profile = "switchPage('login')";
    $orders = "showCustomAlert('Log In to view orders :)')";
}


?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<header style="justify-content: ">
    <span id="register" class="gradient important-button" onclick="switchPage('edit_items')">Edit Items</span>
    <span id="register" class="gradient important-button" onclick="switchPage('edit_users')">Edit Users</span>
    <span id="register" class="gradient important-button" onclick="switchPage('edit_orders')">Edit Orders</span>
    <img id="exit" class="gradient" src="../images/no-crystal-ball.svg" alt="search" style="margin-right: 2px" onclick="switchPage('main')">
    <img id="exit" class="gradient" src="../images/exit-2.svg" alt="search" style=" margin-left:0 ;margin-right: auto" onclick="logOut();switchPage('login')">
</header>








