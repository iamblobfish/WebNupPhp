<?php
// Your PHP code here...
$l = false;
// Check if the condition to show the popup is met (e.g., a certain button is clicked)

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
</head>
<body style = "background-image: url(../images/background.png);">
    <!-- Your HTML content here... -->
    <button class="important-button gradient" onclick=showCustomAlert()>Show Popup</button>

    <!-- Your PHP code here... -->

</body>
<?php  includeWarning();?>
<?php includeFooter();?>

<script type="module" src="../js/main.js"></script>
</html>

