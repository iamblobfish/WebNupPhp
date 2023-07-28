<?php
// index.php
const BASE_PATH = __DIR__;
const INCLUDES_PATH = BASE_PATH . '/includes';

$request_url = '/';

$routes = array(
    '/' => 'main_php.php'
);

function includeHeader(): void
{
    include 'pages/header.php';
}
function includeFooter(): void
{
    include INCLUDES_PATH . '/footer.html';
}

$connection = new mysqli('localhost', 'root', '1029384756', 'users');
if ($connection->connect_error) {
    die("Error database connection: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch data from the database
    $query = "SELECT id, title, price, src FROM items";
    $result = $connection->query($query);

    // Check if there are any records
    if ($result->num_rows > 0) {
        // Fetch the data and store it in an array
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
}

$connection->close();
?>

<?php

session_start();
$_SESSION['logged_in'] = "1";

$request_uri = $_SERVER['REQUEST_URI'];
$pos = stripos($request_uri, '?');
if ($pos !== false) {
    $request_uri = substr($request_uri, 0, $pos);
}

if ($request_uri === '/WebNupPhp/' || $request_uri === '/WebNupPhp/index.php') {
//    header('Location: ' . $request_uri); // Perform the HTTP redirect
    include 'pages/main_php.php';
} else {
    include INCLUDES_PATH . '/404.html';
}
?>



