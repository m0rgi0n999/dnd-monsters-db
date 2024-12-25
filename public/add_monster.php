<?php
require_once '../src/db.php';

$name = $_POST['name'];
$type = $_POST['type'];
$hitPoints = $_POST['hitPoints'];

$sql = 'INSERT INTO monsters (name, type, hitPoints) VALUES (?, ?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->execute([$name, $type, $hitPoints]);

header('Location: index.php');
exit();
?>