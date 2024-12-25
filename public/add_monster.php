<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $hitPoints = $_POST['hitPoints'];

    if (!empty($name) && !empty($type) && !empty($hitPoints)) {
        try {
            $sql = 'INSERT INTO monsters (name, type, hitPoints) VALUES (?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $type, $hitPoints]);
            header('Location: index.php');
            exit();
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'All fields are required.';
    }
} else {
    echo 'Invalid request method.';
}
?>