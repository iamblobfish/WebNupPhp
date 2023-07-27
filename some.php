<?php
// Параметры подключения к базе данных
$host = 'localhost'; // Хост базы данных
$username = 'root'; // Имя пользователя базы данных
$password = '1029384756'; // Пароль для доступа к базе данных
$database = 'users'; // Имя базы данных

// Подключение к базе данных
$connection = new mysqli($host, $username, $password, $database);

// Проверка соединения
if ($connection->connect_error) {
    die("Ошибка подключения к базе данных: " . $connection->connect_error);
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
?>
    <!-- Include the HTML content from the index.html file -->
<?php include 'templates/main_php.html'; ?>