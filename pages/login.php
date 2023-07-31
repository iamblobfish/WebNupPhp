
<!DOCTYPE html>
<html lang="">
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">
    <title>Login</title>

</head>
<body style="background-image: url(../images/background.png);">

<!--Content-->
<div class="container">
    <div class="content">
        <img src="../images/dress1.png" class="icon" alt="Image">
        <form method="post">

            <input name="email" type="email" class="gradient" placeholder="Email">
            <input name="password" type="password" class="gradient" placeholder="Password">
            <button id="login" class="important-button gradient">Login</button>
        </form>
        <button id="back" class="important-button">Back</button>

        <span id="register" class="text" onclick="switchPage('register')">Register</span>
        <span id="fgtPassword" class="text" onclick="switchPage('reset')">Forgot password?</span>
        <span id="guestMode" class="text" onclick="switchPage('main')">Continue as guest</span>

    </div>
</div>
<?php includeWarning(); ?>
<?php includeFooter(); ?>
<script type="module" src="../js/main.js"></script>
<?php

// Function to get the hashed password from the database based on the email
function is_ok($email, $password)
{
    $result = getQueryResult("SELECT id, hashed_password FROM users_info WHERE email = ?", $email);

    $enteredPassword = hash('sha512', $password);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['hashed_password'];
        $is_ok = ($hashed_password == $enteredPassword);
        return $is_ok ? $row['id'] : "Wrong Password";
    } else return "User not found";
}

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];
    if ($email and $password){
        $is_ok = is_ok($email, $password);
        echo "<script>console.log($is_ok)</script>";
        if (is_numeric($is_ok)) {
            $_SESSION["logged_in"] = "1";
            $_SESSION["id"] = $is_ok;
            echo "<script>switchPage('main');</script>";
        } else {
            echo "<script>showCustomAlert('$is_ok');</script>";
        }
    }
}
?>
</body>
</html>

