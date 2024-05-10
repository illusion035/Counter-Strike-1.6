<?php
// Функция за връзка с базата данни чрез PDO
function pdo_connect() {
    $host = 'localhost'; // Адресът на базата данни
    $db_name = 'ranks'; // Името на базата данни
    $username = 'root'; // Потребителското име за вход
    $password = ''; // Паролата за вход

    try {
        $pdo = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
        // Задаване на режим на грешките за PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        // Обработка на грешки, ако възникне проблем при връзката
        die("Connection failed: " . $e->getMessage());
    }
}
?>
