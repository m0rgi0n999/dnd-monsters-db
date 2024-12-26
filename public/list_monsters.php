<?php
require_once '../src/db.php';

$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;

if ($search) {
    $sql = 'SELECT * FROM monsters WHERE name LIKE ? OR type LIKE ? LIMIT ? OFFSET ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['%' . $search . '%', '%' . $search . '%', $limit, $offset]);
} else {
    $sql = 'SELECT * FROM monsters LIMIT ? OFFSET ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$limit, $offset]);
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

// Pagination
$sql = 'SELECT COUNT(*) FROM monsters';
if ($search) {
    $sql .= ' WHERE name LIKE ? OR type LIKE ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['%' . $search . '%', '%' . $search . '%']);
} else {
    $stmt = $pdo->query($sql);
}
$total_monsters = $stmt->fetchColumn();
$total_pages = ceil($total_monsters / $limit);

echo '<nav>';
for ($i = 1; $i <= $total_pages; $i++) {
    echo '<a href="?page=' . $i . '&search=' . htmlspecialchars($search) . '">' . $i . '</a> ';
}
echo '</nav>';
?>