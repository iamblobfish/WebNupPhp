<?php

set_include_path(__DIR__ . '/includes');

$host = 'localhost';
$username = 'root';
$password = '1029384756';
$database = 'users';

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Error connecting to database: " . $connection->connect_error);
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
// Закрытие соединения с базой данных
$connection->close();


$request_url = 'main.html';


// Remove the query string from the URL if present
if (($pos = strpos($request_url, '?')) !== false) {
    $request_url = substr($request_url, 0, $pos);
}

// Define the routes for different pages
$routes = array(
    '/' => 'main_php.html',              // The main homepage
//    '/about' => 'about.html',        // About page
//    '/contact' => 'contact.html',    // Contact page
    // Add more routes for additional pages as needed
);

// Determine which page to serve based on the requested URL
$page = isset($routes[$request_url]) ? $routes[$request_url] : '404.html';

// Check if the page file exists, if not, serve a 404 page
if (!file_exists($page)) {
    $page = '404.html';
}

// Include the header HTML
include 'header.html';

// Include the requested page HTML
include($page);

// Include the footer HTML
include('footer.html');


