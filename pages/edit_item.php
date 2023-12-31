<?php
$id = $_GET['id'];
if ($id != "") {
    $result = getQueryResult("SELECT id, title, price, src, sale, collection, description FROM users.items WHERE id = '$id'");
    $item = getItemsFromResult($result)[0] ?? array();
    $subm = 'Submit';
} else {
    $zero = array();
    $zero['title'] = "";
    $zero['price'] = "";
    $zero['collection'] = "";
    $zero['description'] = "";
    $zero['sale'] = "";
    $zero['src'] = "../images/dress1.png";
    $item = $zero;
    $subm = 'Add Item';
}
$_SESSION['new_img_dir'] = $item['src'];

//$src = $item['src'] ?? "../images/dress1.png";


$colls = getItemsFromResult(getQueryResult("SELECT DISTINCT collection FROM users.items"));
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/elements.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/item.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Profile</title>
</head>
<body style="background-image: url(../images/background.png);">
<?php includeAdminHeader(); ?>
<!--<form action="upload.php" method="post" enctype="multipart/form-data">-->
<form action="upload.php" id=profile class="profile item-page" method="post" enctype="multipart/form-data">
    <!--<form id=profile class="profile item-page" method="post">-->
    <div class="block" id="i" style="margin: 0 auto">
        <img class='item_img gradient' id="image" src="<?= $item['src'] ?>">
        <label id="img" class="important-button gradient" style="display: none">
            Choose new image:<p id="imageFileValue" style="padding: 0"></p>
            <input type="file" id="imageFile" name="editable" onchange="fileName()" style="display: none" disabled>
        </label>

        <button id='back' class="important-button gradient" type="button">Back
        </button>
    </div>
    <div class="item-details">
        <input style="font-size: 1.5rem; width: 20rem" id="title" name="editable" class="gradient"
               value="<?= $item['title'] ?>" disabled>
        <div class="flex">
            <label>Price in $:</label>
            <input name="editable" style="width: 3rem" id='price' class="gradient" type="text"
                   value="<?= $item['price'] ?>" disabled>
        </div>
        <div class="flex">
            <label>Sale in %:</label>
            <input name="editable" style="width: 3rem" id='sale' class="gradient" type="text"
                   value="<?= $item['sale'] ?>" disabled>
        </div>
        <div class="flex">
            <label>Collection:</label>
            <input name="editable" list="collectionList" id='collection' style="width: 5rem" class="gradient"
                   type="text"
                   value="<?= $item['collection'] ?>" disabled>
            <datalist id="collectionList">
                <?php foreach ($colls

                as $coll): ?>
                <option value=<?= $coll['collection'] ?>>
                    <?php endforeach; ?>
            </datalist>
        </div>
        <h2>Description</h2>
        <textarea name="editable" id='description' style="width: 100%; height: auto" class="gradient" type="text"
                  disabled><?= $item['description'] ?></textarea>
        <button id="edit" class="important-button gradient" type="button" onclick="enable();">Edit</button>
        <button id="submit" form=profile class="important-button gradient" type="button" style="display: none"
                onclick="uploadImage();editSmth('edit_item&id=<?= $id; ?>',
                        {
                        'title': document.getElementById('title').value,
                        'price': document.getElementById('price').value,
                        'collection': document.getElementById('collection').value,
                        'description': document.getElementById('description').value,
                        'sale': document.getElementById('sale').value,
                        'src' : retName()
                        });enable();"><?= $subm ?>
        </button>
    </div>
</form>

</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function retName() {
        let imgInput = document.getElementById('imageFile')
        if (imgInput.files && imgInput.files[0]) {
            return "../images/" + imgInput.value.split('\\')[2]
        } else return '<?=$item['src']?>'

    }

    function fileName() {
        let imgInput = document.getElementById('imageFile')
        document.getElementById('imageFileValue').textContent = imgInput.value.split('\\')[2]
        if (imgInput.files && imgInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('image').src = e.target.result;
            };
            reader.readAsDataURL(imgInput.files[0]);
        }
    }

    function uploadImage() {
        const fileInput = document.getElementById('imageFile');
        const file = fileInput.files[0];

        if (file) {
            const formData = new FormData();
            formData.append('image', file);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php?page=edit_item&id=<?=$id?>', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                }
            };
            xhr.send(formData);
            console.log('posted image')
        }
    }
</script>

<?php includeFooter(); ?>
<?php includeWarning(); ?>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['image'])) {
    ?>
    <script>console.log('got image')</script><?php
    $targetDir = "/Users/sashafedorova/NUP/web_at/WebNupPhp/images/"; // Directory where images will be stored
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_GET['id'];
    if ($id != 1) {
        getQueryResult("DELETE FROM users.items  WHERE id = $id");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $collection = $_POST['collection'];
    $description = $_POST['description'];
    $sale = $_POST['sale'];
    $id = $_GET['id'];
    $src = $_POST['src'];
    if ($id != "") {
        getQueryResult("UPDATE users.items SET title = '$title', sale=$sale, price = $price, collection='$collection', description='$description', src = '$src'  WHERE id = $id");
    } else {
        getQueryResult("INSERT INTO users.items (title, sale, price, collection, description, src) VALUES ('$title',$sale, $price,'$collection','$description', '$src')");
        ?>
        <script>switchPage('edit_items')</script>
        <?php
    }
}


?>

</html>