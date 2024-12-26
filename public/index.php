<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dungeons & Dragons Monsters Database</title>
    <link rel="stylesheet" href="styles/main.css?v=<?php echo time(); ?>">
    <style>
        form {
            background-color: #fff;
            padding: 1rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        fieldset {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        legend {
            font-weight: bold;
            padding: 0 10px;
        }
        input[type="number"].ability {
            width: 50px;
            display: inline-block;
            margin-right: 10px;
        }
        button {
            background-color: #333;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Dungeons & Dragons Monsters Database</h1>
    </header>
    <main>
        <section>
            <h2>Add Monster</h2>
            <form action="add_monster.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" required>
                <label for="hitPoints">Hit Points:</label>
                <input type="number" id="hitPoints" name="hitPoints" required>
                <label for="armorClass">Armor Class:</label>
                <input type="number" id="armorClass" name="armorClass" required>
                <label for="challengeRating">Challenge Rating:</label>
                <input type="number" step="0.1" id="challengeRating" name="challengeRating" required>
                <fieldset>
                    <legend>Abilities</legend>
                    <label for="strength">Strength:</label>
                    <input type="number" id="strength" name="strength" class="ability" required>
                    <label for="dexterity">Dexterity:</label>
                    <input type="number" id="dexterity" name="dexterity" class="ability" required>
                    <label for="constitution">Constitution:</label>
                    <input type="number" id="constitution" name="constitution" class="ability" required>
                    <label for="intelligence">Intelligence:</label>
                    <input type="number" id="intelligence" name="intelligence" class="ability" required>
                    <label for="wisdom">Wisdom:</label>
                    <input type="number" id="wisdom" name="wisdom" class="ability" required>
                    <label for="charisma">Charisma:</label>
                    <input type="number" id="charisma" name="charisma" class="ability" required>
                </fieldset>
                <button type="submit">Add Monster</button>
            </form>
        </section>
        <section>
            <h2>Search Monsters</h2>
            <form action="index.php" method="get">
                <label for="search">Search:</label>
                <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                <button type="submit">Search</button>
            </form>
        </section>
        <section>
            <h2>Monster List</h2>
            <?php include 'list_monsters.php'; ?>
        </section>
    </main>
</body>
</html>