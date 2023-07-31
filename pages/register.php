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
    <div class="content register">
        <img src="../images/dress1.png" class="icon " alt="Image">

        <form method="post">

            <input name="email" type="email" class="gradient" placeholder="Email" required>
            <input name="name" type="text" class="gradient" placeholder="Name" required>
            <input name="surname" type="text" class="gradient" placeholder="Surname" required>
            <input name="phone" type="tel" class="gradient" placeholder="Phone" required>
            <input name="password" type="password" class="gradient" placeholder="Password" required>
            <input name="password_rep" type="password" class="gradient" placeholder="Repeat Password" required>
            <span id="passwordRepError" class="error"></span>
            <button id="login" class="important-button gradient" type="submit" >Submit</button>
        </form>
        <button id="back" class="important-button">Back</button>
        <span id="guestMode" class="text" onclick="switchPage('main')">Continue as guest</span>

    </div>
</div>

<?php includeFooter(); ?>
<?php includeWarning(); ?>

<script type="module" src="../js/register.js"></script>
<script type="module" src="../js/main.js"></script>

<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user input from the form
    $email = $_POST["email"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $password_rep =  $_POST["password_rep"];
    $hashedPassword = hash('sha512', $password);

    $result = getQueryResult("SELECT * FROM users.users_info WHERE email = ?", $email);

    if ($result->num_rows > 0) {
        echo "<script>showCustomAlert('Email already exists! Please choose a different email.');</script>";
    } else if ($password != $password_rep) {
        echo "<script>showCustomAlert('Passwords doesnt match');</script>";
    }
    else {
        $connection = new mysqli('localhost', 'root', '1029384756', 'users');
        $insertQuery = "INSERT INTO users.users_info (email, username, first_name, last_name, phone_number, hashed_password) VALUES (?, ?, ?, ?, ?, ?)";
        $insertStmt = $connection->prepare($insertQuery);
        $insertStmt->bind_param("ssssss", $email,$name ,$name, $surname, $phone, $hashedPassword);

        if ($insertStmt->execute()) {
            echo "<script>console.log('User added successfully!'); switchPage('login')</script>";
        } else {
            echo "<script>console.log('Error adding user. Please try again.')</script>";
        }
        $connection->close();
    }


}
?>

</body>
</html>
