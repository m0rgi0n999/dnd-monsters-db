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
    $strength = $_POST['strength'];
    $dexterity = $_POST['dexterity'];
    $constitution = $_POST['constitution'];
    $intelligence = $_POST['intelligence'];
    $wisdom = $_POST['wisdom'];
    $charisma = $_POST['charisma'];

    if (!empty($name) && !empty($type) && !empty($hitPoints) && !empty($armorClass) && !empty($challengeRating) && !empty($strength) && !empty($dexterity) && !empty($constitution) && !empty($intelligence) && !empty($wisdom) && !empty($charisma)) {
        try {
            // Combine abilities into a single string
            $abilities_combined = "Str: $strength, Dex: $dexterity, Con: $constitution, Int: $intelligence, Wis: $wisdom, Cha: $charisma";

            $sql = 'INSERT INTO monsters (name, type, hitPoints, armor_class, challenge_rating, abilities) VALUES (?, ?, ?, ?, ?, ?)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $type, $hitPoints, $armorClass, $challengeRating, $abilities_combined]);
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