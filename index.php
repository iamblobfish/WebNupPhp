<?php
// index.php
const BASE_PATH = __DIR__;
const INCLUDES_PATH = BASE_PATH . '/includes';


function includeHeader(): void
{
    include 'pages/header.php';
}

function includeWarning(): void
{
    include 'includes/warning.html';
}

function includeFooter(): void
{
    include INCLUDES_PATH . '/footer.php';
}

function includeAdminHeader(): void
{
    include 'pages/header_admin.php';
}

function getQueryResult($query, $add = null)
{
    $connection = new mysqli('localhost', 'root', '1029384756', 'users');
    if ($connection->connect_error) {
        die("Error database connection: " . $connection->connect_error);
    }
    if ($add == null) {
        $result = $connection->query($query);
    } else {
        // Create a prepared statement
        $stmt = $connection->prepare($query);
        $stmt->bind_param('s', $add);
        $stmt->execute();
        $result = $stmt->get_result();
    }
    $connection->close();
    return $result;
}

function getItemsFromResult($result): array
{
    if ($result->num_rows > 0) {
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
    return $items ?? [];
}

session_start();
?>

<?php

$page = $_GET['page'] ?? '';


$previousPage = $_SERVER['HTTP_REFERER']['page'] ?? 'N/A';
// Check which page is requested and include the corresponding PHP file
try {
    switch ($page) {
        case '':
        case 'main':

            include 'pages/main_php.php';
            break;
        case 'profile':
            if (isset($_SESSION['logged_in']) and $_SESSION['logged_in'] == "1") {
                include 'pages/profile.php';
            } else {
                echo '<h1>Please Log In to open profile :)</h1>';
                echo "<span class='text' style='text-align: center' onclick=switchPage('login')>Log In</span>";
                include 'includes/404.php';
            }
            break;
        case 'login':
            include 'pages/login.php';
            break;
        case 'category':
            include 'pages/category.php';
            break;
        case 'reset':
            include 'pages/reset.php';
            break;
        case 'register':
            include 'pages/register.php';
            break;
        case 'check':
            include 'pages/check.php';
            break;
        case 'search':
            include 'pages/search.php';
            break;
        case 'cart':
            include 'pages/cart.php';
            break;
        case 'orders':
            include 'pages/orders.php';
            break;
        case 'item':
            if (isset($_GET['item']) && $_GET['item'] != "") {
                include 'pages/item.php';
            } else {
                echo '<h1>Page ' . $page . ' not found, sorry :)</h1>';
                include 'includes/404.php';
            }
            break;
        case 'choice':
            if (isset($_SESSION['admin']) and $_SESSION['admin'] == "1") {
                include 'pages/choice.php';
            } else {
                echo '<h1>Page ' . $page . ' not found, sorry :)</h1>';
                include 'includes/404.php';
            }
            break;
        case  "edit_orders":
            if (isset($_SESSION['admin']) and $_SESSION['admin'] == "1") {
                include 'pages/editOrders.php';
            } else {
                echo '<h1>Page ' . $page . ' not found, sorry :)</h1>';
                include 'includes/404.php';
            }
            break;
        case  "edit_items":
            if (isset($_SESSION['admin']) and $_SESSION['admin'] == "1") {
                include 'pages/editItems.php';
            } else {
                echo '<h1>Page ' . $page . ' not found, sorry :)</h1>';
                include 'includes/404.php';
            }
            break;
        case  "edit_users":
            if (isset($_SESSION['admin']) and $_SESSION['admin'] == "1") {
                include 'pages/editUsers.php';
            } else {
                echo '<h1>Page ' . $page . ' not found, sorry :)</h1>';
                include 'includes/404.php';
            }
            break;
        case  "user":
            if (isset($_SESSION['admin']) and $_SESSION['admin'] == "1" ) {
                $id = $_GET['id'];
                if (sizeof(getItemsFromResult(getQueryResult("SELECT id FROM users.users_info WHERE id = $id")))== 1)
                    include 'pages/edit_user.php';
                else {
                    echo '<h1>User with id ' . $id . ' not found, sorry :)</h1>';
                    include 'includes/404.php';
                }
            } else {
                echo '<h1>Page ' . $page . ' not found, sorry :)</h1>';
                include 'includes/404.php';
            }
            break;
        case  "edit_item":
            if (isset($_SESSION['admin']) and $_SESSION['admin'] == "1") {
                $id = $_GET['id'];
                if (sizeof(getItemsFromResult(getQueryResult("SELECT id FROM users.items WHERE id = $id")))== 1)
                    include 'pages/edit_item.php';
                else {
                    echo '<h1>Item with id ' . $id . ' not found, sorry :)</h1>';
                    include 'includes/404.php';
                }

            } else {
                echo '<h1>Page ' . $page . ' not found, sorry :)</h1>';
                include 'includes/404.php';
            }
            break;
        default:
            echo '<h1>Page ' . $page . ' not found, sorry :)</h1>';
            include 'includes/404.php';
            break;
    }
} catch (Exception $e) {
    // Handle the exception here
    echo "Caught exception: " . $e->getMessage();
    include 'includes/error.html';
} catch (Error $e) {
    // Handle the error here
    echo "Caught error: " . $e->getMessage();
    include 'includes/error.html';
}


?>



