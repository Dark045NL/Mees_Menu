<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Beheer</title>
    <style>
        body {
            display: flex;
            justify-content: space-between;
        }
        .menu-section, .menu-list {
            width: 48%;
            padding: 1%;
        }
        .menu-list {
            border: 1px solid #ccc;
            padding: 10px;
            height: fit-content;
        }
        img {
            max-height: 100px;
        }
    </style>
</head>
<body>
    <div class="menu-section">
        <h1>Menu Beheer</h1>
        <?php
        include "db_connect.php";
        include "menu_functions.php";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            handlePostRequest();
        }
        ?>
        <h2>Menu-item toevoegen</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="add">
            <label for="name">Naam:</label> <input type="text" name="name" id="name"><br>
            <label for="description">Beschrijving:</label> <input type="text" name="description" id="description"><br>
            <label for="price">Prijs:</label> <input type="text" name="price" id="price"><br>
            <label for="category">Categorie:</label> <select name="category" id="category">
                <option value="broodje">Broodje</option>
                <option value="snack">Snack</option>
                <option value="drink">Drink</option>
            </select><br>
            <label for="image">Afbeelding:</label> <input type="file" name="image" id="image"><br>
            <input type="submit" value="Toevoegen">
        </form>
        <h2>Menu-item aanpassen</h2>
        <form method="post">
            <input type="hidden" name="update">
            <label for="item_id">Item ID:</label> <input type="text" name="item_id" id="item_id"><br>
            <label for="name">Naam:</label> <input type="text" name="name" id="name"><br>
            <label for="description">Beschrijving:</label> <textarea name="description" id="description"></textarea><br>
            <label for="price">Prijs:</label> <input type="text" name="price" id="price"><br>
            <input type="submit" value="Update">
        </form>
        <h2>Zichtbaarheid van gerechten beheren</h2>
        <form method="post">
            <input type="hidden" name="toggle_visibility">
            <label for="item_id">Item ID:</label> <input type="text" name="item_id" id="item_id"><br>
            <label for="is_visible">Zichtbaar:</label> <input type="checkbox" name="is_visible" id="is_visible" value="1" checked><br>
            <input type="submit" value="Toggle Zichtbaarheid">
        </form>
        <h2>Menu-item verwijderen</h2>
        <form method="post">
            <input type="hidden" name="delete">
            <label for="item_id_delete">Item ID:</label> <input type="text" name="item_id" id="item_id_delete"><br>
            <input type="submit" value="Verwijderen">
        </form>
        <a href="index.php">Return to Index</a>
    </div>
    <div class="menu-list">
        <?php
        fetchMenuItems();
        ?>
    </div>
</body>
</html>