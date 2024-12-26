<?php
require_once '../src/db.php';

$search = $_GET['search'] ?? '';

if ($search) {
    $sql = 'SELECT * FROM monsters WHERE name LIKE ? OR type LIKE ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['%' . $search . '%', '%' . $search . '%']);
} else {
    $sql = 'SELECT * FROM monsters';
    $stmt = $pdo->query($sql);
}

$monsters = $stmt->fetchAll();

if ($monsters) {
    echo '<ul>';
    foreach ($monsters as $monster) {
        echo '<li>' . htmlspecialchars($monster['name']) . ' - ' . htmlspecialchars($monster['type']) . ' - ' . htmlspecialchars($monster['hitPoints']) . ' HP';
        echo ' <a href="edit_monster.php?id=' . $monster['id'] . '">Edit</a>';
        echo ' <a href="delete_monster.php?id=' . $monster['id'] . '">Delete</a>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No monsters found.</p>';
}
?>