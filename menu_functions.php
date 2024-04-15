<?php
include "db_connect.php";

function updateMenuItem($id, $name, $description, $price) {
    global $conn;
    $stmt = $conn->prepare("UPDATE menu_items SET name=?, description=?, price=? WHERE id=?");
    $stmt->bind_param("ssdi", $name, $description, $price, $id);
    if ($stmt->execute()) {
        echo "<p>Menu-item succesvol bijgewerkt</p>";
    } else {
        echo "<p>Fout bijwerken menu-item: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

function toggleVisibility($item_id, $is_visible) {
    global $conn;
    $stmt = $conn->prepare("UPDATE menu_items SET is_visible=? WHERE id=?");
    $stmt->bind_param("ii", $is_visible, $item_id);
    if ($stmt->execute()) {
        echo "<p>Zichtbaarheid succesvol bijgewerkt</p>";
    } else {
        echo "<p>Fout bijwerken zichtbaarheid: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

function addMenuItem($name, $description, $price, $category, $file) {
    global $conn;
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($file['name']);
    
    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        echo "<p>Afbeelding succesvol geüpload.</p>";
    } else {
        echo "<p>Fout bij uploaden afbeelding.</p>";
        return;
    }
    
    $metadata = json_encode(array(
        "description" => $description,
        "category" => $category
    ));
    
    $stmt = $conn->prepare("INSERT INTO menu_items (name, price, image_url, image_metadata) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $name, $price, $uploadFile, $metadata);
    if ($stmt->execute()) {
        echo "<p>Menu-item succesvol toegevoegd</p>";
    } else {
        echo "<p>Fout bij toevoegen menu-item: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

function deleteMenuItem($item_id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM menu_items WHERE id=?");
    $stmt->bind_param("i", $item_id);
    if ($stmt->execute()) {
        echo "<p>Menu-item succesvol verwijderd</p>";
    } else {
        echo "<p>Fout bij verwijderen menu-item: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

function fetchMenuItems() {
    global $conn;
    $sql = "SELECT id, name, price, image_url, image_metadata FROM menu_items";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<div class='menu-list'><h2>Bestaande Menu Items</h2>";
        while ($row = $result->fetch_assoc()) {
            $metadata = json_decode($row['image_metadata'], true);
            echo "<div><p>ID: {$row['id']} - Naam: {$row['name']} - Prijs: {$row['price']}€</p>";
            echo "<p>Details: " . $metadata['description'] . " - Categorie: " . $metadata['category'] . "</p>";
            if ($row['image_url']) {
                echo '<img src="' . htmlspecialchars($row['image_url']) . '" style="max-height:100px;"/>';
            } else {
                echo "<p>No image available</p>";
            }
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>Geen menu-items gevonden.</p>";
    }
}

function handlePostRequest() {
    if (isset($_POST["update"])) {
        updateMenuItem($_POST["item_id"], $_POST["name"], $_POST["description"], $_POST["price"]);
    } elseif (isset($_POST["toggle_visibility"])) {
        $visibility = isset($_POST["is_visible"]) ? 1 : 0;
        toggleVisibility($_POST["item_id"], $visibility);
    } elseif (isset($_POST["add"])) {
        addMenuItem($_POST["name"], $_POST["description"], $_POST["price"], $_POST["category"], $_FILES['image']);
    } elseif (isset($_POST["delete"])) {
        deleteMenuItem($_POST["item_id"]);
    }
}

function getMenuItemsByCategory($category) {
    global $conn;
    $stmt = $conn->prepare("SELECT name, price, image_url FROM menu_items WHERE JSON_UNQUOTE(JSON_EXTRACT(image_metadata, '$.category')) = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    $stmt->close();
    return $items;
}
?>