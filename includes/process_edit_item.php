<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $itemName = $_POST['itemName'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE inventory SET item_name = ?, description = ?, quantity = ?, price = ? WHERE id = ?");
    $stmt->bind_param("ssdii", $itemName, $description, $quantity, $price, $id);

    if ($stmt->execute()) {
        echo "Item updated successfully!";
        header("Location: view_inventory.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
