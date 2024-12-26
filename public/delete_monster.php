<?php
require_once '../src/db.php';

$id = $_GET['id'];

$sql = 'DELETE FROM monsters WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header('Location: index.php');
exit();
?>