<?php
$id = $_GET['id'];
if ($id != "") {
    $result = getQueryResult("SELECT id, title, price, src, sale, collection, description FROM users.items WHERE id = '$id'");
    $item = getItemsFromResult($result)[0];
} else {
    $zero = array();
    $zero['title']= "";$zero['price']= "";$zero['collection']= "";$zero['description']= "";$zero['sale']= ""; $zero['src']= "../images/dress1.png";
    $item = $zero;
}



$src = $item['src'] ?? "../images/dress1.png";



if ($id == 1) {
    $del = 'none';
} else $del = 'flex';

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
<form id=profile class="profile item-page" method="post">
    <div class="block" style="margin: 0 auto">
        <img class='item_img gradient' src="<?= $item['src'] ?>" alt="Product Image">
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
            <input name="editable" list="collectionList" id='collection' style="width: 5rem" class="gradient" type="text"
                   value="<?= $item['collection'] ?>" disabled>
            <datalist id="collectionList">
                <?php foreach ($colls as $coll): ?>
                <option value=<?=$coll['collection']?>>
                    <?php endforeach; ?>
            </datalist>
        </div>
        <h2>Description</h2>
        <textarea name="editable" id='description' style="width: 100%; height: auto" class="gradient" type="text"
                  disabled><?= $item['description'] ?></textarea>
        <button id="edit" class="important-button gradient" type="button" onclick="enable();">Edit</button>
        <button id="submit" form=profile class="important-button gradient" type="button" style="display: none"
                onclick="enable(); editSmth('edit_item&id=',
                        {
                        'title': document.getElementById('title').value,
                        'price': document.getElementById('price').value,
                        'collection': document.getElementById('collection').value,
                        'description': document.getElementById('description').value,
                        'sale': document.getElementById('sale').value,
                        })">Submit
        </button>
    </div>

</form>

</body>

<?php includeFooter(); ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $collection = $_POST['collection'];
    $description = $_POST['description'];
    $sale = $_POST['sale'];
    $id = $_GET['id'];
    if ($id != "") {
        getQueryResult("UPDATE users.items SET title = '$title', sale=$sale, price = $price, collection='$collection', description='$description'  WHERE id = $id");
    } else {
        getQueryResult("INSERT INTO users.items (title, sale, price, collection, description) VALUES ($title,$sale, $price,$collection,$description)");
        $new_id = getItemsFromResult(getQueryResult("SELECT id FROM users.items WHERE title = $title"))[0]['id'];
//        echo "<script>switchPage('edit_item&id=$new_id')</script>";
        echo $new_id;
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_GET['id'];
    if ($id != 1) {
        getQueryResult("DELETE FROM users.items  WHERE id = $id");
    }
}
?>

</html>