<?php
require_once '../src/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $hitPoints = $_POST['hitPoints'];

    $sql = 'UPDATE monsters SET name = ?, type = ?, hitPoints = ? WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $type, $hitPoints, $id]);

    header('Location: index.php');
    exit();
} else {
    $id = $_GET['id'];
    $sql = 'SELECT * FROM monsters WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $monster = $stmt->fetch();

    if ($monster) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Monster</title>
            <link rel="stylesheet" href="styles/main.css">
        </head>
        <body>
            <header>
                <h1>Edit Monster</h1>
            </header>
            <main>
                <form action="edit_monster.php" method="post">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($monster['id']); ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($monster['name']); ?>" required>
                    <label for="type">Type:</label>
                    <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($monster['type']); ?>" required>
                    <label for="hitPoints">Hit Points:</label>
                    <input type="number" id="hitPoints" name="hitPoints" value="<?php echo htmlspecialchars($monster['hitPoints']); ?>" required>
                    <button type="submit">Update Monster</button>
                </form>
            </main>
        </body>
        </html>
        <?php
    } else {
        echo '<p>Monster not found.</p>';
    }
}
?>