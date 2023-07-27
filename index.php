<?php
// index.php
const BASE_PATH = __DIR__;

const INCLUDES_PATH = BASE_PATH . '/includes';

// Function to include header and footer files
function includeHeader()
{
    include INCLUDES_PATH . '/header.html';
}

// Function to include the main content file (main.html)
function includeContent($page_name)
{
    include INCLUDES_PATH . '/' .$page_name;
}

// Function to include footer file
function includeFooter()
{
    include INCLUDES_PATH . '/footer.html';
}

$request_url = '/';

// Remove the query string from the URL if present
if (($pos = strpos($request_url, '?')) !== false) {
    $request_url = substr($request_url, 0, $pos);
}

// Define the routes for different pages
$routes = array(
    '/' => 'main.html',              // The main homepage
    '/about' => 'about.html',        // About page
    '/contact' => 'contact.html',    // Contact page
    // Add more routes for additional pages as needed
);

// Determine which page to serve based on the requested URL
$page = isset($routes[$request_url]) ? $routes[$request_url] : '404.html';

// Check if the page file exists, if not, serve a 404 page
if (!file_exists($page)) {
    $page = '404.html';
}


includeHeader();
includeContent('main_php.html');
includeFooter();



