<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $hitPoints = $_POST['hitPoints'];
    $hitDice = $_POST['hitDice'];
    $armorClass = $_POST['armorClass'];
    $challengeRating = $_POST['challengeRating'];
    $treasure = $_POST['treasure'];
    $levelAdvancement = $_POST['levelAdvancement'];
    $speedType = $_POST['speedType'];
    $speed = $_POST['speed'];
    $saves = $_POST['saves'];
    $environment = $_POST['environment'];
    $organisation = $_POST['organisation'];
    $advancement = $_POST['advancement'];
    $skills = $_POST['skillsField']; // Get the concatenated skills

    if (!empty($name) && !empty($type) && !empty($hitPoints) && !empty($hitDice) && !empty($armorClass) && !empty($challengeRating) && !empty($treasure) && !empty($levelAdvancement) && !empty($speedType) && !empty($speed) && !empty($saves) && !empty($environment) && !empty($organisation) && !empty($advancement) && !empty($skills)) {
        try {
            $sql = 'INSERT INTO monsters (name, type, hitPoints, hitDice, armorClass, challengeRating, treasure, levelAdvancement, speedType, speed, saves, environment, organisation, advancement, skills) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $type, $hitPoints, $hitDice, $armorClass, $challengeRating, $treasure, $levelAdvancement, $speedType, $speed, $saves, $environment, $organisation, $advancement, $skills]);
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