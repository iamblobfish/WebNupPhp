<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['image'])) {
    $targetDir = "/Users/sashafedorova/NUP/web_at/WebNupPhp/images/"; // Directory where images will be stored
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    echo $targetFile;
    echo "File uploaded successfully.";
}



