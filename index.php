<?php

// Define the base URL of the site
$base_url = "http://dresses.com"; // Replace with your domain name

// Get the requested URL
$request_url = $_SERVER['REQUEST_URI'];

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
include('templates/header.html');

// Include the requested page HTML
include($page);

// Include the footer HTML
include('templates/footer.html');
