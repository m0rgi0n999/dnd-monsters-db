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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        main {
            padding: 1rem;
            max-width: 800px;
            margin: 0 auto;
        }

        h2 {
            color: #333;
        }

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
        input[type="number"],
        select {
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

        .abilities {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .ability {
            flex: 1 1 100px;
            display: flex;
            flex-direction: column;
        }

        input[type="number"].ability {
            width: 2.5em;
            height: 1em;
            padding: 0;
            text-align: center;
            font-size: 1em;
            line-height: 1em;
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

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            background-color: #fff;
            padding: 1rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        a {
            color: #333;
            text-decoration: none;
            margin-left: 1rem;
        }

        a:hover {
            text-decoration: underline;
        }

        nav {
            text-align: center;
            margin-top: 1rem;
        }

        nav a {
            margin: 0 0.5rem;
            color: #333;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* Tab styles */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        .tab button:hover {
            background-color: #ddd;
        }

        .tab button.active {
            background-color: #ccc;
        }

        .tabcontent {
            display: none;
            padding: 1rem;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }

        .tabcontent.active {
            display: block;
        }

        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .skill {
            flex: 1 1 45%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .skill label {
            flex: 1;
        }

        .skill input[type="number"] {
            width: 2.5em;
            height: 1em;
            padding: 0;
            text-align: center;
            font-size: 1em;
            line-height: 1em;
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
            <form id="monsterForm" action="add_monster.php" method="post" onsubmit="prepareSkills()">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="type">Type:</label>
                <input type="text" id="type" name="type" required>
                <fieldset>
                    <legend>Abilities</legend>
                    <div class="abilities">
                        <div class="ability">
                            <label for="strength">Strength:</label>
                            <input type="number" id="strength" name="strength" class="ability" required>
                        </div>
                        <div class="ability">
                            <label for="dexterity">Dexterity:</label>
                            <input type="number" id="dexterity" name="dexterity" class="ability" required>
                        </div>
                        <div class="ability">
                            <label for="constitution">Constitution:</label>
                            <input type="number" id="constitution" name="constitution" class="ability" required>
                        </div>
                        <div class="ability">
                            <label for="intelligence">Intelligence:</label>
                            <input type="number" id="intelligence" name="intelligence" class="ability" required>
                        </div>
                        <div class="ability">
                            <label for="wisdom">Wisdom:</label>
                            <input type="number" id="wisdom" name="wisdom" class="ability" required>
                        </div>
                        <div class="ability">
                            <label for="charisma">Charisma:</label>
                            <input type="number" id="charisma" name="charisma" class="ability" required>
                        </div>
                    </div>
                </fieldset>
                <div class="tab">
                    <button type="button" class="tablinks" onclick="openTab(event, 'BasicInfo')">Basic Info</button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'Skills')">Skills</button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'Attack')">Attack/Special Qualities</button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'Feats')">Feats</button>
                    <button type="button" class="tablinks" onclick="openTab(event, 'Description')">Description</button>
                </div>
                <div id="BasicInfo" class="tabcontent">
                    <label for="hitPoints">Hit Points:</label>
                    <input type="number" id="hitPoints" name="hitPoints" required>
                    <label for="hitDice">Hit Dice:</label>
                    <input type="text" id="hitDice" name="hitDice" required>
                    <label for="armorClass">Armor Class:</label>
                    <input type="number" id="armorClass" name="armorClass" required>
                    <label for="challengeRating">Challenge Rating:</label>
                    <input type="number" step="0.1" id="challengeRating" name="challengeRating" required>
                    <label for="treasure">Treasure:</label>
                    <input type="text" id="treasure" name="treasure">
                    <label for="levelAdvancement">Level Advancement:</label>
                    <input type="text" id="levelAdvancement" name="levelAdvancement">
                    <label for="speed">Speed:</label>
                    <select id="speedType" name="speedType">
                        <option value="land">Land</option>
                        <option value="fly">Fly</option>
                        <option value="swim">Swim</option>
                        <option value="burrow">Burrow</option>
                        <option value="climb">Climb</option>
                    </select>
                    <input type="number" id="speed" name="speed" required>
                    <label for="saves">Saves:</label>
                    <input type="text" id="saves" name="saves">
                    <label for="environment">Environment:</label>
                    <input type="text" id="environment" name="environment">
                    <label for="organisation">Organisation:</label>
                    <input type="text" id="organisation" name="organisation">
                    <label for="advancement">Advancement:</label>
                    <input type="text" id="advancement" name="advancement">
                </div>
                <div id="Skills" class="tabcontent">
                    <div class="skills-container">
                        <?php
                        $skills = [
                            "Appraise", "Balance", "Bluff", "Climb", "Concentration", "Craft", "Decipher Script",
                            "Diplomacy", "Disable Device", "Disguise", "Escape Artist", "Forgery", "Gather Information",
                            "Handle Animal", "Heal", "Hide", "Intimidate", "Jump", "Knowledge (Arcana)", "Knowledge (Dungeoneering)",
                            "Knowledge (Engineering)", "Knowledge (Geography)", "Knowledge (History)", "Knowledge (Local)",
                            "Knowledge (Nature)", "Knowledge (Nobility)", "Knowledge (Religion)", "Knowledge (The Planes)",
                            "Listen", "Move Silently", "Open Lock", "Perform", "Profession", "Ride", "Search", "Sense Motive",
                            "Sleight of Hand", "Spellcraft", "Spot", "Survival", "Swim", "Tumble", "Use Magic Device", "Use Rope"
                        ];
                        foreach ($skills as $skill) {
                            echo '<div class="skill">';
                            echo '<input type="checkbox" id="' . strtolower(str_replace(' ', '_', $skill)) . '" name="skills[]" value="' . $skill . '">';
                            echo '<label for="' . strtolower(str_replace(' ', '_', $skill)) . '">' . $skill . ':</label>';
                            echo '<input type="number" name="' . strtolower(str_replace(' ', '_', $skill)) . '_value" class="ability" min="0" max="99">';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <div id="Attack" class="tabcontent">
                    <label for="attack">Attack/Special Qualities:</label>
                    <textarea id="attack" name="attack" rows="4" cols="50"></textarea>
                </div>
                <div id="Feats" class="tabcontent">
                    <label for="feats">Feats:</label>
                    <textarea id="feats" name="feats" rows="4" cols="50"></textarea>
                </div>
                <div id="Description" class="tabcontent">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" cols="50"></textarea>
                </div>
                <input type="hidden" id="skillsField" name="skillsField">
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
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Open the first tab by default
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".tablinks").click();
        });

        function prepareSkills() {
            var skills = [];
            document.querySelectorAll('.skills-container .skill').forEach(function(skill) {
                var checkbox = skill.querySelector('input[type="checkbox"]');
                var value = skill.querySelector('input[type="number"]').value;
                if (checkbox.checked) {
                    skills.push(checkbox.value + ':' + value);
                }
            });
            document.getElementById('skillsField').value = skills.join(',');
        }
    </script>
</body>
</html>