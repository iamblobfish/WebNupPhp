<?php

if (isset($_SESSION['logged_in']) and $_SESSION['logged_in'] == "1")  {
    $icon_path = "../images/profile.svg";
    $on_click = "switchProfile()";
} else {
    $icon_path = "../images/sign-in.svg";
    $on_click = "switchLogin()";
}
?>



<header>
    <img id="home" class="gradient" src="../images/home.svg" onclick="switchMain()" alt="search">
    <p class="gradient" onclick="switchCategory()">Categories</p>
    <div class="gradient search-row">
        <input id="search_input" name="search_input" type="text" class="search-input" placeholder="Search...">
        <img id="clear" src="../images/close.svg" onclick="clearSearch()" alt="close">
    </div>
    <img id="search" class="search-btn gradient" src="../images/search.svg" onclick="switchSearch()" alt="search">
    <img id="profile" class="gradient" src="<?php echo $icon_path; ?>" onclick="<?php echo $on_click; ?>" alt="profile">

    <img id="orders" class="gradient" src="../images/box.svg" alt="search">
    <img id="cart" class="gradient" src="../images/cart.svg" alt="search">
</header>




