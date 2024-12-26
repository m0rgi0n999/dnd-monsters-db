<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $hitPoints = $_POST['hitPoints'];
    $armorClass = $_POST['armorClass'];
    $challengeRating = $_POST['challengeRating'];
    $skills = $_POST['skillsField']; // Get the concatenated skills

    if (!empty($name) && !empty($type) && !empty($hitPoints) && !empty($armorClass) && !empty($challengeRating) && !empty($skills)) {
        try {
            $sql = 'INSERT INTO monsters (name, type, hitPoints, armorClass, challengeRating, skills) VALUES (?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $type, $hitPoints, $armorClass, $challengeRating, $skills]);
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