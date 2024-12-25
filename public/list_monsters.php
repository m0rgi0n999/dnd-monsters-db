<?php
require_once '../src/db.php';

$sql = 'SELECT * FROM monsters';
$stmt = $pdo->query($sql);
$monsters = $stmt->fetchAll();

if ($monsters) {
    echo '<ul>';
    foreach ($monsters as $monster) {
        echo '<li>' . htmlspecialchars($monster['name']) . ' - ' . htmlspecialchars($monster['type']) . ' - ' . htmlspecialchars($monster['hitPoints']) . ' HP</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No monsters found.</p>';
}
?>