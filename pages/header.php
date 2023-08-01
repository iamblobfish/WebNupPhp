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

if (isset($_SESSION['admin']) and $_SESSION['admin'] == "1") {
    $style = 'flex';
} else $style = 'none';

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<header>
    <img id="home" class="gradient" src="../images/home.svg" onclick="switchPage('main')" alt="search">
    <p class="gradient" onclick="switchPage('category')">Collections</p>
    <div class="gradient search-row">
        <input id="search_input" name="search_input" type="text" class="search-input" placeholder="Search..." value="<?=$_GET['search'] ?? ''?>">
        <img id="clear" src="../images/close.svg" alt="close">
    </div>
    <img id="search" class="search-btn gradient" src="../images/search.svg"
         onclick="switchPage('search&search='+ (document.getElementById('search_input').value ?? ''))"
         alt="search">
    <img class="gradient" src="<?php echo $icon_path; ?>" onclick="<?php echo $profile; ?>" alt="profile">

    <img id="orders" class="gradient" src="../images/box.svg" alt="search" onclick="<?=$orders?>">
    <img id="cart" class="gradient" src="../images/cart.svg" alt="search" onclick="switchPage('cart')">
    <img id="admin" class="gradient" src="../images/crystal-ball-2.svg" alt="search" onclick="switchPage('edit_orders')" style="display: <?=$style?>">

</header>








