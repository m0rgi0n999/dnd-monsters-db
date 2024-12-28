<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../src/db.php';

$name = $_POST['name'];
$size = $_POST['size'];
$type = $_POST['type'];
$hitPoints = $_POST['hitPoints'];
$hitDice = $_POST['hitDice'];
$armorClass = $_POST['armorClass'];
$challengeRating = $_POST['challengeRating'];
$treasure = $_POST['treasure'];
$levelAdvancement = $_POST['levelAdvancement'];
$speedTypes = $_POST['speedType'];
$speeds = $_POST['speed'];
$speed = implode(', ', array_map(function($type, $value) {
    return "$type: $value";
}, $speedTypes, $speeds));
$fortSave = $_POST['fortSave'];
$refSave = $_POST['refSave'];
$willSave = $_POST['willSave'];
$saves = "Fort: $fortSave, Ref: $refSave, Will: $willSave";
$environment = $_POST['environment'];
$organisation = $_POST['organisation'];
$advancement = $_POST['advancement'];
$skills = $_POST['skillsField']; // Get the concatenated skills

// Insert the monster into the database
$sql = "INSERT INTO monsters (name, size, type, hitPoints, hitDice, armorClass, challengeRating, treasure, levelAdvancement, speed, saves, environment, organisation, advancement, skills) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$name, $size, $type, $hitPoints, $hitDice, $armorClass, $challengeRating, $treasure, $levelAdvancement, $speed, $saves, $environment, $organisation, $advancement, $skills]);

header('Location: index.php');
exit;
?>