<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemName = $_POST['itemName'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO inventory (item_name, description, quantity, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $itemName, $description, $quantity, $price);

    if ($stmt->execute()) {
        echo "Item added successfully!";
        header("Location: view_inventory.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
